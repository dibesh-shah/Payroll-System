<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function handleAjaxRequest(Request $request)
    {
        // Access the data sent via Ajax
        $data = $request->all();
        return $data;
        // Process the data (optional)
        // ...

        // Return a response (optional)
        // return response()->json(['message' => 'Data received successfully']);
    }
}
