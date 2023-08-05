@extends('layouts.app')

@section('content')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
       <div class="container mx-auto py-8">
          <div class="flex items-center justify-between mb-6">
              <h1 class="text-3xl font-bold">Employee Approval</h1>
          </div>

            @foreach($employees as $employee)
            {{-- @if($employee->status== 'pending') --}}
            <div class="border p-4 rounded-md bg-white shadow-md flex justify-between ">

                    <div class="flex flex-col">
                        <h2 class="text-lg font-bold mb-2">{{ $employee->first_name }} {{$employee->last_name}}</h2>
                        <p class="mb-2 font-bold text-sm text-purple-600"> {{ $employee->email }}</p>
                    </div>
                    <!-- Add other employee details as needed -->

                    @if($employee->status== 'approved')
                        <p class="text-white bg-green-600 font-medium rounded-full px-4 py-2 self-center text-center"> Approved</p>
                        @elseif($employee->status== 'pending')
                        <p class="text-white bg-red-600 font-medium rounded-full px-4 py-2 self-center text-center" >Pending </p>
                        @elseif($employee->status == 'rejected')

                        <p class="text-white bg-purple-600 font-medium rounded-full px-4 py-2 self-center text-center">Rejected</p>
                        @endif

             <a class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 self-center  rounded-md text-center" href="{{route('employees.show', $employee->id)}}">See More</a>
{{--
                     <div class="mt-4 flex justify-between">

                        <form  method="POST">
                            action="{{ route('employees.approve', $employee->approveEmployee->id) }}"
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Approve</button>
                        </form>
                        <form  method="POST">
                            action="{{ route('employees.reject', $employee->approveEmployee->id) }}"
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Reject</button>
                        </form>
                        @endif
                    </div> --}}
            </div>
            {{-- @endif --}}
            @endforeach




          </div>
      </div>
    </div>
 </div>
 @endsection
