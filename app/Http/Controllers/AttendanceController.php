<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(){
        return view('employee.attendance');
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

    // Check if the user has already clocked in for the day
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
        // return back()->with('success', 'Clock in successful.');

        // return redirect()->route('home')->with('success', 'Clock in successful.');
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
            if(!$attendance){
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


        // return redirect()->route('home')->with('success', 'Clock out successful.');
    }
    public function showAttendance($year = null, $month = null, Request $request)
    {
         $data = $request->validate([
        'year' => 'required|numeric',
        'month' => 'required|numeric',
        'employee_id' => 'required|exists:employees,id',
    ]);
        $employee = auth()->user();

    // Populate year and month options
    $years = range(date('Y'), 2030); // Adjust the range as needed
    $months = ['01' => 'January', '02' => 'February', '03' => 'March', '04'=>'April'];

    // If year and month were not provided, use the current year and month
    $year = $data['year'];
    $month = str_pad($data['month'], 2, '0', STR_PAD_LEFT);

    $startDate = "{$year}-{$month}-01";
    $endDate = date('Y-m-t', strtotime($startDate));

    $attendanceData = Attendance::where('employee_id', $data['employee_id'])
        ->whereBetween('date', [$startDate, $endDate])
        ->get();
        dd($attendanceData);
    return view('employee.attendance', compact('attendanceData', 'years', 'months'));
    }

}
