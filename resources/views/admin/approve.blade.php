@extends('layouts.app')

@section('content')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
       <div class="container mx-auto py-8">
          <div class="flex items-center justify-between mb-6">
              <h1 class="text-3xl font-bold">Employee Approval</h1>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 ">
              <!-- Loop through the list of employees to be approved -->
              {{-- @foreach ($employeesToBeApproved as $employee) --}}
                  <div class="flex justify-between items-center border p-4 rounded-md bg-white shadow-md ">
                      {{-- <a href="{{ route('employee.details', $employee->id) }}" class="text-lg font-bold mb-2 hover:text-blue-500">{{ $employee->name }}</a> --}}
                      <a href="" class="text-lg font-bold mb-2 hover:text-blue-500 ">Bimal Poodel</a>
                      <a class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md " href="{{route('approvedetail')}}">See More</a>

                  </div>
                  <div class="flex justify-between items-center border p-4 rounded-md bg-white shadow-md ">
                      {{-- <a href="{{ route('employee.details', $employee->id) }}" class="text-lg font-bold mb-2 hover:text-blue-500">{{ $employee->name }}</a> --}}
                      <a href="" class="text-lg font-bold mb-2 hover:text-blue-500 ">Bimal Poodel</a>
                      <button class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md ">See More</button>

                  </div>
                  <div class="flex justify-between items-center border p-4 rounded-md bg-white shadow-md ">
                      {{-- <a href="{{ route('employee.details', $employee->id) }}" class="text-lg font-bold mb-2 hover:text-blue-500">{{ $employee->name }}</a> --}}
                      <a href="" class="text-lg font-bold mb-2 hover:text-blue-500 ">Bimal Poodel</a>
                      <button class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md ">See More</button>

                  </div>
                  <div class="flex justify-between items-center border p-4 rounded-md bg-white shadow-md ">
                      {{-- <a href="{{ route('employee.details', $employee->id) }}" class="text-lg font-bold mb-2 hover:text-blue-500">{{ $employee->name }}</a> --}}
                      <a href="" class="text-lg font-bold mb-2 hover:text-blue-500 ">Bimal Poodel</a>
                      <button class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md ">See More</button>

                  </div>

          </div>
      </div>
    </div>
 </div>
 @endsection
