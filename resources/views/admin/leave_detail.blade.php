@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Leave Detail</h1>
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-white p-4  col-span-2">
                        <div class="bg-white p-4 shadow-lg rounded-lg">
                            <h2 class="text-xl font-bold mb-4">Leave Request 1</h2>
                            <div class="flex flex-col space-y-2">
                              <p class="text-gray-500"><span class="font-bold">Leave Id:</span> 1234</p>
                              <p class="text-gray-500"><span class="font-bold">Employee:</span> John Doe</p>
                              <p class="text-gray-500"><span class="font-bold">Leave Type:</span> Annual Leave</p>
                              <p class="text-gray-500"><span class="font-bold">Start Date:</span> 2023-07-25</p>
                              <p class="text-gray-500"><span class="font-bold">End Date:</span> 2023-07-30</p>
                            </div>
                            <div class="mt-4">
                              <label class="block text-gray-700 font-bold mb-2" for="message">Message:</label>
                              <p class="text-gray-500">Leave request for annual leave.</p>
                            </div>
                            <div class="mt-4">
                              <label class="block text-gray-700 font-bold mb-2" for="response">Admin Response:</label>
                              <textarea id="response" class="w-full rounded-lg p-4 border border-zinc-800 focus:border-blue-500 focus:ring focus:ring-blue-200" rows="4"></textarea>
                            </div>
                            <div class="mt-6 flex space-x-4">
                              <button class="px-4 py-2 bg-green-500 text-white font-bold rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-200" type="button">Approve</button>
                              <button class="px-4 py-2 bg-red-500 text-white font-bold rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-200" type="button">Deny</button>
                            </div>
                          </div>

                    </div>
                    <div class="col-span-1">
                        <h2 class="text-3xl font-bold mb-4 text-center" id="month"></h2>
                        <div id="calendarContainer" class="w-80">

                            <!-- The calendar table will be generated here -->
                        </div>
                    </div>



                </div>
        </div>


    </div>

   </div>
</div>
<script >
    const calendarContainer = document.getElementById('calendarContainer');

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
                    if(j==6){
                        divcell.className="bg-white shadow-md rounded-full px-2 py-4 m-1 text-center bg-red-400 pointer-events-none"
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

</script>

@endsection
