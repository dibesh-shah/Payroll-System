@extends('layouts.app')

@section('content')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
       <div class="container mx-auto py-8">
          <div class="flex items-center justify-between mb-6">
              <h1 class="text-3xl font-bold">Employee Approval</h1>
              @if(session('success'))
      {{-- <div class="text-green-500 mb-4">
          {{ session('success') }}
      </div> --}}
        @endif
          </div>

          @foreach ($employees as $employee)
          <div class="flex justify-between items-center border p-4 rounded-md bg-white shadow-md mb-4">
              <!-- Employee Details -->
              <div class="flex-1">
                  <span class="text-lg font-bold mb-2 hover:text-blue-500">E{{ $employee->id }}</span>
                  <span class="text-lg font-bold mb-2 hover:text-blue-500"> - {{ $employee->first_name }} {{ $employee->last_name }} - </span>
                  <span class="mb-2 font-bold text-sm text-green-600">{{ $employee->email }}</span>
              </div>
      
              <!-- Employee Status -->
              <div class="w-32"> <!-- Adjust the width as needed -->
                  @if ($employee->status == 'pending')
                      <span class="mb-2 font-bold text-sm text-yellow-600">Pending</span>
                  @elseif ($employee->status == 'rejected')
                      <span class="mb-2 font-bold text-sm text-red-600">Rejected</span>
                  @else
                      <span class="mb-2 font-bold text-sm text-green-600">Approved</span>
                  @endif
              </div>
      
              <!-- See More Button -->
              <a class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md" href="{{ route('employees.show', $employee->id) }}">
                  See More
              </a>
          </div>
      @endforeach
      





          </div>
      </div>
    </div>
 </div>

 <script>
  toastr.options = {
      "positionClass": "toast-bottom-right",
      "progressBar": true,
      "timeOut": 5000, // Duration in milliseconds
  }
</script>

@if(session('success'))
    <script>
        // Display Toastr success message
        toastr.success("{{ session('success') }}");
    </script>
@endif
 @endsection
