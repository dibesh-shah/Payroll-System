@extends('layouts.master')
@section('content')


<div class="p-4 sm:ml-64 mx-auto">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class=" bg-white p-6 rounded-lg shadow-lg" >
        <!-- My Information -->
        <fieldset class="border p-4 rounded w-full">
            <legend class="font-semibold mb-4 text-xl">My Information</legend>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="font-semibold ">First Name:</div>
                    <div class="font-normal mt-1 mb-2">{{$employee->first_name}}</div>
                </div>
                <div>
                    <div class="font-semibold ">Last Name:</div>
                    <div class="font-normal mt-1 mb-2">{{$employee->last_name}}</div>
                </div>
                <div>
                    <div class="font-semibold">Email:</div>
                    <div class="font-normal mt-1 mb-2">{{$employee->email}}</div>
                </div>
                <div>
                    <div class="font-semibold">Address:</div>
                    <div class="font-normal mt-1 mb-2">{{$employee->address}}</div>
                </div>
                <div>
                    <div class="font-semibold">Bank:</div>
                    <div class="font-normal mt-1 mb-2">{{$employee->bank_name}}</div>
                </div>
                <div>
                    <div class="font-semibold">Bank Account:</div>
                    <div class="font-normal mt-1 mb-2">{{$employee->bank_account_number}}</div>
                </div>

                <!-- Add other fields here -->
            </div>
        </fieldset>

        <!-- Salary -->
        <fieldset class="border p-4 rounded mt-4 ">
            <legend class="font-semibold mb-4 text-xl">Salary</legend>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="font-semibold">Basic Salary:</div>
                    <div class="font-normal mt-1 mb-2">Rs. {{ $employee->salary }}</div>
                </div>
            </div>
        </fieldset>

        <!-- Allowance -->
        <fieldset class="border p-4 rounded mt-4">
            <legend class="font-semibold mb-4 text-xl">Allowances</legend>
            <div class="grid grid-cols-2 gap-2">
            @if (!$allowances)
                        <div>No allowances </div>
                        @else
                            @foreach ($allowances as $allowance)



                            <div>
                            <div class="font-semibold">{{ $allowance->name }}</div>
                            <div class="font-normal mt-1 mb-2">  {{ $allowance->pivot->value }}
                                @if($allowance->pivot->type== 'percentage')
                                    %
                                @else
                                  Nrs.
                                @endif
                               </div>
                        </div>




                @endforeach
                @endif
            </div>
        </fieldset>

        <!-- Deduction -->
        <fieldset class="border p-4 rounded mt-4">
            <legend class="font-semibold mb-4 text-xl">Deductions</legend>
            <div class="grid grid-cols-2 gap-2">
                @if (!$deductions)
                <div>No allowances </div>

                    @else
                    @foreach ($deductions as $deduction)


                    <div>
                    <div class="font-semibold">{{ $deduction->name }}</div>
                    <div class="font-normal mt-1 mb-2"> {{ $deduction->pivot->value }}
                        @if($deduction->pivot->type== 'percentage')
                        %
                    @else
                      Nrs.
                    @endif
                </div>
                </div>
                @endforeach
                @endif

            </div>
        </fieldset>
    </div>

   </div>
</div>

@endsection
