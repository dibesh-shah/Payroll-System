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
    // $employeeId = session('employee_id');
    // $employee = Employee::find($employeeId);
    // $inboxes = Inbox::where('senderId', $employeeId)
    // ->orderBy('id', 'desc')
    // ->get();
    return view('admin.inbox', compact('employees'));
   }

   public function getUser($id){
    $employees = Employee::all();
    $emp = Employee::find($id);
    $inboxes = Inbox::where('conversationId', $id)
    ->orderBy('id', 'desc')
    ->get();
    return view('admin.inbox', compact('employees','emp', 'inboxes'));
   }

   public function indexEmp(){
    $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);
        // $senderId = $employeeId;
        // $inboxes = Inbox::find($senderId);
        $inboxes = Inbox::where('conversationId', $employeeId)
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
    $inboxMessage->conversationId = $request->input('receiverId');
    $inboxMessage->save();

    $newlySavedId = $inboxMessage->id;
    $responseData = $dateTime . "&" . $newlySavedId;
    return response($responseData);
   }

   public function storeEmp(Request $request){

    $inboxMessage = new Inbox();
    date_default_timezone_set('Asia/Kathmandu');
    $dateTime = date("F j, g:i A");
    $inboxMessage->dateTime = $dateTime;

    $inboxMessage->receiverId = Employee::where('role', 'admin')->value('id');
    $inboxMessage->senderId = $request->input('senderId');
    $inboxMessage->message = $request->input('message');
    $inboxMessage->conversationId = $request->input('senderId');
    $inboxMessage->save();

    $newlySavedId = $inboxMessage->id;
    $responseData = $dateTime . "&" . $newlySavedId;
    return response($responseData);
   }

   public function search(Request $request){
    $searchQuery = $request->input('search');
    $searches = Employee::where(function ($query) use ($searchQuery) {
        $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%$searchQuery%"])
            ->where('role', '!=', 'admin');
    })->get();
    return response($searches);
   }

   public function getMessage(Request $request){
    $lastId = $request->input('lastId');
    $senderId = $request->input('senderId');
    $inboxes = Inbox::where('conversationId', $senderId)
    ->where('id', '>', $lastId)
    ->orderBy('id', 'desc')
    ->get();
    return response($inboxes);
   }
}
