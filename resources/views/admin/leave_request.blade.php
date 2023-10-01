 @extends('layouts.app')

 @section('content')
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Search Leave Request</h1>
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-center mb-2">
                        <input type="text" id="type" name="type" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Leave Id" required>
                        <button class="ml-4 px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">View</button>
                    </div>    
                </div>
        </div>

        <div class="container mx-auto mt-5 p-4 bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold mb-4">Leave Requests</h1>
            @if(session('success'))
                <div class="text-green-500 mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Sample leave div containers -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4  ">
                @foreach($leaveRequests as $leaveRequest)
                <a href="{{ route('leaveReq.show', ['id' => $leaveRequest->id]) }}">
                    <div class="bg-white p-4 rounded-md shadow-lg cursor-pointer" onclick="viewLeaveDetail(1)">
                        <h2 class="text-xl font-bold">Leave Request #{{$leaveRequest->id}}</h2>
                        <p class="text-gray-500">Employee: {{ $leaveRequest->employee->first_name }} {{ $leaveRequest->employee->last_name }}</p>
                        <p class="text-gray-500">Leave Type: {{ $leaveRequest->leaveType->name }}</p>
                    </div>
                </a>
                @endforeach
                    
            </div>
        </div>
    </div>
    
   </div>
</div>

@endsection