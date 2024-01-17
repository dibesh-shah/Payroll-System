@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Add Leave</h1>
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
            <form action="{{route('leave.store')}}" method="POST">
                @csrf
                 <div class="grid grid-cols-3 gap-6">
                     <div>
                         <label for="type" class="block text-gray-700 font-semibold mb-2">Leave Type:</label>
                         <input type="text" id="type" name="name" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Leave type" required pattern="[A-Za-z\s]+" title="Please enter valid Leave Type">
                     </div>
                     <div>
                         <label for="number" class="block text-gray-700 font-semibold mb-2">No. of Days:</label>
                         <input type="number" id="leavedays" name="days" class="form-input w-full p-4  border-zinc-800 border-2" placeholder="Enter no. of leave days" min="1" >
                     </div>
                     <div>
                         <label for="paid" class="block text-gray-700 font-semibold mb-2">Paid:</label>

                          <select class=" w-full p-4  border-zinc-800 border-2" name="type">
                             <option value="paid">Paid</option>
                             <option value="unpaid">Unpaid</option>
                          </select>

                     </div>
                 </div>
                 <div class="flex justify-end mt-4">
                     <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Add Leave</button>
                 </div>
             </form>
        </div>

        <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4">Leave List</h2>
          
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">ID</th>
                        <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Leave Type</th>
                        <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">No. of Days</th>
                        <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Paid/Unpaid</th>
                        <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Created Date</th>
                        <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Modified Date</th>
                        <th class="py-2 px-4 bg-gray-200 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data (Replace with dynamic data from backend) -->
                    @foreach($leaves as $leave)
                    <tr>
                        <td class="py-2 px-4 text-center"><span>{{$leave->id}}</span></td>
                        <td class="py-2 px-4 "><input type="text" class="w-full p-4 bg-white text-center" value="{{$leave->name}}" disabled name="name" required pattern="[A-Za-z\s]+" title="Please enter valid Leave Type"></td>
                        <td class="py-2 px-4"><input type="number" class="w-full p-4 bg-white text-center" value="{{$leave->days}}" disabled name="days"  min="1"></td>
                        <td class="py-2 px-4">
                            <select class="w-full p-4 bg-white text-center"  disabled name="type">
                                <option value="paid" @if($leave->type === 'paid') selected @endif>Paid</option>
                                <option value="unpaid" @if($leave->type === 'unpaid') selected @endif>Unpaid</option>


                            </select>
                        </td>
                        <td class="py-2 px-4 text-center">{{ $leave->created_at }}</td>
                        <td class="py-2 px-4 text-center">{{ $leave->updated_at }}</td>
                        <td class="py-2 px-4 text-center flex flex-wrap">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded mr-2 edit-btn"><i class="text-blue-500">te</i>Edit<i class="text-blue-500">tt</i></button>
                            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 mr-2 rounded update-btn" style="display:none;">Update</button>
                            <form action="{{ route('leave.destroy', $leave->id) }}" method="POST">
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

    var previousLeave="";
    var previousDays="";
    var previousPaid="";
    var newLeave="";
    var newDays="";
    var newPaid="";
    var id="";
    // Function to enable/disable input and textarea fields
    function toggleEditFields(row, isEdit) {
        const inputFields = row.querySelectorAll('input,select');
        const updateBtn = row.querySelector('.update-btn');

        inputFields.forEach((field,index) => {
            if (isEdit) {
                field.removeAttribute('disabled');
                field.classList.add('border', 'border-gray-300');

                if (index === 0) {
                    previousLeave = field.value;
                } else if (index === 1) {
                    previousDays = field.value;
                } else if (index === 2) {
                    previousPaid = field.value;
                // } else if (index === 3) {
                //     id = field.value;
                }

            } else {

                field.setAttribute('disabled', 'disabled');
                field.classList.remove('border', 'border-gray-300');
                if (index === 0) {
                    newLeave = field.value;
                } else if (index === 1) {
                    newDays = field.value;
                } else if (index === 2) {
                    newPaid = field.value;
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
            if(previousLeave===newLeave && previousDays===newDays && previousPaid===newPaid){
                    console.log("no change");
                }else{

                    const customHeaders = {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    };
                    $.ajax({
                        type:"POST",
                        url:'leave/edit',
                        headers:customHeaders,
                        data:{
                            id:id,
                            name:newLeave,
                            days:newDays,
                            type:newPaid,
                            // modifiedDate:
                        },
                        cache:false,
                        success:function(data){
                            console.log(data)
                            toastr.success(data.message);
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
