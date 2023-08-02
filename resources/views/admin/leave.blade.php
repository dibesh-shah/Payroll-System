@include("admin.sidenav")

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Add Leave</h1>
        <div class="max-w  bg-white p-6 rounded-lg shadow-lg">
            <form>
                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <label for="type" class="block text-gray-700 font-semibold mb-2">Leave Type:</label>
                        <input type="text" id="type" name="type" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Leave type" required>
                    </div>
                    <div>
                        <label for="number" class="block text-gray-700 font-semibold mb-2">No. of Days:</label>
                        <input id="leavedays" name="leavedays" class="form-input w-full p-4  border-zinc-800 border-2" placeholder="Enter no. of leave days" required></input>
                    </div>
                    <div>
                        <label for="paid" class="block text-gray-700 font-semibold mb-2">Paid:</label>
                        
                         <select class=" w-full p-4  border-zinc-800 border-2">
                            <option name="paid">Paid</option>
                            <option name="unpaid">Unpaid</option>
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
                    <tr>
                        <td class="py-2 px-4 text-center">1</td>
                        <td class="py-2 px-4 "><input type="text" class="w-full p-4 bg-white text-center" value="Annual Leave" disabled></td>
                        <td class="py-2 px-4"><input type="text" class="w-full p-4 bg-white text-center" value="10" disabled></td>
                        <td class="py-2 px-4"><select class="w-full p-4 bg-white text-center" disabled><option>Paid</option><option>Unpaid</option></select></td>
                        <td class="py-2 px-4 text-center">2023-07-19</td>
                        <td class="py-2 px-4 text-center">2023-07-19</td>
                        <td class="py-2 px-4 text-center">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded mr-2 edit-btn">Edit</button>
                            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded update-btn" style="display:none;">Update</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded delete-btn">Delete</button>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 text-center">1</td>
                        <td class="py-2 px-4 "><input type="text" class="w-full p-4 bg-white text-center" value="Annual Leave" disabled></td>
                        <td class="py-2 px-4"><input type="text" class="w-full p-4 bg-white text-center" value="10" disabled></td>
                        <td class="py-2 px-4"><select class="w-full p-4 bg-white text-center" disabled><option>Paid</option><option>Unpaid</option></select></td>
                        <td class="py-2 px-4 text-center">2023-07-19</td>
                        <td class="py-2 px-4 text-center">2023-07-19</td>
                        <td class="py-2 px-4 text-center">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded mr-2 edit-btn">Edit</button>
                            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded update-btn" style="display:none;">Update</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded delete-btn">Delete</button>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 text-center">1</td>
                        <td class="py-2 px-4 "><input type="text" class="w-full p-4 bg-white text-center" value="Annual Leave" disabled></td>
                        <td class="py-2 px-4"><input type="text" class="w-full p-4 bg-white text-center" value="10" disabled></td>
                        <td class="py-2 px-4"><select class="w-full p-4 bg-white text-center" disabled><option>Paid</option><option>Unpaid</option></select></td>
                        <td class="py-2 px-4 text-center">2023-07-19</td>
                        <td class="py-2 px-4 text-center">2023-07-19</td>
                        <td class="py-2 px-4 text-center">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded mr-2 edit-btn">Edit</button>
                            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded update-btn" style="display:none;">Update</button>
                            <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded delete-btn">Delete</button>
                            
                        </td>
                    </tr>
                    
                    
                    
                </tbody>
            </table>
        </div>
    </div>
    
   </div>
</div>
<script>
    
    var previousLeaveType="";
    var previousDays="";
    var previousPaid="";
    var newLeaveType="";
    var newDays="";
    var newPaid="";
    // Function to enable/disable input and textarea fields
    function toggleEditFields(row, isEdit) {
        const inputFields = row.querySelectorAll('input,select');
        const updateBtn = row.querySelector('.update-btn');

        inputFields.forEach((field,index) => {
            if (isEdit) {
                field.removeAttribute('disabled');
                field.classList.add('border', 'border-gray-300');
                if (index === 0) {
                    previousLeaveType = field.value;
                } else if (index === 1) {
                    previousDays = field.value;
                } else if (index === 2) {
                    previousPaid = field.value;
                }
            } else {
                
                field.setAttribute('disabled', 'disabled');
                field.classList.remove('border', 'border-gray-300');
                if (index === 0) {
                    newLeaveType = field.value;
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
            if(previousLeaveType===newLeaveType && previousDays===newDays && previousPaid===newPaid){
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
                        url:'{{ route("ajax.endpoint") }}',
                        headers:customHeaders,
                        data:{
                            leaveType:newLeaveType,
                            days:newDays,
                            paid:newPaid,
                            modifiedDate:today
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

    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const row = event.target.closest('tr');
            row.classList.add("hidden");
            
        });
    });
</script>

@include('admin.footer')
