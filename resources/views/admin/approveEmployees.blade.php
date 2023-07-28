@extends('layouts.app')

@section('content')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
       <div class="container mx-auto py-8">
          <div class="flex items-center justify-between mb-6">
              <h1 class="text-3xl font-bold">Employee Approval</h1>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 ">
            @foreach($employees as $employee)
            <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                <div class="border border-gray-300 rounded-md shadow-sm p-4">
                    <h2 class="text-lg font-bold mb-2">{{ $employee->name }}</h2>
                    <p class="mb-2">Email: {{ $employee->email }}</p>
                    <!-- Add other employee details as needed -->

                    @if($employee->approval)
                        @if($employee->approval->is_approved)
                        <p class="text-green-600 font-medium">Status: Approved</p>
                        @else
                        <p class="text-orange-600 font-medium">Status: Pending Approval</p>
                        @endif
                        @else
                        <p class="text-red-600 font-medium">Status: Not Submitted for Approval</p>
                        @endif

                    <div class="mt-4 flex justify-between">
                        @if($employee->approval && !$employee->approval->is_approved)
                        <form action="{{ route('employees.approve', $employee->approval->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Approve</button>
                        </form>
                        <form action="{{ route('employees.reject', $employee->approval->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Reject</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

                  </div>


          </div>
      </div>
    </div>
 </div>
 @endsection
