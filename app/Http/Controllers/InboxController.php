<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Inbox;
use Illuminate\Http\Request;

class InboxController extends Controller
{
   public function index(){
    $employees = Employee::all();
    $employeeId = session('employee_id');
    $employee = Employee::find($employeeId);
    $inboxes = Inbox::where('senderId', $employeeId)
    ->orderBy('id', 'desc')
    ->get();
    return view('admin.inbox', compact('employees','employee', 'inboxes'));
   }

   public function indexEmp(){
    $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);
        // $senderId = $employeeId;
        // $inboxes = Inbox::find($senderId);
        $inboxes = Inbox::where('senderId', $employeeId)
        ->orderBy('id', 'desc')
        ->get();
        // dd($inboxes);
    return view('employee.inbox', compact('employee', 'inboxes'));
   }

   public function store(Request $request){

    $inboxMessage = new Inbox();
    date_default_timezone_set('Asia/Kathmandu');
   $dateTime = date("F j, g:i A");
   $inboxMessage->dateTime = $dateTime;

    $inboxMessage->senderId = Employee::where('role', 'admin')->value('id');
    $inboxMessage->receiverId = $request->input('receiverId');
    $inboxMessage->message = $request->input('message');
    $inboxMessage->save();

    return response($dateTime);
   }

   public function storeEmp(Request $request){
    // Inbox::create($request->all());

    $inboxMessage = new Inbox();
    date_default_timezone_set('Asia/Kathmandu');
   $dateTime = date("F j, g:i A");
   $inboxMessage->dateTime = $dateTime;

    $inboxMessage->receiverId = Employee::where('role', 'admin')->value('id');
    $inboxMessage->senderId = $request->input('senderId');
    $inboxMessage->message = $request->input('message');
    $inboxMessage->save();
    // return back()->with('success', "hello");
    // echo $dateTime;
    return response($dateTime);
   }
}
