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
        $leaveRequests = LeaveRequest::where('status', 'pending')->with('leaveType', 'employee')->get();

        return view('admin.leave_request', compact('leaveRequests'));
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
        $leaves = Leave::all();


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
        return view('employee.leave_apply', compact('leaves', 'employee', 'publicHolidays', 'otherHolidays'));
    }



        public function store(Request $request)
        {
            // Validation rules
            $validationRules = [
                'start_date' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
                'end_date' => 'required|date|after:start_date',
                // Add other validation rules as needed
            ];

            // Custom validation messages
            $validationMessages = [
                'start_date.after_or_equal' => 'The start date must be today or a future date.',
                'end_date.after' => 'The end date must be after the start date.',
                // Add other custom messages as needed
            ];

            // Validate the request
            $request->validate($validationRules, $validationMessages);

            // Create the leave request
            LeaveRequest::create($request->all());

            return redirect()->route('employee.leaveApply')->with('success', 'Leave request submitted successfully.');
        }

    public function approveLeave($id, Request $request)
    {
        $approveLeave = LeaveRequest::findOrFail($id);

        if ($approveLeave->status !== 'approved') {
            $approveLeave->status = 'approved';
            $approveLeave->admin_response = $request->input('admin_response');
            $approveLeave->save();
        }
        return redirect('/admin/leave_request')->with('success', 'Leave approved successfully.');
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
        return redirect('/admin/leave_request')->with('success', 'Leave rejected successfully');
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

    }
}
