@extends('layouts.master')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14 ">
        <h1 class="text-3xl font-bold mb-4">Leave Balance</h1> 

@for ($i = 0; $i < count($remainingBalances); $i += 3)
    <div class="flex space-x-4 mt-4">
        @for ($j = $i; $j < min($i + 3, count($remainingBalances)); $j++)
            <div class="w-1/3 bg-white p-4 rounded-lg shadow-md text-center">
                <div class="font-semibold text-lg">{{ $remainingBalances[$j]['name'] }}</div>
                <div class="text-xl font-bold mt-2">{{ $remainingBalances[$j]['days'] }} days</div>
                <div class="text-gray-500">Remaining: {{ $remainingBalances[$j]['remaining_days'] }} days</div>
            </div>
        @endfor
    </div>
@endfor
    </div>
    </div>
 </div>


@endsection
