
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
                 @if(session('error'))
                    <div class="text-red-500 text-2xl font-bold ">
                        {{ session('error') }}
                    </div>
                @endif
          </div>
          <div class="grid grid-cols-2 gap-2  bg-white shadow-md rounded-md p-6">
            <div>
                <div class="font-semibold ">Employee Id:</div>
                <div class="font-normal mt-1 mb-2">{{$employee->id}}</div>
            </div>
            <div>
                <div class="font-semibold ">Full Name:</div>
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
                @if ($employee->document)
                <div class="font-semibold">Employee Document</div>

                <a href="{{ route('employee.document', $employee->document) }}" target="_blank">{{$employee->document}}</a>
            </div>

            @endif



            <!-- Add other fields here -->

      </div>
      <div class="container mx-auto mt-8">

            <div class=" bg-white p-6 rounded-lg shadow-lg" >
            <fieldset class="border p-4 rounded w-full">
                <legend class="font-semibold mb-4 text-xl">Admin fillable</legend>


        <form action="{{ route('employees.approve', $employee->id) }}" method="POST" id="my_form" onsubmit="return validateForm()">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ">
            <div class="mb-4">
                <label class="block font-bold mb-1" for="hiring_date">Date of Hiring:
                    <span id="hiringDateError" class="text-red-500 text-sm font-bold"></span>

                </label>
                <input type="date" id="hiring_date" name="hiring_date" max="{{ now()->format('Y-m-d') }}" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" for="date_of_joining">Date of Joining:
                    <span id="joiningDateError" class="text-red-500 text-sm font-bold"></span>

                </label>
                <input type="date" id="date_of_joining" name="date_of_joining" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            
          
            <div class="mb-4">
                <label class="block font-bold mb-1" for="basic_salary">Designation:</label>
                <input type="text" id="designation" name="designation" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1" for="basic_salary">Department</label>
                <select name="department_id" id="" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50">
                    @foreach ($departments as $department)
                    <option value="{{$department->id}}">{{$department->name}}</option>
                    @endforeach
                </select>

            </div>

            <!-- Basic Salary -->
            <div class="mb-4">
                <label class="block font-bold mb-1" for="basic_salary">Basic Salary:
                    <span id="salaryError" class="text-red-500 text-sm font-bold"></span>
                </label>
                <input type="text" id="basic_salary" name="basic_salary" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-opacity-50" required>
            </div>
            </div>


            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 ">
                <div class="border p-4 rounded-md bg-white shadow-md">
                    <h3 class="font-bold">Allowances:</h3>
                    @foreach ($allowances as $allowance)

                            <div class="flex items-center mt-2 mb-2 gap-2">
                                <div class="w-1/3 flex justify-between">
                                    <label class="flex items-center pr-4 font-semibold" for="allowance_{{ $allowance->id }}">
                                        {{ $allowance->name }}
                                    </label>
                                    <input class="h-5 w-5" type="checkbox" id="allowance_{{ $allowance->id }}" name="allowances[]" value="{{ $allowance->id }}">
                                </div>


                                <input class="mr-2 px-2 py-1 border rounded" type="text" id="allowance_value_{{ $allowance->id }}" name="allowance_values[]" placeholder="Amount/Percentage">
                                <select class="px-2 py-1" name="allowance_types[]" required>
                                    <option value="percentage">%</option>
                                    <option value="amount">Rs</option>
                                </select>
                            </div>

                    @endforeach
                </div>



                <div class="border p-4 rounded-md bg-white shadow-md">

                    <h3 class="font-bold">Deductions:</h3>
                    @foreach ($deductions as $deduction)
                    <div class="flex items-center mt-2 mb-2 gap-2">
                        <div class="w-1/3 flex justify-between">
                            <label for="deduction_{{ $deduction->id }}" class="flex items-center pr-4 font-semibold">{{ $deduction->name }}</label>
                            <input  class="h-5 w-5" type="checkbox" id="deduction_{{ $deduction->id }}" name="deductions[]" value="{{ $deduction->id }}">
                         </div>


                        <input type="text"  class="mr-2 px-2 py-1 border rounded" id="deduction_value_{{ $deduction->id }}" name="deduction_values[]" placeholder="Amount/Percentage">

                        <select name="deduction_types[]" class="px-2 py-1">
                            <option value="percentage">%</option>
                            <option value="amount">Rs</option>
                        </select>
                    </div>
                    @endforeach
                </div>
                <div class="border p-4 rounded-md bg-white shadow-md">

                    <h3 class="font-bold">Leave Types </h3>
                    @foreach ($leaves as $leave)
                    <div class="flex items-center mt-2 mb-2 gap-2">
                        <div class="w-1/3 flex justify-between">
                            <label for="leave_{{ $leave->id }}" class="flex items-center pr-4 font-semibold">{{ $leave->name }}</label>
                            <input class="h-5 w-5" type="checkbox" id="leave_{{ $leave->id }}" name="leaves[]" value="{{ $leave->id }}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

         </form>
            <div class="mt-4 flex flex-wrap justify-start gap-2">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 mt-4 rounded" form="my_form">Approve</button>
                <form action="{{route('employees.reject', $employee->id)}}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-6 rounded">Reject</button>
                </form>

            </div>
        </fieldset>
    </div>

    </div>
    </div>
 </div>

 <script>
    function validateForm() {
        var hiringDateInput = document.getElementById('hiring_date');
        var joiningDateInput = document.getElementById('date_of_joining');
        var hiringDateErrorSpan = document.getElementById('hiringDateError');
        var joiningDateErrorSpan = document.getElementById('joiningDateError');
        var salaryErrorSpan = document.getElementById('salaryError');

        // Get the current date
        var currentDate = new Date().toISOString().split('T')[0];

        // Check if hiring date is in the future
        if (hiringDateInput.value > currentDate) {
            hiringDateErrorSpan.innerText = '*Hiring date cannot be in the future';
            return false;
        }else {
            hiringDateErrorSpan.innerText = ''; 
        }

        // Check if joining date is less than hiring date
        if (joiningDateInput.value && joiningDateInput.value < hiringDateInput.value) {
            joiningDateErrorSpan.innerText = '*Joining date must be equal or greater than hiring date';
            return false;
        }else {
            joiningDateErrorSpan.innerText = ''; 
        }

        var basicSalaryInput = document.getElementById('basic_salary');

        // Check if basic salary is a valid number
        if (isNaN(basicSalaryInput.value)) {
            salaryErrorSpan.innerText = "*Please enter a valid number for Basic Salary";
            return false;
        }else{
            salaryErrorSpan.innerText = "";
        }

        // Check if basic salary is less than 17300
        if (parseInt(basicSalaryInput.value) < 17300) {
            salaryErrorSpan.innerText = "*Basic Salary must be equal to or greater than minimum wage(17300)";
            return false;
        }else{
            salaryErrorSpan.innerText = "";
        }

        return true;
    }
</script>
 @endsection
