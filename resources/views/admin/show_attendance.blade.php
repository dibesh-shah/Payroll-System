@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
        <div class="container mx-auto mt-5">

            <div>
                <h1>Search Employee Attendance</h1>

                <form id="searchForm">
                    @csrf
                    <label for="employee_id">Employee ID:</label>
                    <input type="text" name="employee_id" required>

                    <label for="month">Month (YYYY-MM):</label>
                    <input type="text" name="month" required>

                    <button type="button" onclick="searchAttendance()">Search</button>
                </form>

                <div id="attendanceResults">
                    {{-- Display search results here --}}
                </div>
            </div>


        </div>

    </div>

</div>
<script>
    function searchAttendance() {
        const form = document.getElementById('searchForm');
        const formData = new FormData(form);

        fetch('{{ route('admin.showAttendance') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add Laravel CSRF token if needed
            },
            body: JSON.stringify({ employee_id: employeeId, month: month }),
        })
        .then(response => response.json())
        .then(data => {
            // Handle the data and update the HTML
            const attendanceResults = document.getElementById('attendanceResults');
            // Check if there are results
            if (data.length > 0) {
                // Create a table to display the results
                const table = document.createElement('table');
                table.border = '1';

                // Create the table header
                const headerRow = table.insertRow();
                const dateHeader = headerRow.insertCell(0);
                dateHeader.innerHTML = '<b>Date</b>';

                const clockInHeader = headerRow.insertCell(1);
                clockInHeader.innerHTML = '<b>Clock In</b>';

                const clockOutHeader = headerRow.insertCell(2);
                clockOutHeader.innerHTML = '<b>Clock Out</b>';

                // Iterate over each attendance record and create rows
                data.forEach(attendance => {
                    const row = table.insertRow();
                    const dateCell = row.insertCell(0);
                    dateCell.innerHTML = attendance.date;

                    const clockInCell = row.insertCell(1);
                    clockInCell.innerHTML = attendance.clock_in;

                    const clockOutCell = row.insertCell(2);
                    clockOutCell.innerHTML = attendance.clock_out;
                });

                // Replace the content of the results div with the table
                attendanceResults.innerHTML = '';
                attendanceResults.appendChild(table);
            } else {
                attendanceResults.innerHTML = 'No attendance records found.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endsection
