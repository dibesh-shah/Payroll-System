<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
class MailController extends Controller
{
    public function index(){
        // $mailData = [
        //     'title' => "Mail from Payroll",
        //     'body' => "This if for testing ",
        // ];

        try {
            $mailData = "dibesh";

        if(Mail::to('dbex7502@gmail.com')->send(new DemoMail($mailData))){
            dd('email  semt');
        }else{
        dd('Email sent not joeh');
        }
        } catch (\Exception $e) {
            dd('Error sending email: ' . $e->getMessage());
        }
        

            //         $to_name = "joeh";
            // $to_email = "dbex7502@gmail.com";
            // $data = array('name'=>'Ogbonna Vitalis(sender_name)', 'body' => 'A test mail');
            // Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            //     $message->to($to_email, $to_name)
            //     ->subject('Laravel Test Mail');
            //     $message->from("joeh5730@gmail.com",'Test Mail');
            // });

        
    }
}

