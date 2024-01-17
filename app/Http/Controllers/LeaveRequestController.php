<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


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
        $weekends = [];

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
            }else{
                $weekends[] = [
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
        return view('admin.leave_detail',compact('leaveRequest', 'publicHolidays', 'otherHolidays','weekends'));
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
        $weekends = [];

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
            }else{
                $weekends[] = [
                    'id' => $holiday->id,
                    'holiday_dates' => $holidayDates,
                    'created_at' => $holiday->created_at,
                    'updated_at' => $holiday->updated_at,
                ];
            }
        }

        // Pass the data to the 'admin.calendar' view
        return view('employee.leave_apply', compact('assignedLeaves', 'employee', 'publicHolidays', 'otherHolidays', 'weekends'));
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

    $approvedLeaveCounts = LeaveRequest::select('leave_type', DB::raw('SUM(DATEDIFF(end_date, start_date) + 1) as approved_days'))
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
        $approvedDays = $approvedLeaveCounts->where('leave_type', $id)->first()->approved_days ?? 0;
        $remainingDays = $days - $approvedDays;

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
        // dd(Str::random(32));

    }

    public function adminHistory(){

        $now = now();
        $todayDate = now()->format('Y-m-d');
        $year = $now->year;
        $month = $now->month;
    
        $startDate = "{$year}-{$month}-01";
        $endDate = $now->format('Y-m-t');

        $leaveRequests = LeaveRequest::whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->orderBy('id','desc')
            ->get();

        foreach($leaveRequests as $leaveRequest){
            $leave_name = Leave::find($leaveRequest->leave_type);
            $employee_name = Employee::find($leaveRequest->employee_id);

            if ($leave_name) {
                $leaveRequest->leave_name = $leave_name->name ;
            }
            if ($employee_name) {
                $leaveRequest->employee_name = $employee_name->first_name." ".$employee_name->last_name ;
            }
        }

        

        return view('/admin/leave_history', ['leaveRequests' => $leaveRequests]);
        // dd($leaveRequests->all());
        // dd($employeeId);

    }

    public function leaveAssign(){
        // return view('admin.leave_assign');
        $designations = Employee::distinct()->pluck('designation');
        $departments = Department::all();
        $leaves = Leave::all();

        return view('admin.leave_assign', compact('designations','departments','leaves'));
    }

    public function assignLeave(Request $request){
        // // return view('admin.leave_assign');
        // $designations = Employee::distinct()->pluck('designation');
        // $departments = Department::all();
        // $leaves = Leave::all();

        // return view('admin.leave_assign', compact('designations','departments','leaves'));
        $assignBy = $request->assignBy;
        $leaveTypes = $request->input('leaveTypes', []);

        if($assignBy == "employeeId"){
            $employee_id =$request->employeeId;
            $this->assignLeaveByEmployeeId($employee_id, $leaveTypes);
        }elseif($assignBy == "designation"){
            $designation = $request->designation;
                $this->assignLeaveByDesignation($designation, $leaveTypes);
        }elseif($assignBy == "department"){
            $department = $request->department;
                $this->assignLeaveByDepartment($department, $leaveTypes);
        }else{

        }
        // switch ($assignBy) {
        //     case 'employeeId':
        //         $employee_id =$request->employeeId;
        //         $this->assignLeaveByEmployeeId($employee_id, $leaveTypes);
        //         break;
        //     case 'designation':
        //         $designation = $request->designation;
        //         $this->assignLeaveByDesignation($designation, $leaveTypes);
        //         break;
        //     case 'department':
        //         $department = $request->department;
        //         $this->assignLeaveByDepartment($department, $leaveTypes);
        //         break;
        //     default:
        //         return response()->json(['error' => 'Invalid assignment criteria.']);
        // }
        // dd($request->all());
        return redirect('/admin/leave_assign')->with('success', 'Leaves have been assigned');
        // dd($assignBy);
    }

    public function assignLeaveByEmployeeId($employeeId, $leaveTypes)
    {
        foreach ($leaveTypes as $leaveType) {
            DB::table('employee_leave')->updateOrInsert(
                ['employee_id' => $employeeId, 'leave_id' => $leaveType],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
        // dd($employeeId);
    }

    public function assignLeaveByDesignation($designation, $leaveTypes)
    {
        // Get all employee IDs with the given designation
        $employeeIds = Employee::where('designation', $designation)->pluck('id');

        // Assign leave for each employee
        foreach ($employeeIds as $employeeId) {
            $this->assignLeaveByEmployeeId($employeeId, $leaveTypes);
        }
    }

    public function assignLeaveByDepartment($department, $leaveTypes)
    {
        // Get all employee IDs with the given department
        $employeeIds = Employee::where('department_id', $department)->pluck('id');

        // Assign leave for each employee
        foreach ($employeeIds as $employeeId) {
            $this->assignLeaveByEmployeeId($employeeId, $leaveTypes);
        }
    }
}
