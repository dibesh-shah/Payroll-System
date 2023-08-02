<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $leaveTypes = LeaveType::all();

        return view('/admin/leaveTypes', ['leaveTypes' => $leaveTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('leaveTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255|unique:leave_types',
            'days' => 'required|integer',
            'type' => 'required|in:paid,unpaid',
        ]);
        LeaveType::create($request->all());
        return redirect()->route('leaveTypes.index')->with('success', 'Leave Type created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leaveType)
    {
        //
        return view('leaveTypes.edit', compact('leaveType'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveType $leaveType)
    {
        //
        $request->validate([
            'name' => 'required|max:255|unique:leave_types,name,' . $leaveType->id,
            'days' => 'required|integer',
            'type' => 'required|in:paid,unpaid',
        ]);

        $leaveType->update($request->all());
        return redirect()->route('leaveTypes.index')->with('success', 'Leave Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leaveType)
    {
        //
        $leaveType->delete();
        return redirect()->route('leaveTypes.index')->with('success', 'Leave Type deleted successfully.');
    }
}
