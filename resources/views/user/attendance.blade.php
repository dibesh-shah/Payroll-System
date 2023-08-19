@include("user.sidenav")

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-4">Attendance</h2>

            <!-- Clock In/Out Button -->
            <!-- Clock In/Out Button -->
            <div class="flex items-center space-x-4">
                <button id="clockInButton" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg">Clock In</button>
                <button id="clockOutButton" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg" disabled>Clock Out</button>
            </div>
  

            <!-- Attendance Records Table -->
            <table class="w-full mt-4 " id="todayTable">
            <thead>
                <tr>
                <th class="py-2 px-4 bg-gray-200 text-left w-1/3">Date</th>
                <th class="py-2 px-4 bg-gray-200 text-left w-1/3" >Clock In</th>
                <th class="py-2 px-4 bg-gray-200 text-left w-1/3" >Clock Out</th>
                </tr>
            </thead>
            <tbody id="attendanceRecords ">
                <td class="py-2 px-4 " id="todayDate"></td>
                <td class="py-2 px-4" id="clockInTimeToday"></td>
                <td class="py-2 px-4" id="clockOutTimeToday"></td>
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
                <tbody >
                    <td class="py-2 px-4 " ></td>
                    <td class="py-2 px-4" ></td>
                    <td class="py-2 px-4" ></td>
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
        url:'{{ route("ajax.endpoint") }}',
        headers:customHeaders,
        data:{
            // userId:userId,
            date:clockInDate,
            clock_in:clockInTime,
            clock_out:"null"
        },
        cache:false,
        success:function(data){
            console.log(data)
            $("#todayDate").text(data.date);
            $("#clockInTimeToday").text(data.clock_in);
            $("#clockOutTimeToday").text("-");
        },
        error:function(){

        }
    });

  }

  // Enable clock in and disable clock out
  function clockOut() {
    clockOutButton.disabled = true;
    const clockOutTime = getCurrentTime();
    const currentDate = new Date();
    clockOutDate = currentDate.toISOString().split("T")[0];
    const customHeaders = {
        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
    };
    $.ajax({
        type:"POST",
        url:'{{ route("ajax.endpoint") }}',
        headers:customHeaders,
        data:{
            // userId:userId,
            date:clockOutDate,
            clock_out:clockOutTime
        },
        cache:false,
        success:function(data){
            console.log(data)
            
            $("#clockOutTimeToday").text(data.clock_out);
        },
        error:function(){

        }
    });
  }


  clockInButton.addEventListener("click", clockIn);
  clockOutButton.addEventListener("click", clockOut);
});


</script>

@include('user.footer')


{{-- CREATE TABLE attendance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    date DATE,
    clock_in TIME,
    clock_out TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
); --}}
