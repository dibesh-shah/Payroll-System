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
    public function edit(Request $request, LeaveType $leaveType)
    {
        //
        // dd($leaveType);
        // return route('leaveTypes.edit', compact('leaveType'));
          // Access the data sent via Ajax
        //   $data = $request->all();
        //   $leavetype->update(['value' => $data]);

        //   return $data;
          // Process the data (optional)
          // ...

          // Return a response (optional)
          // return response()->json(['message' => 'Data received successfully']);
          $id = $request->input('id');
        $dataToUpdate = $request->only(['name', 'days', 'type']); // Get the fields to update from the request

        // Find the user by ID and update the data
        $user = LeaveType::findOrFail($id);
        $user->update($dataToUpdate);

        return response()->json(['message' => 'Data updated successfully']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveType $leaveType)
    {
        //
        // $data = $request->validate([
        //     'name' => 'required|max:255|unique:leave_types',
        //     'days' => 'required|integer',
        //     'type' => 'required|in:paid,unpaid',
        // ]);

        // $leaveType->update($data);
        // return redirect()->route('leaveTypes.index')->with('success', 'Leave Type updated successfully.');
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
