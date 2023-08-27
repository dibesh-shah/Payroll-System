
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
          <div class="grid grid-cols-2 gap-2  bg-white shadow-md rounded-md p-6">
            <div>
                <div class="font-semibold ">Employee Id:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->id}}</div>
            </div>
            <div>
                <div class="font-semibold ">Last Name:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->first_name}} {{$employee->last_name}}</div>
            </div>
            <div>
                <div class="font-semibold">Email:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->email}}</div>
            </div>
            <div>
                <div class="font-semibold">Contact:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->phone}}</div>
            </div>
            <div>
                <div class="font-semibold">Date of Birth:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->date_of_birth}}</div>
            </div>
            <div>
                <div class="font-semibold">Gender:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->gender}}</div>
            </div>
            <div>
                <div class="font-semibold">Permanent Address:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->permanent_address}}</div>
            </div>
            <div>
                <div class="font-semibold">Mailing Address:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->mailing_address}}</div>
            </div>
            <div>
                <div class="font-semibold">Bank:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->bank_name}}</div>
            </div>
            <div>
                <div class="font-semibold">Bank Account:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->bank_account_number}}</div>
            </div>
            <div>
                <div class="font-semibold">Tax Payer Id:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->tax_payer_id}}</div>
            </div>
            <div>
                <div class="font-semibold">Tax_Filing_Status:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->tax_filing_status}}</div>
            </div>
            <div>
                <div class="font-semibold">Department:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->department_id}}</div>
            </div>

            <!-- Add other fields here -->
        
      </div>
      <div class="container mx-auto mt-8">
        
            <div class=" bg-white p-6 rounded-lg shadow-lg" >
            <fieldset class="border p-4 rounded w-full">
                <legend class="font-semibold mb-4 text-xl">Admin fillable</legend>


        <form action="{{ route('employees.approve', $employee->id) }}" method="POST">
            @csrf
            {{-- <label for="date_of_joining">Date of Joining:</label>
            <input type="date" id="date_of_joining" name="date_of_joining" required> --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ">
            <div class="mb-4">
                <label class="block font-bold mb-1" for="date_of_hiring">Date of Hiring:</label>
                <input type="date" id="date_of_hiring" name="date_of_hiring" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" for="date_of_joining">Date of Joining:</label>
                <input type="date" id="date_of_joining" name="date_of_joining" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            <!-- Basic Salary -->
            <div class="mb-4">
                <label class="block font-bold mb-1" for="basic_salary">Basic Salary:</label>
                <input type="text" id="basic_salary" name="basic_salary" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            </div>
            

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ">
                <div class="border p-4 rounded-md bg-white shadow-md">
                    <h3 class="font-bold">Allowances:</h3>
                    @foreach ($allowances as $allowance)
                        <div class="flex items-center  mb-2">
                            <label class="flex items-center pr-4" for="allowance_{{ $allowance->id }}">
                                {{ $allowance->name }}
                            </label>
                            <input class="h-6 w-6" type="checkbox" id="allowance_{{ $allowance->id }}" name="allowances[]" value="{{ $allowance->id }}">
                        </div>
                        <div class="flex items-center mb-2">
                            <input class="mr-2 px-2 py-1 border rounded" type="text" id="allowance_value_{{ $allowance->id }}" name="allowance_values[]" placeholder="Amount/Percentage">
                            <select class="w-1/3 px-2 py-1 border rounded" name="allowance_types[]" required>
                                <option value="percentage">Percentage</option>
                                <option value="amount">Amount</option>
                            </select>
                        </div>
                    @endforeach
                </div>



                <div class="border p-4 rounded-md bg-white shadow-md">

                    <h3 class="font-bold">Deductions:</h3>
                    @foreach ($deductions as $deduction)
                    <div class="flex items-center  mb-2">
                        <label for="deduction_{{ $deduction->id }}" class="flex items-center pr-4">{{ $deduction->name }}</label>
                        <input  class="h-6 w-6" type="checkbox" id="deduction_{{ $deduction->id }}" name="deductions[]" value="{{ $deduction->id }}">
                    </div>

                        <div class="flex items-center mb-2">
                        <input type="text"  class="mr-2 px-2 py-1 border rounded" id="deduction_value_{{ $deduction->id }}" name="deduction_values[]" placeholder="Amount/Percentage">

                        <select name="deduction_types[]" class="w-1/3 px-2 py-1 border rounded">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 mt-4 rounded">Approve</button>
        </form>

              <div class="mt-4 flex justify-between">

                  <form action="{{route('employees.reject', $employee->id)}}" method="POST">
                      @csrf
                      <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Reject</button>
                  </form>

              </div>

            </fieldset>
            </div>
    </div>
    </div>
 </div>
 @endsection
