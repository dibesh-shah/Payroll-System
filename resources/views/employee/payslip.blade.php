@extends('layouts.master')

@section('content')
<div class="p-4 sm:ml-64">
  <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
   <div class="container mx-auto mt-5">
    @php
     $totalEarnings = 0;
     $Deductions =0; 
     $totalDeductions = 0; 
     $monthlyAllowance = 0;
     $basicSalary = $employee->salary;
     $pfcount = 0;
    @endphp

       <div class="container mx-auto mt-5 p-4 bg-white p-6 rounded-lg shadow-lg">
           <h1 class="text-3xl font-bold mb-4"> Payroll</h1>

            <div class="bg-white p-4 rounded shadow">
                <div class="text-center">
                    <h2 class="text-xl font-semibold">Payroll Statement - {{ now()->subMonth()->format('F Y') }}
                    </h2>
                </div>
                <div class="p-4 ">
                    <div class="my-4">
                        <form method="POST" action=""{{route('payroll.approve')}}"">
                            <table class="w-full border-collapse mb-4">
                                <tr>
                                    <td class="w-2/3 py-2"><strong>Employee ID:</strong> E{{$employee->id}}</td>
                                    <td class="w-1/3 py-2"><strong>Date of Salary:</strong> {{ date("Y-m-t", strtotime("last month"))}}</td>
                                    
                                </tr>
                                <tr class="border-b border-black">
                                    <td class="w-1/3 py-2" ><strong>Employee's Name:</strong> {{$employee->first_name}} {{$employee->last_name}}</td>
                                    <td class="w-1/3 py-2" ><strong>Designation:</strong> {{$employee->designation}}</td>
                                    </td>
                                </tr>
                            </table>
                            <table class="w-full border-collapse">
                                
                                <tr>
                                    <td class="w-1/3 py-2 "><strong class="border-black border-b">EARNINGS</strong></td>
                                    
                                </tr>
                                <tr>
                                    <td class="w-2/3 py-2">Basic Salary</td>
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
                                                $monthlyAllowance += $allowance->pivot->value;
                                            @endphp
                                        @else
                                        @php
                                            $earnings = ($allowance->pivot->value / 100) * $employee->salary;
                                            $totalEarnings += $earnings;
                                            $monthlyAllowance += $allowance->pivot->value;
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
                                    <td class="w-2/3 py-2"><strong>{{ number_format($totalEarnings, 2)}}</strong></td>
                                </tr>

                                <tr>
                                    <td class="w-1/3 py-2 "><strong class="border-black border-b">DEDUCTIONS</strong></td>
                                </tr>
                                @foreach ($deductions as $deduction )
                                <tr>
                                    
                                    @if ($deduction->name === "PF")
                                        @php
                                            // $yearly = $basicSalary*12 + $monthlyAllowance*12 + 0.1*($basicSalary * 12);
                                            // $pfValue = min((1/3)*$yearly , 300000, 0.2*($basicSalary * 12)) / 12;
                                            $pfcount++;
                                            // echo"<td class='w-2/3 py-2'>$pfValue</td>";
                                            continue;
                                        @endphp
                                     @endif

                                     <td class="w-1/3 py-2">{{ $deduction->name }}</td>
                                    @if($deduction->pivot->type == 'amount')
                                        <td class="w-2/3 py-2">{{ $deduction->pivot->value }}</td>
                                        @php
                                            $Deductions += $deduction->pivot->value;
                                        @endphp
                                    @else
                                    @php
                                        $value = ($deduction->pivot->value / 100) * $employee->salary;
                                        $Deductions += $value;
                                    @endphp
                                        <td class="w-2/3 py-2">{{ $value }}</td>
                                    @endif
                                </tr> 
                                @endforeach

                                @php
                                    if ($pfcount===1) {
                                        $yearlyIncome = $basicSalary*12 + $monthlyAllowance*12 + 0.1*($basicSalary * 12);
                                        $pf = min((1/3)*$yearlyIncome , 300000, 0.2*($basicSalary * 12));
                                    }else {
                                        $yearlyIncome = $basicSalary*12 + $monthlyAllowance*12 ;
                                        $pf = 0;
                                    }
                                    
                                @endphp

                                @php
                                    $taxableIncome = $yearlyIncome - $pf -$Deductions;
                                @endphp

                                
                                {{-- <tr>
                                    <td class="w-2/3 py-2">yearly income  {{ $yearlyIncome }}, {{$taxableIncome}}</td>
                                    <td class="w-2/3 py-2">pf  {{ $pf }}</td>
                                </tr> --}}

                                <tr>
                                    <td class="w-1/3 py-2">SST</td>
                                    @if($employee->tax_filing_status =="single")
                                        @php
                                            $firstSlab = 500000;
                                        @endphp 
                                    @else
                                        @php
                                            $firstSlab = 600000;
                                        @endphp
                                    @endif

                                    @if ($taxableIncome > $firstSlab)
                                        @php
                                            $sst = $firstSlab*0.01;
                                        @endphp
                                        <td class="w-2/3 py-2">{{ number_format($firstSlab*0.01, 2)}}</td>
                                    @else
                                        @php
                                            $sst = $taxableIncome*0.01;
                                        @endphp
                                        <td class="w-2/3 py-2">{{ $taxableIncome*0.01}}</td>
                                    @endif
                                  
                                </tr>

                                <tr>

                                    @php
                                    if($taxableIncome < $firstSlab){
                                        $secondSlab = 0;
                                    }else{
                                        if ($taxableIncome > ($firstSlab+200000)) {
                                            $secondSlab = 200000 * 0.1;
                                        }else {
                                            $secondSlab = ($taxableIncome - $firstSlab) * 0.1;
                                            // echo"<script>alert($secondSlab)</script>";
                                        }
                                    }

                                    if($taxableIncome < ($firstSlab + 200000)){
                                        $thirdSlab = 0;
                                    }else{
                                        if ($taxableIncome > ($firstSlab+500000)) {
                                            $thirdSlab = 300000 * 0.2;
                                        }else {
                                            $thirdSlab = ($taxableIncome - $firstSlab - 200000) * 0.2;
                                        }
                                    }

                                    if($taxableIncome < ($firstSlab + 500000)){
                                        $fourthSlab = 0;
                                    }else{
                                        if ($employee->tax_filing_status =="single") {
                                            if ($taxableIncome > ($firstSlab+1500000)) {
                                                $fourthSlab = 1000000 * 0.3;
                                            }else {
                                                $fourthSlab = ($taxableIncome - $firstSlab - 500000) * 0.3;
                                            }
                                        }else {
                                            if ($taxableIncome > ($firstSlab+1400000)) {
                                                $fourthSlab = 900000 * 0.3;
                                            }else {
                                                $fourthSlab = ($taxableIncome - $firstSlab - 500000) * 0.3;
                                            }
                                        }  
                                    }

                                    if($taxableIncome < ($firstSlab + 2000000)){
                                        $fifthSlab = 0;
                                    }else{
                                        if ($employee->tax_filing_status =="single") {
                                            if ($taxableIncome > ($firstSlab+4500000)) {
                                                $fifthSlab = 3000000 * 0.36;
                                            }else {
                                                $fifthSlab = ($taxableIncome - $firstSlab - 1500000) * 0.36;
                                            }
                                        }else {
                                            if ($taxableIncome > ($firstSlab+4400000)) {
                                                $fifthSlab = 3000000 * 0.36;
                                            }else {
                                                $fifthSlab = ($taxableIncome - $firstSlab - 1400000) * 0.36;
                                            }
                                        }  
                                    }

                                    if($taxableIncome > 5000000){
                                        $sixthSlab = ($taxableIncome - 5000000 )* 0.39;
                                    }else {
                                        $sixthSlab =0;
                                    }
                                        
                                    $tds = ( $secondSlab + $thirdSlab + $fourthSlab + $fifthSlab + $sixthSlab)/12 ;

                                    $totalDeductions = $sst+$tds+$Deductions;
                                    @endphp

                                    <td class="w-1/3 py-2">TDS</td>
                                    <td class="w-2/3 py-2">{{ number_format($tds, 2)}}</td>
                                </tr>
                                
                                <tr>
                                    <td class="w-1/3 py-2"><strong>Total Deductions (B):</strong></td>
                                    <td class="w-2/3 py-2"><strong>{{ number_format($totalDeductions, 2)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="w-1/3 py-2"><strong>Net Pay (A-B):</strong></td>
                                    <td class="w-2/3 py-2"><strong>{{ number_format($totalEarnings-$totalDeductions, 2)}}</strong></td>
                                </tr>
                               
                            </table>
                            {{-- <div class="mt-4">
                                <button class="bg-green-500 text-white py-2 px-4 mr-4">Approve</button>
                                <button class="bg-red-500 text-white py-2 px-4">Reject</button>
                            </div> --}}
                        </form>
                        
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