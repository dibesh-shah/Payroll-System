@extends('layouts.master')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Apply for Leave</h1>
        {{-- @if(session('success'))
      <div class="text-green-500 mb-4">
          {{ session('success') }}
      </div>
        @endif --}}
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-white p-4  col-span-2">
                        <div >
                            <form class="bg-white shadow-md rounded-md p-6" method="POST" action="{{route('leaveReq.store')}}">
                                @csrf
                                <h2 class="text-xl font-semibold mb-4">Leave Detail</h2>
                                @if ($errors->any())
                                    <div class="text-red-500 text-xl bold">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-semibold mb-2">Employee Name:</label>
                                        <p class="w-full  rounded p-2 " > {{$employee->first_name}} {{$employee->last_name}}</p>
                                    </div>

                                     <div>
                                        <label for="leave_id" class="block font-semibold mb-2">Available Leave Type:</label>
                                        <select id="leave_id" name="leave_id" class="w-full border rounded p-2 ">
                                            @foreach($assignedLeaves as $leave)

                                            <option value="{{$leave->id}}">{{$leave->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div>
                                        <label for="startDate" class="block font-semibold mb-2">Start Date:</label>
                                        <input type="date" name="start_date" id="startDate" class="w-full border rounded p-2"  min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div>
                                        <label for="endDate" class="block font-semibold mb-2">End Date:</label>
                                        <input type="date" name="end_date" id="endDate" class="w-full border rounded p-2"  min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label for="message" class="block font-semibold mb-2">Message:</label>
                                    <textarea id="message" name="message" class="w-full border rounded p-2" rows="4"></textarea>
                                    <input type="hidden" name="employee_id" value="{{$employee->id}}">
                                </div>

                                <button type="submit" class="bg-blue-500 text-white mt-4 py-2 px-4 rounded-md">Submit</button>
                            </form>
                        </div>

                    </div>
                    <div class="col-span-1">
                        <h2 class="text-3xl font-bold mb-4 text-center" id="month"></h2>
                        <div id="calendarContainer" class="w-80">

                            <!-- The calendar table will be generated here -->
                        </div>
                        <div class="mt-10 text-center">
                            <span class="mr-6">
                              <span class="px-2 py-2 bg-green-400 text-white rounded-lg" >Public Holiday</span>
                              <span class="ml-2 b" id="publicHoliday">: 3</span>
                            </span>
                            <span class="mr-6">
                              <span class="px-2 py-2  text-white rounded-lg bg-red-400" >Weekend</span>
                              <span class="ml-2" id="weekend">: 5</span>
                            </span>
                            <span>
                              <span class="px-2 py-2 bg-purple-400 text-white rounded-lg" >Other Holidays</span>
                              <span class="ml-2" id="otherHoliday">: 2</span>
                            </span>
                          </div>
                    </div>



                </div>
        </div>


    </div>

   </div>
</div>
<script>
    const publicHoli = [];
    const otherHoli = [];
    const weekHoli = [];

    @foreach ($publicHolidays as  $publicHoliday)

        @foreach ($publicHoliday['holiday_dates'] as $date)

                    publicHoli.push('{{ $date }}')
                @endforeach
        @endforeach

        @foreach ($otherHolidays as  $otherHoliday)
        @foreach ($otherHoliday['holiday_dates'] as $date)
                   otherHoli.push('{{ $date }}')
                @endforeach
        @endforeach

        @foreach ($weekends as  $weekend)
        @foreach ($weekend['holiday_dates'] as $date)
                   weekHoli.push('{{ $date }}')
                @endforeach
        @endforeach

 </script>
<script >
    const calendarContainer = document.getElementById('calendarContainer');
    var weekend=0;
    var publicHoliday=0;
    var otherHoliday=0;

    // Function to generate the calendar for the current month
    function generateCalendar() {
        const now = new Date();
        const year = now.getFullYear();
        const month = now.getMonth();

        const today = year+"-"+(month+1)+"-"+(now.getDate()) ;
        const months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        document.getElementById("month").textContent = months[month] +"  "+ year;

        // Get the first day of the month (e.g., 1 for Sunday, 2 for Monday, ...)
        const firstDay = new Date(year, month, 1).getDay();

        // Determine the total number of days in the month
        const totalDays = new Date(year, month + 1, 0).getDate();

        // Create the calendar table
        const table = document.createElement('table');
        table.className="table-auto mx-auto";
        const headerRow = document.createElement('tr');


        // Add the day names (Sunday, Monday, ..., Saturday) to the header row
        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        for (let i = 0; i < 7; i++) {
            const th = document.createElement('th');
            // th.className="w-20 ";
            const divth = document.createElement('div');
            divth.textContent = daysOfWeek[i];
            divth.className=" bg-white shadow-md  rounded-2xl w-16 h-10";
            th.appendChild(divth);
            headerRow.appendChild(th);
        }
        table.appendChild(headerRow);

        // Calculate the number of rows needed for the calendar
        const numRows = Math.ceil((totalDays + firstDay) / 7);

        // Create the calendar rows and cells
        let day = 1;
        for (let i = 0; i < numRows; i++) {
            const row = document.createElement('tr');
            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');
                const divcell = document.createElement('div');

                if (i === 0 && j < firstDay) {
                    // Empty cells before the first day of the month
                    divcell.textContent = '';


                } else if (day <= totalDays) {
                    divcell.textContent = day;
                    var d = getDateId(year, month, day);
                    divcell.setAttribute('id', d);
                    if(d==today){

                        divcell.className="bg-white shadow-md rounded-full px-2 py-4 m-1 text-center bg-gray-200 " ;
                    }else{
                        divcell.className="bg-white shadow-md rounded-full px-2 py-4 m-1 text-center " ;
                    }
                    if(publicHoli.includes(d)){
                        publicHoliday++;
                        divcell.className=" shadow-md rounded-full px-2 py-4 m-1 text-center bg-green-400 pointer-events-none text-white"
                    }else if(otherHoli.includes(d)){
                        otherHoliday++;
                        divcell.className=" shadow-md rounded-full px-2 py-4 m-1 text-center bg-purple-400 pointer-events-none text-white"
                    }else if(weekHoli.includes(d)){
                      weekend++;
                        divcell.className=" shadow-md rounded-full px-2 py-4 m-1 text-center bg-red-400 pointer-events-none text-white"
                    }
                    if(j==6){
                        weekend++;
                        divcell.className="bg-white shadow-md rounded-full px-2 py-4 m-1 text-center bg-red-400 pointer-events-none text-white"
                    }
                    day++;
                } else {
                    // Empty cells after the last day of the month
                    divcell.textContent = '';

                }
                cell.appendChild(divcell);
                row.appendChild(cell);
            }
            table.appendChild(row);
        }

        // Remove any existing calendar and add the new calendar to the container
        while (calendarContainer.firstChild) {
            calendarContainer.removeChild(calendarContainer.firstChild);
        }
        calendarContainer.appendChild(table);

    }

    // Helper function to get a unique ID for a given date
    function getDateId(year, month, day) {
        return `${year}-${month + 1}-${day}`;
    }


    // Generate the calendar when the page loads
    generateCalendar();

    document.getElementById('weekend').textContent=weekend;
    document.getElementById('publicHoliday').textContent=publicHoliday;
    document.getElementById('otherHoliday').textContent=otherHoliday;

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
