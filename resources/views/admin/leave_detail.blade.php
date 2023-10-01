{{-- @extends('layouts.app')

@section('content')

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
     <div class="container mx-auto mt-5">
         <h1 class="text-3xl font-bold mb-4">Leave Detail</h1>
         @if(session('success'))
      <div class="text-green-500 mb-4">
          {{ session('success') }}
      </div>
        @endif
         <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
                 <div class="grid grid-cols-3 gap-6">
                     <div class="bg-white p-4  col-span-2">
                         <div class="bg-white p-4 shadow-lg rounded-lg">
                             <h2 class="text-xl font-bold">Leave Request #{{ $leaveRequest->id }}</h2>
                             <div class="flex flex-col space-y-2">
                                <p class="text-gray-500">Employee: {{ $leaveRequest->employee_name }}</p>
                                <p class="text-gray-500">Leave Type: {{ $leaveRequest->leave_type }}</p>
                                <p class="text-gray-500">Start Date: {{ $leaveRequest->start_date }}</p>
                                <p class="text-gray-500">End Date: {{ $leaveRequest->end_date }}</p>
                                <p class="text-gray-500">Status:@if($leaveRequest->status== 'approved')
                                    <p class="text-white bg-green-600 font-medium rounded-full px-4 py-2 items-start"> Approved</p>
                                    @elseif($leaveRequest->status== 'pending')
                                    <p class="text-white bg-red-600 font-medium rounded-full px-4 py-2 self-center text-center" >Pending </p>
                                    @elseif($leaveRequest->status == 'rejected')

                                    <p class="text-white bg-purple-600 font-medium rounded-full px-4 py-2 self-center text-center">Rejected</p>
                                    @endif</p>
                             </div>
                             <div class="mt-4">
                               <label class="block text-gray-700 font-bold mb-2" for="message">Message:</label>
                               <p class="text-gray-500">{{ $leaveRequest->message ?: 'N/A' }}</p>
                             </div>
                            <form action="{{ route('leave.approve', $leaveRequest->id) }}" method="POST" id="my_form">
                                @csrf
                             <div class="mt-4">
                               <label class="block text-gray-700 font-bold mb-2" for="response">Admin Response:</label>
                               <textarea id="response" class="w-full rounded-lg p-4 border border-zinc-800 focus:border-blue-500 focus:ring focus:ring-blue-200" rows="4" name="admin_response">{{ $leaveRequest->admin_response ?: 'N/A' }}</textarea>
                             </div>
                            </form>
                             <div class="mt-6 flex space-x-4">
                               <button class="px-4 py-2 bg-green-500 text-white font-bold rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-200" type="submit" form="my_form">Approve</button>
                               <form action="{{route('leave.reject', $leaveRequest->id)}}" method="POST" class="mt-4">
                                @csrf
                               <button class="px-4 py-4 bg-red-500 text-white font-bold rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-200" type="submit">Deny</button>
                               </form>
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
 </div> --}}
 
 {{-- @endsection --}}




 @extends('layouts.app')

 @section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Leave Detail</h1>
        @if(session('success'))
            <div class="text-green-500 mb-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
                <div class="grid grid-cols-3 gap-6">
                    <div class="bg-white p-4  col-span-2">
                        <div class="bg-white p-4 shadow-lg rounded-lg">
                            <h2 class="text-xl font-bold mb-4">Leave Request </h2>
                            <div class="flex flex-col space-y-2">
                              <p class="text-gray-500"><span class="font-bold">Leave Id:</span> {{ $leaveRequest->id }}</p>
                              <p class="text-gray-500"><span class="font-bold">Employee:</span> {{ $leaveRequest->employee_name }}</p>
                              <p class="text-gray-500"><span class="font-bold">Leave Type:</span> {{ $leaveRequest->leave_name }}</p>
                              <p class="text-gray-500"><span class="font-bold">Start Date:</span> {{ $leaveRequest->start_date }}</p>
                              <p class="text-gray-500"><span class="font-bold">End Date:</span> {{ $leaveRequest->end_date }}</p>
                              <p class="text-gray-500"><span class="font-bold">Status:</span> {{ $leaveRequest->status }}</p>
                            </div>
                            <div class="mt-4">
                              <label class="block text-gray-700 font-bold mb-2" for="message">Message:</label>
                              <p class="text-gray-500">{{ $leaveRequest->message ?: '<i>No Message</i>' }}</p>
                            </div>
                            <div class="mt-4">
                              <label class="block text-gray-700 font-bold mb-2" for="response">Admin Response:</label>
                              @if ($leaveRequest->admin_response)
                                <p class="text-gray-500">{{ $leaveRequest->admin_response}}</p>
                                
                                @else
                                <form action="{{ route('leave.approve', $leaveRequest->id) }}" method="POST" id="my_form">
                                    @csrf
                                    <textarea id="response" name="admin_response" class="w-full rounded-lg p-4 border border-zinc-800 focus:border-blue-500 focus:ring focus:ring-blue-200" rows="4"></textarea>
                                </form>
                              @endif
                            </div>
                            <div class="mt-6 flex space-x-4">
                              <button class="px-4 py-2 bg-green-500 text-white font-bold rounded-md hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-200" type="submit" form="my_form">Approve</button>
                              
                              <form action="{{route('leave.reject', $leaveRequest->id)}}" method="POST" >
                                @csrf
                                <button class="px-4 py-2 bg-red-500 text-white font-bold rounded-md hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-200" type="submit">Deny</button>
                              </form>
                            </div>
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
                    }
                    if(j==6){
                        weekend++;
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

    document.getElementById('weekend').textContent=weekend;
    document.getElementById('publicHoliday').textContent=publicHoliday;
    document.getElementById('otherHoliday').textContent=otherHoliday;

</script>

@endsection