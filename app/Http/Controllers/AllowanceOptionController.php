<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Allowance;
use Illuminate\Http\Request;
use App\Models\AllowanceOption;

class AllowanceOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $allowanceOptions = AllowanceOption::all();
        return view('/admin/allowanceOptions', compact('allowanceOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('allowanceOptions.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:allowance_options|max:20',
            'description' => 'nullable',


        ]);

        AllowanceOption::create($request->all());
        return redirect()->route('allowanceOptions.index')->with('success', 'Allowance created successfully.');
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
    public function edit(Request $request, AllowanceOption $allowanceOption)
    {
        $id = $request->input('id');
        $dataToUpdate = $request->only(['name', 'description']); // Get the fields to update from the request

        // Find the user by ID and update the data
        $user = AllowanceOption::findOrFail($id);
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
    public function destroy(AllowanceOption $allowanceOption)
    {
        //
        $allowanceOption->delete();
    return redirect()->route('allowanceOptions.index')->with('success', 'Allowance Type deleted successfully.');
    }
}
