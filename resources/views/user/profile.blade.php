@include("user.sidenav")

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class=" bg-white p-6 rounded-lg shadow-lg" >
        <!-- My Information -->
        <fieldset class="border p-4 rounded w-full">
            <legend class="font-semibold mb-4 text-xl">My Information</legend>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="font-semibold ">First Name:</div>
                    <div class="font-normal mt-1 mb-2">John</div>
                </div>
                <div>
                    <div class="font-semibold ">Last Name:</div>
                    <div class="font-normal mt-1 mb-2">Doe</div>
                </div>
                <div>
                    <div class="font-semibold">Email:</div>
                    <div class="font-normal mt-1 mb-2">John@gmail.com</div>
                </div>
                <div>
                    <div class="font-semibold">Address:</div>
                    <div class="font-normal mt-1 mb-2">Greenland</div>
                </div>
                <div>
                    <div class="font-semibold">Bank:</div>
                    <div class="font-normal mt-1 mb-2">NIC Asia</div>
                </div>
                <div>
                    <div class="font-semibold">Bank Account:</div>
                    <div class="font-normal mt-1 mb-2">5656565655466</div>
                </div>
                
                <!-- Add other fields here -->
            </div>
        </fieldset>
    
        <!-- Salary -->
        <fieldset class="border p-4 rounded mt-4 ">
            <legend class="font-semibold mb-4 text-xl">Salary</legend>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="font-semibold">Basic Salary:</div>
                    <div class="font-normal mt-1 mb-2">Rs 50,000</div>
                </div>
            </div>
        </fieldset>
    
        <!-- Allowance -->
        <fieldset class="border p-4 rounded mt-4">
            <legend class="font-semibold mb-4 text-xl">Allowances</legend>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="font-semibold">Travel Allowance:</div>
                    <div class="font-normal mt-1 mb-2">$500</div>
                </div>
                <div>
                    <div class="font-semibold">Housing Allowance:</div>
                    <div class="font-normal mt-1 mb-2">$300</div>
                </div>
                <div>
                    <div class="font-semibold">Meal Allowance:</div>
                    <div class="font-normal mt-1 mb-2">$150</div>
                </div>
                <div>
                    <div class="font-semibold">Communication Allowance:</div>
                    <div class="font-normal mt-1 mb-2">$50</div>
                </div>
                <!-- Add other allowance fields here -->
            </div>
        </fieldset>
    
        <!-- Deduction -->
        <fieldset class="border p-4 rounded mt-4">
            <legend class="font-semibold mb-4 text-xl">Deductions</legend>
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <div class="font-semibold">Meal Deduction:</div>
                    <div class="font-normal mt-1 mb-2">$150</div>
                </div>
                <div>
                    <div class="font-semibold">Communication Deduction:</div>
                    <div class="font-normal mt-1 mb-2">$50</div>
                </div>
                <!-- Add other deduction fields here -->
            </div>
        </fieldset>
    </div>
    
   </div>
</div>

@include('user.footer')
