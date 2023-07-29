@include("admin.sidenav")

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5 p-4 bg-white">
        <h1 class="text-3xl font-bold mb-4 text-center" id="month"></h1>
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
            <div id="calendarContainer">
                <!-- The calendar table will be generated here -->
            </div>
            
        </div>
        <div class="max-w  p-6 rounded-lg shadow-lg mt-6">
            
            <select id="holidayType">
                <option value="">Select Holiday Type</option>
                <option value="Public Holiday">Public Holiday</option>
                <option value="Weekend">Weekend</option>
                <option value="Other">Other</option>
              </select>
            <textarea class="w-100 " id="selectedDates" readonly></textarea>
            <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" id="saveButton">Save Selected Dates</button>
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
                th.className="w-20 ";
                const divth = document.createElement('div');
                divth.textContent = daysOfWeek[i];
                divth.className=" bg-white shadow-md p-4 m-2 rounded-2xl";
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
                            
                            divcell.className="bg-white shadow-md rounded-full px-2 py-4 m-1 text-center bg-gray-200 hover:bg-red-300" ;
                        }else{
                            divcell.className="bg-white shadow-md rounded-full px-2 py-4 m-1 text-center " ;
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

<script>
    // JavaScript code for handling holiday selection
    const calendarDivs = document.querySelectorAll('#calendarContainer div');
    const holidayTypeSelect = document.getElementById('holidayType');
    const saveButton = document.getElementById('saveButton');

    let selectedHolidayType = '';
    let selectedDivs = [];

    // Function to add/remove the selected-holiday class
    function toggleSelectedClass(div) {
      if (div.classList.contains('selected-holiday')) {
        div.classList.remove('selected-holiday');
        div.classList.remove('bg-red-400');
      } else {
        
        div.classList.add('selected-holiday');
        div.classList.add('bg-red-400');
      }
    }

    // Function to enable/disable saveButton
    function toggleSaveButton() {
      saveButton.disabled = selectedDivs.length === 0 || selectedHolidayType === '';
    }

    // Function to reset the selection
    function resetSelection() {
      selectedDivs.forEach((divId) => {
        const div = document.getElementById(divId);
        div.classList.remove('selected-holiday');
      });
      selectedDivs = [];
      selectedHolidayType = '';
      holidayTypeSelect.value = '';
      toggleSaveButton();
    }

    // Add click event listener to each div in the calendar
    calendarDivs.forEach((div) => {
      div.addEventListener('click', () => {
        if (selectedHolidayType !== '') {
          toggleSelectedClass(div);
          if (div.classList.contains('selected-holiday')) {
            selectedDivs.push(div.id);
          } else {
            const index = selectedDivs.indexOf(div.id);
            if (index !== -1) {
              selectedDivs.splice(index, 1);
            }
          }
          toggleSaveButton();
        }
      });
    });

    // Add change event listener to the holiday type select
    holidayTypeSelect.addEventListener('change', () => {
      selectedHolidayType = holidayTypeSelect.value;
      toggleSaveButton();
    });

    // Add click event listener to the save button
    saveButton.addEventListener('click', () => {
      // Here, you can send the selectedDivs and selectedHolidayType to the backend
      // using AJAX (e.g., Fetch API or Axios) for further processing and database insertion.
      console.log('Selected Holiday Type:', selectedHolidayType);
      console.log('Selected Divs:', selectedDivs);
      // For example, you can make a POST request to your backend endpoint to handle the data.
      // Replace the URL below with your actual backend endpoint.
    //   fetch('save-holidays', {
    //     method: 'POST',
    //     headers: {
    //       'Content-Type': 'application/json',
    //       'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //     },
    //     body: JSON.stringify({ holidayType: selectedHolidayType, selectedDates: selectedDivs }),
    //   })
    //   .then(response => response.json())
    //   .then(result => {
    //     // Handle the response from the backend if needed
    //     console.log(result);
    //   })
    //   .catch((error) => {
    //         // Handle any errors that occurred during the request
    //         // console.error('Error:', error);
    //     });

      // After successfully saving, reset the selection
      resetSelection();
    });
  </script>


@include('admin.footer')
