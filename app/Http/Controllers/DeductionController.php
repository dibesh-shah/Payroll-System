<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deductions = Deduction::all();
        return view('/admin/deduction', compact('deductions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('decuction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:deductions|max:20',
            'description' => 'nullable',


        ]);

        Deduction::create($request->all());
        return redirect()->route('deduction.index')->with('success', 'Deduction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deduction $deduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Deduction $deduction)
    {
        $id = $request->input('id');
        $dataToUpdate = $request->only(['name', 'description']); // Get the fields to update from the request

        // Find the user by ID and update the data
        $user = Deduction::findOrFail($id);
        $user->update($dataToUpdate);

        return response()->json(['message' => 'Data updated successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deduction $deduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deduction $deduction)
    {
        $deduction->delete();
        return redirect()->route('deduction.index')->with('success', 'Deduction Type deleted successfully.');
    }
}
