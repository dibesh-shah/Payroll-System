
@extends('layouts.app')

@section('content')


<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
       <div class="container mx-auto pt-8">
          <div class="flex items-center  mb-6 px-4 gap-x-3">
              <h1 class="text-3xl font-bold">Employee Details  </h1><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
              </svg>

              <h2 class="text-xl font-semibold "> User Filled details</h2>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="border p-4 rounded-md bg-white shadow-md">
                  <h2 class="text-lg font-bold mb-2">Employee Name</h2>
                  <p class="mb-2">{{$employee->first_name}} {{$employee->last_name}}</p>
              </div>
              <div class="border p-4 rounded-md bg-white shadow-md">
                  <h2 class="text-lg font-bold mb-2">Employee ID</h2>
                  <p class="mb-2">e10{{$employee->id}}</p>
              </div>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="border p-4 rounded-md bg-white shadow-md">
                <h2 class="text-lg font-bold mb-2">Email </h2>
                <p class="mb-2">{{$employee->email}}</p>
            </div>
            <div class="border p-4 rounded-md bg-white shadow-md">
                <h2 class="text-lg font-bold mb-2">Phone </h2>
                <p class="mb-2">{{$employee->phone}}</p>
            </div>
        </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="border p-4 rounded-md bg-white shadow-md">
                    <h2 class="text-lg font-bold mb-2">Gender </h2>
                    <p class="mb-2">{{$employee->gender}}</p>
                </div>
                <div class="border p-4 rounded-md bg-white shadow-md">
                    <h2 class="text-lg font-bold mb-2">Date of Birth </h2>
                    <p class="mb-2">{{$employee->date_of_birth}}</p>
                </div>
            </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Bank Name</h2>
                        <p class="mb-2">{{$employee->bank_name}}</p>
                    </div>
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Bank Account Number </h2>
                        <p class="mb-2">{{$employee->bank_account_number}}</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Address</h2>
                        <p class="mb-2">{{$employee->address}}</p>
                    </div>
                    <div class="border p-4 rounded-md bg-white shadow-md">
                        <h2 class="text-lg font-bold mb-2">Tax Payer Id </h2>
                        <p class="mb-2">{{$employee->tax_payer_id}}</p>
                    </div>
                </div>



      </div>
      <div class="container mx-auto ">
        <div class="flex items-center mt-2 mb-3 px-4 gap-x-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mt-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
              </svg>
            <h1 class="text-xl font-semibold"> Admin fillable </h1>
        </div>
        <form action="{{ route('employees.approve', $employee->id) }}" method="POST">
            @csrf
            <label for="date_of_joining">Date of Joining:</label>
            <input type="date" id="date_of_joining" name="date_of_joining" required>
            <br>
            <h3>Allowances:</h3>
            @foreach ($allowances as $allowance)
                <label for="allowance_{{ $allowance->id }}">{{ $allowance->name }}</label>
                <input type="checkbox" id="allowance_{{ $allowance->id }}" name="allowances[]" value="{{ $allowance->id }}">
                <input type="text" id="allowance_value_{{ $allowance->id }}" name="allowance_values[]" placeholder="Amount/Percentage">
                <select name="allowance_types[]">
                    <option value="percentage">Percentage</option>
                    <option value="amount">Amount</option>
                </select>
                <br>
            @endforeach
            <br>
            <h3>Deductions:</h3>
            @foreach ($deductions as $deduction)
                <label for="deduction_{{ $deduction->id }}">{{ $deduction->name }}</label>
                <input type="checkbox" id="deduction_{{ $deduction->id }}" name="deductions[]" value="{{ $deduction->id }}">
                <input type="text" id="deduction_value_{{ $deduction->id }}" name="deduction_values[]" placeholder="Amount/Percentage">
                <select name="deduction_types[]">
                    <option value="percentage">Percentage</option>
                    <option value="amount">Amount</option>
                </select>
                <br>
            @endforeach
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Approve</button>
        </form>

              <div class="mt-4 flex justify-between">

                  <form action="{{route('employees.reject', $employee->id)}}" method="POST">
                      @csrf
                      <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Reject</button>
                  </form>

              </div>


    </div>
    </div>
 </div>
 @endsection
