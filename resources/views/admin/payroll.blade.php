@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
  <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
   <div class="container mx-auto mt-5">
    @php
     $totalEarnings = 0; 
     $totalDeductions = 0; 
    @endphp

       <div class="container mx-auto mt-5 p-4 bg-white p-6 rounded-lg shadow-lg">
           <h1 class="text-3xl font-bold mb-4"> Payroll</h1>

            <div class="bg-white p-4 rounded shadow">
                <div class="text-center">
                    <h2 class="text-xl font-semibold">{{$employee->first_name}} {{$employee->last_name}}'s Payroll - {{date("F")." ".date("Y")}}</h2>
                </div>
                <div class="p-4 ">
                    <div class="my-4">
                        <form method="POST" action="">
                            <table class="w-full border-collapse mb-4">
                                <tr>
                                    <td class="w-2/3 py-2"><strong>Employee ID:</strong> E{{$employee->id}}</td>
                                    <td class="w-1/3 py-2" ><strong>Designation:</strong> Software Engineer</td>
                                    
                                </tr>
                                <tr class="border-b border-black">
                                    <td class="w-1/3 py-2"><strong>Date of Salary:</strong> {{date("Y-m-t")}}</td>
                                    <td class="w-1/3 py-2"><strong>Salary Month:</strong> {{date("F")}}</td>
                                </tr>
                            </table>
                            <table class="w-full border-collapse">
                                
                                <tr>
                                    <td class="w-1/3 py-2 "><strong class="border-black border-b">EARNINGS</strong></td>
                                    
                                </tr>
                                <tr>
                                    <td class="w-1/3 py-2">Basic Salary</td>
                                    <td class="w-2/3 py-2">{{$employee->salary}}</td>
                                    @php
                                        $totalEarnings+=$employee->salary;
                                    @endphp
                                </tr>
                                @foreach ($allowances as $allowance )
                                    <tr>
                                        <td class="w-1/3 py-2">{{ $allowance->name }}</td>
                                        @if($allowance->pivot->type == 'amount')
                                            <td class="w-2/3 py-2">{{ $allowance->pivot->value }}</td>
                                            @php
                                                $totalEarnings += $allowance->pivot->value;
                                            @endphp
                                        @else
                                        @php
                                            $earnings = ($allowance->pivot->value / 100) * $employee->salary;
                                            $totalEarnings += $earnings;
                                        @endphp
                                            <td class="w-2/3 py-2">{{ $earnings }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                                
                                
                                {{-- <tr>
                                    <td class="w-1/3 py-2">Overtime</td>
                                    <td class="w-2/3 py-2">1000</td>
                                </tr> --}}
                                <tr>
                                    <td class="w-1/3 py-2 "><strong>Total Earnings (Gross Salary) (A):</strong></td>
                                    <td class="w-2/3 py-2">{{$totalEarnings}}</td>
                                </tr>

                                <tr>
                                    <td class="w-1/3 py-2 "><strong class="border-black border-b">DEDUCTIONS</strong></td>
                                </tr>
                                @foreach ($deductions as $deduction )
                                <tr>
                                    <td class="w-1/3 py-2">{{ $deduction->name }}</td>
                                    @if($deduction->pivot->type == 'amount')
                                        <td class="w-2/3 py-2">{{ $deduction->pivot->value }}</td>
                                        @php
                                            $totalDeductions += $deduction->pivot->value;
                                        @endphp
                                    @else
                                    @php
                                        $value = ($deduction->pivot->value / 100) * $employee->salary;
                                        $totalDeductions += $value;
                                    @endphp
                                        <td class="w-2/3 py-2">{{ $value }}</td>
                                    @endif
                                </tr> 
                                @endforeach
                                
                                <tr>
                                    <td class="w-1/3 py-2"><strong>Total Deductions (B):</strong></td>
                                    <td class="w-2/3 py-2">{{$totalDeductions}}</td>
                                </tr>
                                <tr>
                                    <td class="w-1/3 py-2"><strong>Net Pay (A-B):</strong></td>
                                    <td class="w-2/3 py-2">{{$totalEarnings - $totalDeductions}}</td>
                                </tr>
                               
                            </table>
                        </form>
                        <div class="mt-4">
                            <button class="bg-green-500 text-white py-2 px-4 mr-4">Approve</button>
                            <button class="bg-red-500 text-white py-2 px-4">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        </div>
        

    </div>
       </div>
   </div>
   
  </div>
</div>

@endsection