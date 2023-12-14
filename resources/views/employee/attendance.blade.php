@extends('layouts.master')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Attendance</h2>

            <!-- Clock In/Out Button -->
            <!-- Clock In/Out Button -->
            <div class="flex items-center space-x-4">
                <button id="clockInButton" class="px-4 py-2 @if($todayAttendance && $todayAttendance->clock_in) bg-gray-300 cursor-not-allowed @else bg-blue-500 hover:bg-blue-600 text-white @endif rounded-lg" @if($todayAttendance && $todayAttendance->clock_in) disabled @endif>Clock In</button>
                <button id="clockOutButton" class="px-4 py-2 @if(!$todayAttendance || !$todayAttendance->clock_in || $todayAttendance->clock_out) bg-gray-300 cursor-not-allowed @else bg-red-500 hover:bg-red-600 text-white @endif rounded-lg" @if(!$todayAttendance || !$todayAttendance->clock_in || $todayAttendance->clock_out) disabled @endif>Clock Out</button>
                @if(session('success'))
                    <div class="text-green-500 mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('success'))
                <div class="text-green-500 mb-4">
                    {{ session('success') }}
                </div>

            @endif
            </div>
        <table class="w-full mt-4 " id="todayTable">
            <thead>
                <tr>
                <th class="py-2 px-4 bg-gray-200 text-left w-1/3">Date</th>
                <th class="py-2 px-4 bg-gray-200 text-left w-1/3" >Clock In</th>
                <th class="py-2 px-4 bg-gray-200 text-left w-1/3" >Clock Out</th>
                </tr>
            </thead>
            <tbody id="attendanceRecords ">
                <td class="py-2 px-4 " id="todayDate">{{ today()->format('Y-m-d') }}<br>
                <p class="text-sm text-emerald-700">(today)</p></td>
                <td class="py-2 px-4" id="clockInTimeToday">{{ $todayAttendance ? $todayAttendance->clock_in : '-' }}</td>
                <td class="py-2 px-4" id="clockOutTimeToday">
                    @if($todayAttendance && $todayAttendance->clock_out)
                    {{ $todayAttendance->clock_out }}
                @else
                    -
                @endif
                </td>
              </tbody>
        </table>

         </div>

        <div class="max-w mt-2 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4" id="month"></h2>
            <table class="w-full mt-4 " >
                <thead>
                    <tr>
                    <th class="py-2 px-4 bg-gray-200 text-left w-1/3">Date</th>
                    <th class="py-2 px-4 bg-gray-200 text-left w-1/3" >Clock In</th>
                    <th class="py-2 px-4 bg-gray-200 text-left w-1/3" >Clock Out</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendanceData as $attendance)
                    <tr>
                        <td class="py-2 px-4">{{ $attendance->date }}</td>
                        <td class="py-2 px-4">{{ $attendance->clock_in }}</td>
                        <td class="py-2 px-4">{{ $attendance->clock_out }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>

        </div>
   </div>
</div>

<script>
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


</script>

@endsection
