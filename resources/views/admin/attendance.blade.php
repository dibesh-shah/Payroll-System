@extends('layouts.app')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
    <h1 class="text-3xl font-bold mb-4">Attendance</h1>
        <div class="max-w mt-2 ">
            <div class="max-w mt-2 bg-white p-6 rounded-lg shadow-lg">
            <p class="text-sm font-semibold mb-4" id="month">Today's Date: {{ now()->format('Y-m-d') }}</p>

            <form method="post" action="{{ route('attendance.add') }}" class="max-w bg-white p-6 " id="attendanceForm">
                @csrf
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                    <label for="employee_id" class="block text-gray-600 text-sm font-semibold mb-2">Employee ID:</label>
                    <input type="text" name="employee_id" required class="w-full px-4 py-2 border border-gray-300 rounded-md">
                </div>
                
                
                    <div class="w-1/2">
                        <label for="clock_in" class="block text-gray-600 text-sm font-semibold mb-2">Clock In:</label>
                        <input type="time" name="clock_in" required class="w-full px-4 py-2 border border-gray-300 rounded-md" id="clockIn">
                    </div>
                    
                    <div class="w-1/2">
                        <label for="clock_out" class="block text-gray-600 text-sm font-semibold mb-2">Clock Out:</label>
                        <input type="time" name="clock_out" required class="w-full px-4 py-2 border border-gray-300 rounded-md" id="clockOut">

                        <input type="hidden" name="date" value="{{ now()->format('Y-m-d') }}">
                        <input type="hidden" name="clock_in" value="" id="clock_in">
                        <input type="hidden" name="clock_out" value="" id="clock_out">
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded" onclick="convertTime();">Add </button>
                </div>
            
                {{-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Add</button> --}}
            </form>
        </div>

            <div class="max-w mt-2 bg-white p-6 rounded-lg shadow-lg">
            <table class="w-full mt-4 " >
                <thead>
                    <tr>
                    <th class="py-2 px-4 bg-gray-200 text-left w-1/4">Eid</th>
                    <th class="py-2 px-4 bg-gray-200 text-left w-1/4">Employee</th>
                    <th class="py-2 px-4 bg-gray-200 text-left w-1/4" >Clock In</th>
                    <th class="py-2 px-4 bg-gray-200 text-left w-1/4" >Clock Out</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todayAttendance as $attendance)
                    <tr>
                        <td class="py-2 px-4">E{{ $attendance->id}}</td>
                        <td class="py-2 px-4">{{ $attendance->first_name }} {{ $attendance->last_name }}</td>
                        <td class="py-2 px-4">{{ $attendance->clock_in }}</td>
                        <td class="py-2 px-4">{{ $attendance->clock_out }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>

        </div>
    </div>
   </div>
</div>

{{-- <script>
 document.addEventListener("DOMContentLoaded", function () {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth();
    const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    document.getElementById("month").textContent = "Attendance - "+months[month] +"  "+ year;

  const clockInButton = document.querySelector("#clockInButton");
  const clockOutButton = document.querySelector("#clockOutButton");

  let clockInTime = null;


  // Get current time in AM/PM format
  function getCurrentTime() {
    const currentDate = new Date();
    const hours = currentDate.getHours();
    const minutes = currentDate.getMinutes();
    const ampm = hours >= 12 ? "PM" : "AM";
    const formattedHours = hours % 12 || 12;
    const formattedMinutes = minutes < 10 ? "0" + minutes : minutes;
    return formattedHours + ":" + formattedMinutes + " " + ampm;
  }

  // Disable clock in and enable clock out
  function clockIn() {
    clockInButton.classList.add('cursor-not-allowed');
    clockInButton.classList.remove('bg-blue-500');
    clockInButton.classList.add('bg-gray-300');
    clockInButton.classList.remove('hover:bg-blue-600');
    clockInButton.disabled = true;
    clockOutButton.disabled = false;
    clockInTime = getCurrentTime();
    const currentDate = new Date();
    clockInDate = currentDate.toISOString().split("T")[0];
    const customHeaders = {
        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
    };
    $.ajax({
        type:"POST",
        url:'{{ route("clock.in") }}',
        headers:customHeaders,
        data:{
            employee_id:{{Session::get('employee_id')}},
            date:clockInDate,
            clock_in:clockInTime,

        },
        cache:false,
        success:function(data){
            console.log(data)
            $("#todayDate").text(data.date);
            $("#clockInTimeToday").text(data.clock_in);
            $("#clockOutTimeToday").text("-");
            clockInButton.classList.remove('text-white');
            clockInButton.classList.add('text-black');
            clockOutButton.disabled = false;
            clockOutButton.classList.remove('cursor-not-allowed');
            clockOutButton.classList.remove('bg-gray-300');
            clockOutButton.classList.add('bg-red-500');
            clockOutButton.classList.add('hover:bg-red-600');
            clockOutButton.classList.add('text-white');
                },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            }
    });

  }

  // Enable clock in and disable clock out
  function clockOut() {
    clockOutButton.disabled = true;
    clockOutButton.classList.add('cursor-not-allowed');
    clockOutButton.classList.remove('bg-red-500');
    clockOutButton.classList.add('bg-gray-300');
    clockOutButton.classList.remove('hover:bg-red-600');


    const clockOutTime = getCurrentTime();
    const currentDate = new Date();
    clockOutDate = currentDate.toISOString().split("T")[0];
    const customHeaders = {
        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
    };
    $.ajax({
        type:"POST",
        url:'{{ route("clock.out") }}',
        headers:customHeaders,
        data:{
            employee_id:{{Session::get('employee_id')}},
            date:clockOutDate,
            clock_out:clockOutTime
        },
        cache:false,
        success:function(data){
            console.log(data)

            $("#clockOutTimeToday").text(data.clock_out);
            clockOutButton.classList.remove('text-white');
            clockOutButton.classList.add('text-black');
        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            }
    });
  }



  clockInButton.addEventListener("click", clockIn);
  clockOutButton.addEventListener("click", clockOut);
});


</script> --}}


<script>
    function convertTime() {
        // Get the selected times
        var clockInTime = document.getElementById('clockIn').value;
        var clockOutTime = document.getElementById('clockOut').value;

        // Convert to 12-hour format
        var formattedClockIn = convertTo12HourFormat(clockInTime);
        var formattedClockOut = convertTo12HourFormat(clockOutTime);


        // Set the converted times back to the input fields
        document.getElementById('clock_in').value = formattedClockIn;
        document.getElementById('clock_out').value = formattedClockOut;

        // Submit the form
        document.getElementById('attendanceForm').submit();
    }

    function convertTo12HourFormat(time24) {
        var [hours, minutes] = time24.split(':');
        var period = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12;
        return hours + ':' + minutes + ' ' + period;
    }
</script>

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
