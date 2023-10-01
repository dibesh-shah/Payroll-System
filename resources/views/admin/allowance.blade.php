@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
     <div class="container mx-auto mt-5">
         <h1 class="text-3xl font-bold mb-4">Add Allowance</h1>
         <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
             <form action="{{route('allowance.store')}}" method="POST">
                @csrf
                 <div class="grid grid-cols-2 gap-6">
                     <div>
                         <label for="type" class="block text-gray-700 font-semibold mb-2">Allowance Type:</label>
                         <input type="text" id="type" name="name" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter allowance type" required>
                     </div>
                     <div>
                         <label for="description" class="block text-gray-700 font-semibold mb-2">Description:</label>
                         <input id="description" name="description" class="form-input w-full p-4  border-zinc-800 border-2" placeholder="Enter allowance description" required>
                     </div>
                 </div>
                 <div class="flex justify-end mt-4">
                     <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Add Allowance</button>
                 </div>
             </form>
         </div>

         <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
             <h2 class="text-xl font-bold mb-4">Allowance List</h2>
             @if(session('success'))
             <div class="text-green-500 mb-4">
                 {{ session('success') }}
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
                     @foreach ($allowances as $allowance)
                     <tr>
                        <td class="py-2 px-4 text-center"><span>{{$allowance->id}}</span></td>
                        <td class="py-2 px-4 "><input type="text" class="w-full p-4 bg-white" value="{{$allowance->name}}" disabled name="name"></td>
                        <td class="py-2 px-4"><input type="text" class="w-full p-4 bg-white" value="{{$allowance->description}}" disabled name="description"></td>
                        <td class="py-2 px-4 text-center">{{$allowance->created_at}}</td>
                        <td class="py-2 px-4 text-center">{{$allowance->updated_at}}</td>
                        <td class="py-2 px-4 text-center flex flex-wrap ">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded mr-2 edit-btn"> Edit</button>
                            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded update-btn mr-2" style="display:none;">Update</button>
                            <form action="{{ route('allowance.destroy', $allowance->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded">Delete</button>
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
      var previousAllowance="";
     var previousDescription="";
     var newAllowance="";
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
                    previousAllowance = field.value;
                 } else if (index === 1) {
                    previousDescription = field.value;
                 }
             } else {

                 field.setAttribute('disabled', 'disabled');
                 field.classList.remove('border', 'border-gray-300');
                 if (index === 0) {
                    newAllowance = field.value;
                 } else if (index === 1) {
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
             if(previousAllowance===newAllowance && previousDescription===newDescription){
                     console.log("no change");
                 }else{
                     const now = new Date();
                     const year = now.getFullYear();
                     const month = now.getMonth();

                     const today = year+"-"+(month+1)+"-"+(now.getDate()) ;
                     const customHeaders = {
                         'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                     };

                     $.ajax({
                         type:"POST",
                         url:'allowance/edit',
                         headers:customHeaders,
                         data:{
                            id:id,
                             name:newAllowance,
                             description:newDescription,
                            //  modifiedDate:today
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
 </script>
 @endsection
