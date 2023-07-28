@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
     <div class="container mx-auto mt-5">
         <h1 class="text-3xl font-bold mb-4">Add Deduction</h1>
         <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
             <form action="{{route('deductionOptions.store')}}" method="POST">
                @csrf
                 <div class="grid grid-cols-2 gap-6">
                     <div>
                         <label for="type" class="block text-gray-700 font-semibold mb-2">Deduction Type:</label>
                         <input type="text" id="type" name="name" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter allowance type" required>
                     </div>
                     <div>
                         <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
                         <input id="description" name="description" class="form-input w-full p-4  border-zinc-800 border-2" placeholder="Enter allowance description" required>>
                     </div>
                 </div>
                 <div class="flex justify-end mt-4">
                     <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Add Deductions</button>
                 </div>
             </form>
         </div>

         <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
             <h2 class="text-xl font-bold mb-4">Deduction List</h2>
             @if(session('success'))
             <div class="text-green-500 mb-4">
                 {{ session('success') }}
             </div>
         @else
         <div class="text-red-500 mb-4">
         Deduction creation failed.
         </div>
         @endif

             <table class="w-full border-collapse">
                 <thead>
                     <tr>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">ID</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Type</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Description</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Created Date</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Modified Date</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                     <!-- Sample Data (Replace with dynamic data from backend) -->

                     @foreach ($deductionOptions as $deductionOption)
                     <tr>
                        <td class="py-2 px-4 text-center">{{$deductionOption->id}}</td>
                        <td class="py-2 px-4  "><input type="text" class="w-full p-4 bg-white text-center"  disabled>{{ $deductionOption->name }}</td>
                        <td class="py-2 px-4 "><input type="text" class="w-full p-4 bg-white text-center"  disabled>{{ $deductionOption->description }}</td>
                        <td class="py-2 px-4 text-center">{{$deductionOption->created_at}}</td>
                        <td class="py-2 px-4 text-center">{{$deductionOption->updated_at}}</td>
                        <td class="py-2 px-4 text-center">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded mr-2 edit-btn">Edit</button>
                            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded update-btn" style="display:none;">Update</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded">Delete</button>

                        </td>
                    </tr>
                     @endforeach


                 </tbody>
             </table>
         </div>
     </div>

    </div>
 </div>
 <script>
     // Function to enable/disable input and textarea fields
     function toggleEditFields(row, isEdit) {
         const inputFields = row.querySelectorAll('input');
         const updateBtn = row.querySelector('.update-btn');

         inputFields.forEach((field) => {
             if (isEdit) {
                 field.removeAttribute('disabled');
                 field.classList.add('border', 'border-gray-300');
             } else {
                 field.setAttribute('disabled', 'disabled');
                 field.classList.remove('border', 'border-gray-300');
             }
         });

         // Toggle the "Update" and "Edit" buttons
         updateBtn.style.display = isEdit ? 'inline' : 'none';
         row.querySelector('.edit-btn').style.display = isEdit ? 'none' : 'inline';
     }

     // Event listener for "Edit" button click
     const editButtons = document.querySelectorAll('.edit-btn');

     editButtons.forEach((button) => {
         button.addEventListener('click', (event) => {
             const row = event.target.closest('tr');
             toggleEditFields(row, true);
         });
     });

     // Event listener for "Update" button click
     const updateButtons = document.querySelectorAll('.update-btn');

     updateButtons.forEach((button) => {
         button.addEventListener('click', (event) => {
             const row = event.target.closest('tr');
             toggleEditFields(row, false);
         });
     });
 </script>
 @endsection
