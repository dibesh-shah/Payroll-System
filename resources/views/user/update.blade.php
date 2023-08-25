@include("user.sidenav")

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class=" bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Update Profile</h2>
        <form class="grid grid-cols-1 gap-6 sm:grid-cols-2" method="POST" action="hui hui">
            <!-- Contact Information -->
            <div>
                <label class="block mb-2 font-semibold">First Name:</label>
                <input type="tel" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="John" disabled>
                
            </div>
            <div>
                <label class="block mb-2 font-semibold">Last Name:</label>
                <input type="email" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="Doe" disabled>
            </div>
            <div>
                <label class="block mb-2 font-semibold">Phone Number:</label>
                <input type="tel" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter phone number">
                
            </div>
            <div>
                <label class="block mb-2 font-semibold">Email Address:</label>
                <input type="email" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter email address">
            </div>
    
            <!-- Address -->
            <div>
                <label class="block mb-2 font-semibold">Home Address:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter home address">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Mailing Address:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter mailing address">
            </div>
    
            <!-- Personal Information -->
            <div>
                <label class="block mb-2 font-semibold">Date of Birth:</label>
                <input type="date" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Gender:</label>
                <select class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue">
                    <option>Select gender</option>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
    
            <!-- Bank Information -->
            <div>
                <label class="block mb-2 font-semibold">Bank Name:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter bank name">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Bank Account Number:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter bank account number">
            </div>
            
    
            <!-- Tax Information -->
            <div>
                <label class="block mb-2 font-semibold">Tax Identification Number:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter tax identification number">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Tax Filing Status:</label>
                <select class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue">
                    <option>Select filing status</option>
                    <option>Single</option>
                    <option>Married</option>
                </select>
            </div>
    
            <!-- Other Fields and Buttons -->
            <!-- Add more fields based on your needs -->
    
            <div class="col-span-1 sm:col-span-2 flex justify-end">
                <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" id="updateButton" type="submit">Update</button>
            </div>
        </form>
    </div>
    
   </div>
</div>

@include('user.footer')
