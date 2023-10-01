@extends('layouts.app')
@section('content')



 <div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
     <div class="container mx-auto mt-5">
         <h1 class="text-3xl font-bold mb-4">Add Leave</h1>
         <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
             <form action="{{ route('departments.store') }}" method="POST">
                 @csrf
                  <div class="grid grid-cols-2 gap-6">
                      <div>
                          <label for="type" class="block text-gray-700 font-semibold mb-2">Department Name</label>
                          <input type="text" id="name" name="name" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter department name" required>
                      </div>
                      <div>
                          <label for="number" class="block text-gray-700 font-semibold mb-2">Description</label>
                          <input id="leavedays"
                          type="text" name="description" class="form-input w-full p-4  border-zinc-800 border-2" placeholder="description" required>
                      </div>

                  </div>
                  <div class="flex justify-end mt-4">
                      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Add Department</button>
                  </div>

              </form>
         </div>

         <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
             <h2 class="text-xl font-bold mb-4">Leave List</h2>
             @if(session('success'))
                 <div class="text-green-500 mb-4">
                     {{ session('success') }}
                 </div>

             @endif
             <table class="w-full border-collapse">
                 <thead>
                     <tr>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">ID</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Department</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Description</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Created Date</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Modified Date</th>
                         <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                     <!-- Sample Data (Replace with dynamic data from backend) -->
                     @foreach($departments as $department)
                     <tr>
                         <td class="py-2 px-4 text-center"><span>{{$department->id}}</span></td>
                         <td class="py-2 px-4 "><input type="text" class="w-full p-4 bg-white text-center" value="{{$department->name}}" disabled name="name"></td>
                         <td class="py-2 px-4"><input type="text" class="w-full p-4 bg-white text-center" value="{{$department->description}}" disabled name="description"></td>
                         <td class="py-2 px-4 text-center">{{ $department->created_at }}</td>
                         <td class="py-2 px-4 text-center">{{ $department->updated_at }}</td>
                         <td class="py-2 px-4 text-center flex flex-wrap">
                             <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded mr-2 edit-btn">Edit</button>
                             <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded update-btn" style="display:none;">Update</button>
                             <form action="{{ route('departments.destroy', $department->id) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded delete-btn" type="submit">Delete</button>
                             </form>

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

     var previousDepartment="";
     var previousDescription="";
     var newDepartment="";
     var newDescription="";
     // Function to enable/disable input and textarea fields
     function toggleEditFields(row, isEdit) {
         const inputFields = row.querySelectorAll('input,select');
         const updateBtn = row.querySelector('.update-btn');

         inputFields.forEach((field,index) => {
             if (isEdit) {
                 field.removeAttribute('disabled');
                 field.classList.add('border', 'border-gray-300');

                 if (index === 0) {
                    previousDepartment = field.value;
                 } else if (index === 1) {
                    previousDescription = field.value;
                 }

             } else {

                 field.setAttribute('disabled', 'disabled');
                 field.classList.remove('border', 'border-gray-300');
                 if (index === 0) {
                    newDepartment = field.value;
                 } else if (index === 1) {
                     newDays = field.value;
                 } else if (index === 2) {
                     newDescription = field.value;
                 }


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
             const $row = $(row);
              var id = $row.find('span').text();
             if(previousDepartment===newDepartment && previousDescription===newDescription){
                     console.log("no change");
                 }else{

                     const customHeaders = {
                         'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                     };
                     $.ajax({
                         type:"POST",
                         url:'departments/edit',
                         headers:customHeaders,
                         data:{
                             id:id,
                             name:newDepartment,
                             description:newDescription,

                         },
                         cache:false,
                         success:function(data){
                             console.log(data)
                         },
                         error:function(){

                         }
                     });
                 }
         });
     });

     // const deleteButtons = document.querySelectorAll('.delete-btn');
     // deleteButtons.forEach((button) => {
     //     button.addEventListener('click', (event) => {
     //         const row = event.target.closest('tr');
     //         row.classList.add("hidden");

     //     });
     // });
 </script>


@endsection
