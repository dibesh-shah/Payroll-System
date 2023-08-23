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
            'date' => 'required|date',
            'clock_in' => 'required|date_format:H:i',
        ]);

        $employee = auth()->user();

        $attendance = new Attendance();
        $attendance->employee_id = $employee->id;
        $attendance->date = $data['date'];
        $attendance->clock_in = $data['clock_in'];
        $attendance->save();

        return response()->json([
            'date' => $attendance->date,
            'clock_in' => $attendance->clock_in,
            'clock_out' => '-'
        ]);

        // return redirect()->route('home')->with('success', 'Clock in successful.');
    }

    public function clockOut(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'clock_out' => 'required|date_format:H:i',
        ]);

        $employee = auth()->user();

        $attendance = Attendance::where('employee_id', $employee->id)
            ->where('date', $data['date'])
            ->first();

        if ($attendance) {
            $attendance->clock_in = $data['clock_out'];
            $attendance->save();
        }

        return response()->json([
            'date' => $attendance->date,
            'clock_in' => $attendance->clock_in,
            'clock_out' => $attendance->clock_out
        ]);


        // return redirect()->route('home')->with('success', 'Clock out successful.');
    }
    public function displayMonthlyAttendance(Request $request)
    {
        $employee = auth()->user();
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        $startOfMonth = now()->setYear($year)->setMonth($month)->startOfMonth();
        $endOfMonth = now()->setYear($year)->setMonth($month)->endOfMonth();

        $monthlyAttendance = Attendance::where('employee_id', $employee->id)
            ->whereBetween('date', [$startOfMonth, $endOfMonth])
            ->orderBy('date')
            ->get();

        return view('employee.monthly_attendance', compact('monthlyAttendance', 'year', 'month'));
    }
}
