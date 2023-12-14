<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class LeaveRequestController extends Controller
{
    // public function index(){
    //     $leaveRequests = LeaveRequest::all();
    //     foreach ($leaveRequests as $leaveRequest) {
    //         $employee = Employee::find($leaveRequest->employee_id);
    //         if ($employee) {
    //             $leaveRequest->employee_name = $employee->first_name . ' ' . $employee->last_name;
    //         }
    //     }
    //     return view('admin.leave_request', compact('leaveRequests'));
    // }

    public function index(){
        // Retrieve "pending" leave requests and eager load the "leaveType" and "employee" relationships
        $leaveRequests = LeaveRequest::where('status', 'pending')->with('leave', 'employee')->get();

        return view('admin.leave_request', compact('leaveRequests'));
        // dd($request->all());

    }
    
    public function idSearch(Request $request){
        $id = $request->leave_id;
        // Retrieve "pending" leave requests and eager load the "leaveType" and "employee" relationships
        // $leaveSearch = LeaveRequest::where('id', $id)->with('leave', 'employee')->get();
        $leaveSearch = LeaveRequest::where('id', $id)->get();


        
        $leaveRequest = LeaveRequest::findOrFail($id);
        // Retrieve the associated employee
        $employee = Employee::find($leaveRequest->employee_id);
        $leave_name = Leave::find($leaveRequest->leave_type);

        // If the employee is found, concatenate the first name and last name
        if ($employee) {
            $leaveRequest->employee_name = $employee->first_name . ' ' . $employee->last_name;
        }

        if ($leave_name) {
            $leaveRequest->leave_name = $leave_name->name ;
        }

        return view('admin.leave_request', compact('leaveSearch','leaveRequest'));
        // dd($request->all());
        // dd($leaveSearch->all());
        // dd($id);

    }


    public function show($id){
        $now = now();
        $todayDate = now()->format('Y-m-d');
        $year = $now->year;
        $month = $now->month ;

        $startDate = "{$year}-{$month}-01";
        $endDate = $now->format('Y-m-t');
       // Fetch holidays from the database
        $holidays = Holiday::where('holiday_date', 'like', $year . '-' . $month . '-%')->get();

        // Create two separate lists for "Public Holiday" and "Other"
        $publicHolidays = [];
        $otherHolidays = [];

        foreach ($holidays as $holiday) {
            $holidayType = $holiday->holiday_type;
            $holidayDates = explode(',', $holiday->holiday_date);

            // Check the holiday type and add to the respective list
            if ($holidayType === "Public Holiday") {
                $publicHolidays[] = [
                    'id' => $holiday->id,
                    'holiday_dates' => $holidayDates,
                    'created_at' => $holiday->created_at,
                    'updated_at' => $holiday->updated_at,
                ];
            } elseif ($holidayType === "Other") {
                $otherHolidays[] = [
                    'id' => $holiday->id,
                    'holiday_dates' => $holidayDates,
                    'created_at' => $holiday->created_at,
                    'updated_at' => $holiday->updated_at,
                ];
            }
        }
        $leaveRequest = LeaveRequest::findOrFail($id);
          // Retrieve the associated employee
          $employee = Employee::find($leaveRequest->employee_id);
          $leave_name = Leave::find($leaveRequest->leave_type);

          // If the employee is found, concatenate the first name and last name
          if ($employee) {
              $leaveRequest->employee_name = $employee->first_name . ' ' . $employee->last_name;
          }

          if ($leave_name) {
              $leaveRequest->leave_name = $leave_name->name ;
          }
        return view('admin.leave_detail',compact('leaveRequest', 'publicHolidays', 'otherHolidays'));
    }
    public function leaveHolidays(){
        $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);
        $assignedLeaves = Leave::whereHas('employees', function ($query) use ($employeeId) {
            $query->where('employees.id', $employeeId); // Use the table alias to specify 'id' column
        })->get();


        $now = now();
        $todayDate = now()->format('Y-m-d');
        $year = $now->year;
        $month = $now->month ;

        $startDate = "{$year}-{$month}-01";
        $endDate = $now->format('Y-m-t');
       // Fetch holidays from the database
        $holidays = Holiday::where('holiday_date', 'like', $year . '-' . $month . '-%')->get();

        // Create two separate lists for "Public Holiday" and "Other"
        $publicHolidays = [];
        $otherHolidays = [];

        foreach ($holidays as $holiday) {
            $holidayType = $holiday->holiday_type;
            $holidayDates = explode(',', $holiday->holiday_date);

            // Check the holiday type and add to the respective list
            if ($holidayType === "Public Holiday") {
                $publicHolidays[] = [
                    'id' => $holiday->id,
                    'holiday_dates' => $holidayDates,
                    'created_at' => $holiday->created_at,
                    'updated_at' => $holiday->updated_at,
                ];
            } elseif ($holidayType === "Other") {
                $otherHolidays[] = [
                    'id' => $holiday->id,
                    'holiday_dates' => $holidayDates,
                    'created_at' => $holiday->created_at,
                    'updated_at' => $holiday->updated_at,
                ];
            }
        }

        // Pass the data to the 'admin.calendar' view
        return view('employee.leave_apply', compact('assignedLeaves', 'employee', 'publicHolidays', 'otherHolidays'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_id' => 'required|exists:leaves,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'message' => 'nullable|string',
        ]);
        LeaveRequest::create([
            'employee_id' => $request->input('employee_id'),
            'leave_type' => $request->input('leave_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', 'Leave request submitted successfully.');
    }

    public function approveLeave($id, Request $request)
    {
        $approveLeave = LeaveRequest::findOrFail($id);

        if ($approveLeave->status !== 'approved') {
            $approveLeave->status = 'approved';
            $approveLeave->admin_response = $request->input('admin_response');
            $approveLeave->save();
        }
        return redirect('/admin/leave_request')->with('success', 'Leave Request approved ');
    }
    public function viewLeave(Request $request)
    {
        $search = $request->input('search');

        $leaves = LeaveRequest::where('status', 'approved')
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            })->paginate(4);

        return view('/admin/leave_history',  ['leaves' => $leaves, 'search' => $search]);
    }


    public function rejectLeave($id)
    {
        $rejectLeave = LeaveRequest::findOrFail($id);
        $rejectLeave->status = 'rejected';
        $rejectLeave->save();
        return redirect('/admin/leave_request')->with('error', 'Leave Request rejected ');
    }

    public function balance()
    {
        $employeeId = session('employee_id');

        $approvedLeaveCounts = LeaveRequest::select('leave_type', DB::raw('COUNT(id) as approved_count'))
            ->where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->groupBy('leave_type')
            ->get();

        $balances = Leave::select('name', 'days', 'id')->get();

        $remainingBalances = [];
        foreach ($balances as $balance) {
            $id = $balance->id;
            $leaveType = $balance->name;
            $days = $balance->days;
            $approvedCount = $approvedLeaveCounts->where('leave_type', $id)->first()->approved_count ?? 0;
            $remainingDays = $days - $approvedCount;

            $remainingBalances[] = [
                'name' => $leaveType,
                'days' => $days,
                'remaining_days' => $remainingDays,
                'id' => $id,
            ];
        }

        return view('/employee/leave_balance', ['remainingBalances' => $remainingBalances]);
    }

    public function empHistory(){

        $employeeId = session('employee_id');
        $leaveRequests = LeaveRequest::where('employee_id', $employeeId)
            ->orderBy('id','desc')
            ->get();

        foreach($leaveRequests as $leaveRequest){
            $leave_name = Leave::find($leaveRequest->leave_type);

            if ($leave_name) {
                $leaveRequest->leave_name = $leave_name->name ;
            }
        }

        $leaveRequestsByMonth = $leaveRequests->groupBy(function ($leaveRequest) {
            return Carbon::parse($leaveRequest->start_date)->format('F Y');
        });

        return view('/employee/leave_history', ['leaveRequestsByMonth' => $leaveRequestsByMonth]);
        // dd($leaveRequests->all());
        // dd($employeeId);

    }
}
