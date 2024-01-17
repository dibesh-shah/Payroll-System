@extends('layouts.master')
@section('content')

<div class="p-4 sm:ml-64">
    <div class="p-6 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14 ">

     <h1 class="text-3xl font-bold mb-4">Leave History</h1> 


        <!-- Search Filter -->
        {{-- <div class="flex items-center space-x-2 mb-4 bg-white p-4 rounded-lg shadow-md">
            <label for="search" class="font-medium">Search:</label>
            <input type="text" id="search" class=" w-96 p-2 border rounded-md" placeholder="Enter Leave Id">
        </div> --}}

       <div class="space-y-2">
            <div class="bg-white p-4 rounded-lg shadow-md">
                
            @foreach ($leaveRequestsByMonth as $month => $requests)
                <div class="flex justify-between items-center mb-2 ">
                    <span class="text-lg font-semibold"><i>{{ $month }}</i></span>
                </div>
                <!-- Individual Leave Entries -->
                @foreach ($requests as $request)
                <div class="space-y-2 mb-4">
                    <!-- Leave Entry 1 -->
                    <div class="bg-white p-2 rounded-md shadow-md relative">
                        <span class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 toggle-dropdown">▼</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Leave ID:</span>
                            <span>#{{ $request->id }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Leave Type:</span>
                            <span>{{ $request->leave_name }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Start Date:</span>
                            <span>{{ $request->start_date }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">End Date:</span>
                            <span>{{ $request->end_date }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Status:</span>
                            @if ( $request->status  == "approved")
                                <span class="bg-green-400 px-2 rounded-lg text-white text-base py-1">{{ $request->status }}</span>
                            @elseif ( $request->status  == "rejected")
                                <span class="bg-red-400 px-2 rounded-lg text-white text-base py-1">{{ $request->status }}</span>
                            @else
                                <span class="bg-yellow-400 px-2 rounded-lg text-white text-base py-1">{{ $request->status }}</span>
                            @endif
                        </div>
                        <!-- Dropdown Content -->
                        <div class="hidden message-container">
                            <div class="employee-message text-gray-700 mt-2">
                                <strong>Employee Message:</strong> {{ $request->message }}
                            </div>
                            @if ( $request->status  != "pending")
                            <div class="admin-response text-green-600 mt-2">
                                <strong>Admin Response:</strong> {{ $request->admin_response }}
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
                @endforeach
                @endforeach
            </div>
            
            <!-- Add more months and their leave entries -->
        </div>


    </div>
 </div>
 <script>
    // jQuery code to toggle the hidden content
    $(document).ready(function() {
    $(document).on('click', '.toggle-dropdown', function() {

        if ($(this).text() === "▼") {
            $(this).text("▲");
        } else {
            $(this).text("▼");
        }
        $(this).parent().find('.hidden').toggle();

    });
});
</script>
@endsection
