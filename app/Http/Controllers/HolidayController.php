<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

class HolidayController extends Controller
{
    public function saveHolidays(Request $request)
    {
        $selectedDates = $request->input('selectedDates', '');
        $selectedHolidayType = $request->input('holidayType', '');
        return $selectedDates;

        // foreach ($selectedDates as $date) {
            // echo $date;
        //     Holiday::create([
        //         'holiday_date' => $date,
        //         'holiday_type' => $selectedHolidayType,
        //     ]);
        // }

    }
}
