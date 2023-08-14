<?php

namespace App\Http\Controllers;

use App\Models\Allowance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AllowanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allowances = Allowance::all();
        return view('/admin/allowance', compact('allowances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('allowance.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:allowances|max:20',
            'description' => 'nullable',


        ]);

        Allowance::create($request->all());
        return redirect()->route('allowance.index')->with('success', 'Allowance created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Allowance $allowance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Allowance $allowance)
    {
        $id = $request->input('id');
        $dataToUpdate = $request->only(['name', 'description']); // Get the fields to update from the request

        // Find the user by ID and update the data
        $user = Allowance::findOrFail($id);
        $user->update($dataToUpdate);

        return response()->json(['message' => 'Data updated successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Allowance $allowance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Allowance $allowance)
    {
        $allowance->delete();
    return redirect()->route('allowance.index')->with('success', 'Allowance Type deleted successfully.');
    }
}
