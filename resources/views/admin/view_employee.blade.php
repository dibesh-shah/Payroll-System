@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
       <div class="container mx-auto py-8">
          <div class="flex items-center justify-between mb-6">
              <h1 class="text-3xl font-bold">Employee Detail</h1>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 ">
            
             <div class="flex items-center mb-4">
                <form action="{{ route('employees.viewEmployee') }}" method="GET" class="mb-4 flex flex-wrap">
                    <input type="text" name="search" id="search" class="w-80 px-4 py-2 rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Search by name or empid..." @if(isset($search)) value="{{ $search}} @endif">
                    <input type="hidden" name="id" value=0>
                    <button type="submit" class="ml-4 px-4 py-3 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">View</button>
                </form>
             </div>
             @if(isset($count))
             @if($count > 1)
              <div id="suggestionList" class="absolute bg-white border rounded-md shadow-lg mt-14 w-80  py-2">
                @foreach ($employees as $employee)
                  <a href={{ route('employees.viewEmployee', ['search' => $employee->first_name." ". $employee->last_name, 'id'=>$employee->id]) }} class="block py-2 px-4 no-underline text-black hover:bg-gray-100">{{$employee->first_name}} {{$employee->last_name}}</a>
                @endforeach
                
            </div>
          
             @endif
             @endif
          </div>

          @if(isset($count))
        @if($count == 1)


          <div class="mt-8 bg-white p-6 rounded-lg shadow-lg" id="myDiv">
             <form class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                 <div>
                   <label class="block mb-2">First Name:</label>
                   <input type="text" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->first_name}}" required disabled>
                 </div>
                 <div>
                   <label class="block mb-2">Last Name:</label>
                   <input type="text" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->last_name}}" required disabled>
                 </div>
                 <div>
                   <label class="block mb-2">Email:</label>
                   <input type="email" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->email}}" required disabled>
                 </div>
                 <div>
                   <label class="block mb-2">Phone:</label>
                   <input type="tel" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->phone}}" required disabled>
                 </div>
                 <div>
                   <label class="block mb-2">Date of Birth:</label>
                   <input type="date" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->date_of_birth}}" required disabled>
                 </div>
                 <div>
                   <label class="block mb-2">Address:</label>
                   <input class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->mailing_address}}" required disabled>
                 </div>
                 <div>
                   <label class="block mb-2">Bank Account Number:</label>
                   <input type="text" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->bank_account_number}}" required disabled>
                 </div>
                 <div>
                   <label class="block mb-2">Tax Identification Number:</label>
                   <input type="text" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->tax_payer_id}}" required disabled>
                 </div>
                 <div>
                    <label class="block mb-2">Basic Salary </label>
                    <input type="text" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->salary}}" required disabled>
                  </div>
                  <div>
                    <label class="block mb-2">Department</label>
                    <input type="text" class="w-full bg-white py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->department->name}}" required disabled>
                  </div>
                 <div class="col-span-1 sm:col-span-2 flex justify-end">
                   <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md"  id="editButton">Edit</button>
                   <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md hidden" type="submit" id="updateButton">Update</button>
                 </div>
               </form>
          </div>

          @endif
          @endif

      </div>
    </div>
 </div>

 <script>
  document.getElementById('editButton').addEventListener('click', () => {

    event.preventDefault(); 
      document.getElementById('updateButton').classList.remove('hidden');
      document.getElementById('editButton').classList.add('hidden');

      var inputFields = document.querySelectorAll('#myDiv input');
      inputFields.forEach((input) => {
          input.disabled = false;
          input.classList.add('px-4');
    });
  });
</script>

 

{{-- <script>
  // Function to fetch suggestions and update the suggestion list
  function fetchSuggestions() {
    
      var searchInput = $('#search');
      var suggestionList = $('#suggestionList');

      alert(searchInput.val())

      // Clear previous suggestions
      suggestionList.html('');

      // Fetch suggestions from the backend using jQuery AJAX
      $.ajax({
          url: `/api/employees/suggestions?search=${searchInput.val()}`,
          method: 'GET',
          dataType: 'json',
          success: function (data) {
              // Update the suggestion list
              data.forEach(employee => {
                  var suggestionItem = $('<div>').addClass('cursor-pointer py-1 hover:bg-gray-200').text(employee.name);

                  // Handle click event to fill the search input with the selected suggestion
                  suggestionItem.on('click', function () {
                      searchInput.val(employee.name);
                      suggestionList.addClass('hidden');
                  });

                  suggestionList.append(suggestionItem);
              });

              // Show the suggestion list
              if (data.length > 0) {
                  suggestionList.removeClass('hidden');
              } else {
                  suggestionList.addClass('hidden');
              }
          },
          error: function (error) {
              console.error('Error fetching suggestions:', error);
          }
      });
  }

  // Attach the fetchSuggestions function to the input's input event
  $('#search').on('input', fetchSuggestions);
</script> --}}
 @endsection
