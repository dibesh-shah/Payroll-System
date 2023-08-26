<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttendanceController extends Controller
{
    public function index()
    {
        $employeeId = Session::get('employee_id');
        // dd($employeeId);
        $now = now();
    $todayDate = now()->format('Y-m-d');
    $year = $now->year;
    $month = $now->month;

    $startDate = "{$year}-{$month}-01";
    $endDate = $now->format('Y-m-t');

    // Get today's attendance for the employee
    $todayAttendance = Attendance::where('employee_id', $employeeId)
        ->whereDate('date', today())
        ->first();
    $attendanceData = Attendance::where('employee_id', $employeeId)
        ->whereBetween('date', [$startDate, $endDate])
        ->orderBy('date', 'desc')
        ->get();

    return view('employee.attendance', compact('todayAttendance','attendanceData', 'year', 'month'));
}
    public function clockIn(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'clock_in' => 'required|string',

        ]);

        $employee = auth()->user();

        $attendance = Attendance::where('employee_id',  $data['employee_id'])
        ->where('date', $data['date'])
        ->first();
        if ($attendance && $attendance->clock_out) {
            return response()->json(['error' => 'You have already clocked out for the day.']);
        }
        if ($attendance && $attendance->clock_in) {
            return response()->json(['error' => 'You have already clocked in for the day.']);
        }

        $attendance = new Attendance();
        $attendance->employee_id = $data['employee_id'];
        $attendance->date = $data['date'];
        $attendance->clock_in = $data['clock_in'];
        $attendance->save();

        return response()->json([
            'date' => $attendance->date,
            'clock_in' => $attendance->clock_in,

        ]);
     }

    public function clockOut(Request $request)
    {
        $data = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'clock_out' => 'required|string',
        ]);

        $employee = auth()->user();

        $attendance = Attendance::where('employee_id', $data['employee_id'])
            ->where('date', $data['date'])
            ->first();
            if ($attendance && $attendance->clock_out) {
                return response()->json(['error' => 'You have already clocked out for the day.']);
            }

            if(!$attendance->clock_in){
                return response()->json(['error' =>' you have not clocked in yet']);
            }

        if ($attendance) {
            $attendance->clock_out = $data['clock_out'];
            $attendance->save();
        }

        return response()->json([
            'date' => $attendance->date,
            'clock_in' => $attendance->clock_in,
            'clock_out' => $attendance->clock_out
        ]);
    }
    // public function getMonthlyAttendance()
    // {
    //     $employeeId = Session::get('employee_id');
    //     $now = now();
    //     $year = $now->year;
    //     $month = $now->month;

    //     $startDate = "{$year}-{$month}-01";
    //     $endDate = $now->format('Y-m-t');

    //     $attendanceData = Attendance::where('employee_id', $employeeId)
    //         ->whereBetween('date', [$startDate, $endDate])
    //         ->get();

    //     return view('employee.monthly_attendance', compact('attendanceData', 'year', 'month'));
    // }
}
