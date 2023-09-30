<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index(){
        $leaveRequests = LeaveRequest::all();
        foreach ($leaveRequests as $leaveRequest) {
            $employee = Employee::find($leaveRequest->employee_id);
            if ($employee) {
                $leaveRequest->employee_name = $employee->first_name . ' ' . $employee->last_name;
            }
        }
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

          // If the employee is found, concatenate the first name and last name
          if ($employee) {
              $leaveRequest->employee_name = $employee->first_name . ' ' . $employee->last_name;
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

        LeaveRequest::create($request->all());

        return redirect()->route('employee.leaveApply')->with('success', 'Leave request submitted successfully.');
        // echo "hello";
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
}
