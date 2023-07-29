<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    //
    public function saveHolidays(Request $request)
    {
        echo "hello";
        // $selectedDates = $request->input('selectedDates', []);
        // $selectedHolidayType = $request->input('holidayType', '');

        // foreach ($selectedDates as $date) {
        //     Holiday::create([
        //         'holiday_date' => $date,
        //         'holiday_type' => $selectedHolidayType,
        //     ]);
        // }

        // return response()->json(['message' => 'Holidays saved successfully']);
    }
}
