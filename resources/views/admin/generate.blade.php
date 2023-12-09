@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
  <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
   <div class="container mx-auto mt-5">
       <h1 class="text-3xl font-bold mb-4">Search Employee</h1>
       <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
               <div class="grid grid-cols-2 gap-6">
                   <div class="flex items-center mb-2">
                       <input type="text" id="type" name="type" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Employee Name or ID" required>
                       <button class="ml-4 px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">Generate</button>
                   </div>    
               </div>
       </div>

       <div class="container mx-auto mt-5 p-4 bg-white p-6 rounded-lg shadow-lg">
        @php
            $year = date('Y');
            $month = date('m');

            $lastDate = date('Y-m-t', strtotime("$year-$month-01"));
            $today = date('Y-m-d');
        @endphp
        @if ($today == $lastDate)
            <div class="bg-blue-200 p-4 rounded-md shadow-md">
                <p class="text-blue-800 font-semibold">Payroll Generation </p>
                <p class="text-blue-600"> Payroll generation is scheduled for the date {{$lastDate}}.</p>
            </div>
        @else
        <h1 class="text-3xl font-bold mb-4">Generated Payroll - October</h1>
        <div class="bg-white p-4 rounded shadow mb-4">

         <div class="grid grid-cols-1 md:grid-cols-2 gap-4  ">
             
             @foreach ($employees as $employee)
                <div class="bg-white p-4 rounded-md shadow-lg " >
                    <h2 class="text-xl font-bold"></h2>
                    <p class="text-gray-500"><strong class="text-lg">Employee Name:</strong> {{$employee->first_name}} {{$employee->last_name}} </p>
                    <p class="text-gray-500"> <strong class="text-lg">Month:</strong> {{ now()->subMonth()->format('F Y') }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('payroll.payroll', ['id' => $employee->id]) }}" class="bg-blue-500 text-white py-2 px-4 mr-4">View Details</a>  
                    </div>
                </div>
             @endforeach
                 
         </div>
        @endif
           
        </div>
        
    </div>
       </div>
   </div>
   
  </div>
</div>

@endsection