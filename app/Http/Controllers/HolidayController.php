<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;


class HolidayController extends Controller
{
    public function saveHolidays(Request $request)
    {
        // $selectedDates = $request->input('selectedDates', '');
        // $selectedHolidayType = $request->input('holidayType', '');
        // return $selectedDates;

        // // foreach ($selectedDates as $date) {
        //     // echo $date;
        // //     Holiday::create([
        // //         'holiday_date' => $date,
        // //         'holiday_type' => $selectedHolidayType,
        // //     ]);
        // // }

            Holiday::create($request->all());
        // dd($request->all());
        // $selectedDates = explode(',', $request->holiday_date);

        // foreach ($selectedDates as $date) {
        //     Holiday::create($request->all());
        //     ([
        //         'date' => $date,
        //         'holiday_type' => $request->holiday_type,
        //         'holiday_name' => $request->holiday_name,

        //     ]);
            // $dataToUpdate = $request->only(['date', 'holiday_type']); // Get the fields to update from the request

            // // Find the user by ID and update the data
            // $user = Holiday::findOrFail($id);
            // $user->update($dataToUpdate);
        // }

        // return response()->json('Holidays saved successfully.');
    }
    public function getHolidays(){
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

        return view('admin.calendar', compact('publicHolidays', 'otherHolidays'));

    }
    public function showHolidays(){
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
        return view('employee.calendar', compact('publicHolidays', 'otherHolidays'));
    }

    // public function leaveDetailHolidays(){
    //     $now = now();
    //     $todayDate = now()->format('Y-m-d');
    //     $year = $now->year;
    //     $month = $now->month ;

    //     $startDate = "{$year}-{$month}-01";
    //     $endDate = $now->format('Y-m-t');
    //    // Fetch holidays from the database
    //     $holidays = Holiday::where('holiday_date', 'like', $year . '-' . $month . '-%')->get();

    //     // Create two separate lists for "Public Holiday" and "Other"
    //     $publicHolidays = [];
    //     $otherHolidays = [];

    //     foreach ($holidays as $holiday) {
    //         $holidayType = $holiday->holiday_type;
    //         $holidayDates = explode(',', $holiday->holiday_date);

    //         // Check the holiday type and add to the respective list
    //         if ($holidayType === "Public Holiday") {
    //             $publicHolidays[] = [
    //                 'id' => $holiday->id,
    //                 'holiday_dates' => $holidayDates,
    //                 'created_at' => $holiday->created_at,
    //                 'updated_at' => $holiday->updated_at,
    //             ];
    //         } elseif ($holidayType === "Other") {
    //             $otherHolidays[] = [
    //                 'id' => $holiday->id,
    //                 'holiday_dates' => $holidayDates,
    //                 'created_at' => $holiday->created_at,
    //                 'updated_at' => $holiday->updated_at,
    //             ];
    //         }
    //     }

    //     // Pass the data to the 'admin.calendar' view
    //     return view('admin.leave_detail', compact('publicHolidays', 'otherHolidays'));
    // }
}
