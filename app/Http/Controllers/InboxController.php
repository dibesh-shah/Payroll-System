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
    $chatKey = $emp->chatKey;
    $inboxx = Inbox::where('conversationId', $id)
    ->orderBy('id', 'desc')
    ->get();

    $inboxes = [];
    foreach ($inboxx as $inbox) {
        $decryptedMessage = $this->decryptMessage($inbox->message,$chatKey);
        
        // Add the decrypted message to the inbox data
        $inboxData = $inbox->toArray();
        $inboxData['decrypted_message'] = $decryptedMessage;

        $inboxes[] = $inboxData;
    }
    return view('admin.inbox', compact('employees','emp', 'inboxes'));
   }

   public function indexEmp(){
    $employeeId = session('employee_id');
        $employee = Employee::find($employeeId);
        $chatKey = $employee->chatKey;
        // $senderId = $employeeId;
        // $inboxes = Inbox::find($senderId);
        $inboxx = Inbox::where('conversationId', $employeeId)
        ->orderBy('id', 'desc')
        ->get();
        // dd($inboxes);

        // Decrypt each message before passing it to the view
    $inboxes = [];
    foreach ($inboxx as $inbox) {
        $decryptedMessage = $this->decryptMessage($inbox->message,$chatKey);
        
        // Add the decrypted message to the inbox data
        $inboxData = $inbox->toArray();
        $inboxData['decrypted_message'] = $decryptedMessage;

        $inboxes[] = $inboxData;
    }
    return view('employee.inbox', compact('employee', 'inboxes'));
   }

   public function store(Request $request){

    $inboxMessage = new Inbox();
    date_default_timezone_set('Asia/Kathmandu');
   $dateTime = date("F j, g:i A");
   $inboxMessage->dateTime = $dateTime;

    $inboxMessage->senderId = Employee::where('role', 'admin')->value('id');
    $inboxMessage->receiverId = $request->input('receiverId');

    $employee = Employee::find($request->input('receiverId'));
    $chatKey = $employee->chatKey;
    $message = $request->input('message');
    $encryptedMessage = $this->encryptMessage($message,$chatKey);
    $inboxMessage->message = $encryptedMessage;

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

    $employee = Employee::find($request->input('senderId'));
    $chatKey = $employee->chatKey;

    $message = $request->input('message');
    $encryptedMessage = $this->encryptMessage($message,$chatKey);
    $inboxMessage->message = $encryptedMessage;

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

    $employee = Employee::find($senderId);
    $chatKey = $employee->chatKey;

    $inboxes = Inbox::where('conversationId', $senderId)
    ->where('id', '>', $lastId)
    ->orderBy('id', 'desc')
    ->get();

    $decryptedInboxes = [];
    foreach ($inboxes as $inbox) {
        $decryptedMessage = $this->decryptMessage($inbox->message, $chatKey);

        // Add the decrypted message to the inbox data
        $inboxData = $inbox->toArray();
        $inboxData['decrypted_message'] = $decryptedMessage;

        $decryptedInboxes[] = $inboxData;
    }

    return response()->json($decryptedInboxes);
   }

   private function encryptMessage($message,$chatKey)
{
    // Replace 'YOUR_SECRET_KEY' with your actual secret key
    $secretKey = $chatKey;

    // Choose a cipher method (e.g., AES-256-CBC)
    $cipherMethod = 'AES-256-CBC';

    // Generate a random initialization vector (IV)
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipherMethod));

    // Encrypt the message
    $encryptedMessage = openssl_encrypt($message, $cipherMethod, $secretKey, 0, $iv);

    // Concatenate the IV with the encrypted message
    $result = base64_encode($iv . $encryptedMessage);

    return $result;
}

public function decryptMessage($encryptedMessage,$chatKey)
{
    // Replace 'YOUR_SECRET_KEY' with your actual secret key
    $secretKey = $chatKey;

    // Choose a cipher method (e.g., AES-256-CBC)
    $cipherMethod = 'AES-256-CBC';

    // Decode the base64-encoded string to get the IV and encrypted message
    $decoded = base64_decode($encryptedMessage);

    // Extract the IV from the decoded string
    $ivLength = openssl_cipher_iv_length($cipherMethod);
    $iv = substr($decoded, 0, $ivLength);

    // Extract the encrypted message from the decoded string
    $encryptedMessage = substr($decoded, $ivLength);

    // Decrypt the message
    $decryptedMessage = openssl_decrypt($encryptedMessage, $cipherMethod, $secretKey, 0, $iv);

    return $decryptedMessage;
}

}
