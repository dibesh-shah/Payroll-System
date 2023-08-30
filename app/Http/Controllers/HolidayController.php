<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holiday;

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
}
