<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $leaves = Leave::all();

        return view('admin/leave', ['leaves' => $leaves]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('leave.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:leaves',
            'days' => 'required|integer',
            'type' => 'required|in:paid,unpaid',
        ]);
        Leave::create($request->all());
        return redirect()->route('leave.index')->with('success', 'Leave Type created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Leave $leave)
    {
        $id = $request->input('id');
        $dataToUpdate = $request->only(['name', 'days', 'type']); // Get the fields to update from the request

        // Find the user by ID and update the data
        $user = Leave::findOrFail($id);
        $user->update($dataToUpdate);

        return response()->json(['message' => 'Data updated successfully']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect()->route('leave.index')->with('success', 'Leave Type deleted successfully.');
    }


}
