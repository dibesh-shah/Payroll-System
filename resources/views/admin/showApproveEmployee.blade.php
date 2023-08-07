
@extends('layouts.app')

@section('content')


<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
       <div class="container mx-auto py-8">
          <div class="flex items-center justify-between mb-6">
              <h1 class="text-3xl font-bold">Employee Details</h1>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <!-- Employee details here (dummy data) -->
              <div class="border p-4 rounded-md bg-white shadow-md">
                  <h2 class="text-lg font-bold mb-2">Employee Name</h2>
                  <p class="mb-2">{{$employee->first_name}} {{$employee->last_name}}</p>
                  <!-- Add more details here as needed -->
              </div>
              <div class="border p-4 rounded-md bg-white shadow-md">
                  <h2 class="text-lg font-bold mb-2">Employee ID</h2>
                  <p class="mb-2">{{$employee->id}}</p>
                  <!-- Add more details here as needed -->
              </div>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Employee details here (dummy data) -->
            <div class="border p-4 rounded-md bg-white shadow-md">
                <h2 class="text-lg font-bold mb-2">Email </h2>
                <p class="mb-2">{{$employee->email}}</p>
                <!-- Add more details here as needed -->
            </div>
            <div class="border p-4 rounded-md bg-white shadow-md">
                <h2 class="text-lg font-bold mb-2">Phone </h2>
                <p class="mb-2">{{$employee->phone}}</p>
                <!-- Add more details here as needed -->
            </div>
        </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Employee details here (dummy data) -->
                <div class="border p-4 rounded-md bg-white shadow-md">
                    <h2 class="text-lg font-bold mb-2">Gender </h2>
                    <p class="mb-2">{{$employee->gender}}</p>
                    <!-- Add more details here as needed -->
                </div>
                <div class="border p-4 rounded-md bg-white shadow-md">
                    <h2 class="text-lg font-bold mb-2">Date of Birth </h2>
                    <p class="mb-2">{{$employee->date_of_birth}}</p>
                    <!-- Add more details here as needed -->
                </div>
            </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Employee details here (dummy data) -->
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Bank Name</h2>
                        <p class="mb-2">{{$employee->bank_name}}</p>
                        <!-- Add more details here as needed -->
                    </div>
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Bank Account Number </h2>
                        <p class="mb-2">{{$employee->bank_account_number}}</p>
                        <!-- Add more details here as needed -->
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Employee details here (dummy data) -->
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Address</h2>
                        <p class="mb-2">{{$employee->address}}</p>
                        <!-- Add more details here as needed -->
                    </div>
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Tax Payer Id </h2>
                        <p class="mb-2">{{$employee->tax_payer_id}}</p>
                        <!-- Add more details here as needed -->
                    </div>
                </div>
                <div class="mt-4 flex justify-between">
                    {{-- @if($employee->approval && !$employee->approval->is_approved) --}}
                    <form action="{{route('employees.approve', $employee->id)}}" method="POST">
                        {{-- action="{{ route('employees.approve', $employee->approval->id) }}"  --}}
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Approve</button>
                    </form>
                    <form action="{{route('employees.reject', $employee->id)}}" method="POST">
                        {{-- action="{{ route('employees.reject', $employee->approval->id) }}" --}}
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Reject</button>
                    </form>
                    {{-- @endif --}}

                </div>


      </div>
    </div>
 </div>
 @endsection
