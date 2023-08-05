<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use Illuminate\Http\Request;
use App\Models\DeductionOption;


class DeductionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $deductionOptions = DeductionOption::all();
        return view('/admin/deductionOptions', compact('deductionOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('decuctionOptions.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:deduction_options|max:20',
            'description' => 'nullable',


        ]);

        DeductionOption::create($request->all());
        return redirect()->route('deductionOptions.index')->with('success', 'Deduction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, DeductionOption $deductionOption)
    {
        //
        $id = $request->input('id');
        $dataToUpdate = $request->only(['name', 'description']); // Get the fields to update from the request

        // Find the user by ID and update the data
        $user = DeductionOption::findOrFail($id);
        $user->update($dataToUpdate);

        return response()->json(['message' => 'Data updated successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeductionOption $deductionOption)
    {
    $deductionOption->delete();
    return redirect()->route('deductionOptions.index')->with('success', 'Deduction Type deleted successfully.');


    }
}
