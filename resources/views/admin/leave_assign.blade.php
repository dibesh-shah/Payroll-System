@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Assign Leave  </h1>
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">

            <form action="assign_leave" method="post" id="leaveForm">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Assign Leave by:</label>
                    <div class="mt-2 space-x-4">
                        <input type="radio" id="assignByEmployeeId" name="assignBy" value="employeeId" class="mr-2" required>
                        <label for="assignByEmployeeId">Employee ID</label>
    
                        <input type="radio" id="assignByDesignation" name="assignBy" value="designation" class="mr-2" required>
                        <label for="assignByDesignation">Designation</label>
    
                        <input type="radio" id="assignByDepartment" name="assignBy" value="department" class="mr-2" required>
                        <label for="assignByDepartment">Department</label>
                    </div>
                </div>
    
                <div class="mb-4" id="employeeIdField" style="display: none;">
                    <label for="employeeId" class="block text-sm font-medium text-gray-600">Employee ID:</label>
                    <input type="number" id="employeeId" name="employeeId" class="mt-1 p-2 w-full border rounded-md"  >
                </div>
    
                <div class="mb-4" id="designationField" style="display: none;">
                    <label for="designation" class="block text-sm font-medium text-gray-600">Designation:</label>
                    <select id="designation" name="designation" class="mt-1 p-2 w-full border rounded-md">
                        @foreach ($designations as $designation )
                            @if ($designation != null)
                        <option value="{{$designation}}">{{$designation}}</option>
                                
                            @endif
                            
                        @endforeach
                        <!-- Add more options based on your organization's designations -->
                    </select>
                </div>
    
                <div class="mb-4" id="departmentField" style="display: none;">
                    <label for="department" class="block text-sm font-medium text-gray-600">Department:</label>
                    <select id="department" name="department" class="mt-1 p-2 w-full border rounded-md">
                        @foreach ($departments as $department )
                            @if ($department != null)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                                
                            @endif
                            
                        @endforeach
                        <!-- Add more options based on your organization's departments -->
                    </select>
                </div>
    
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600">Leave Types:</label>
                    <div class="mt-2 space-y-2">
                        @foreach ($leaves as $leave )
                        <input type="checkbox" id="{{$leave->id}}" name="leaveTypes[]" value="{{$leave->id}}" class="mr-2">
                        <label for="{{$leave->name}}" class="mr-4">{{$leave->name}}</label>
                        @endforeach
                        
    
    
                        <!-- Add more checkboxes for other leave types -->
                    </div>
                </div>
    
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600" >Assign Leave</button>
    
            </form>
        </div>

       
    </div>

   </div>
</div>
<script>
    // JavaScript to toggle visibility of input fields based on the selected option
    document.addEventListener('DOMContentLoaded', function () {
        const assignByEmployeeId = document.getElementById('assignByEmployeeId');
        const assignByDesignation = document.getElementById('assignByDesignation');
        const assignByDepartment = document.getElementById('assignByDepartment');
        const employeeIdField = document.getElementById('employeeIdField');
        const designationField = document.getElementById('designationField');
        const departmentField = document.getElementById('departmentField');

        // Function to toggle visibility
        function toggleVisibility(field, show) {
            field.style.display = show ? 'block' : 'none';
        }

        // Event listener for radio buttons
        assignByEmployeeId.addEventListener('change', function () {
            toggleVisibility(employeeIdField, this.checked);
            toggleVisibility(designationField, !this.checked);
            toggleVisibility(departmentField, !this.checked);
            var employeeIdInput = document.getElementById('employeeId');
            employeeIdInput.required = true;
        });

        assignByDesignation.addEventListener('change', function () {
            toggleVisibility(employeeIdField, !this.checked);
            toggleVisibility(designationField, this.checked);
            toggleVisibility(departmentField, !this.checked);
            var employeeIdInput = document.getElementById('employeeId');
            employeeIdInput.required = false;
        });

        assignByDepartment.addEventListener('change', function () {
            toggleVisibility(employeeIdField, !this.checked);
            toggleVisibility(designationField, !this.checked);
            toggleVisibility(departmentField, this.checked);
            var employeeIdInput = document.getElementById('employeeId');
            employeeIdInput.required = false;
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const leaveForm = document.getElementById('leaveForm');

        leaveForm.addEventListener('submit', function (event) {
            const checkboxes = document.querySelectorAll('input[name="leaveTypes[]"]');
            let atLeastOneChecked = false;
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    atLeastOneChecked = true;
                }
            });

            if (!atLeastOneChecked) {
                // Prevent the form submission if no checkbox is checked
                event.preventDefault();
                alert('Please select leave type.');
            }
        });
    });
</script>

{{-- <script>
    function validateForm() {
        var emailInput = document.getElementById('email');
        var isValidEmail = validateEmail(emailInput.value);

        if (!isValidEmail) {
            setCustomEmailValidity('Please enter a valid email address');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script> --}}

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
  {{-- @if(session('error'))
      <script>
          // Display Toastr success message
          toastr.error("{{ session('error') }}");
      </script>
  @endif --}}

 @endsection
