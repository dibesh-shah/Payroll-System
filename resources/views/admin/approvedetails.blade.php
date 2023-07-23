@include("admin.sidenav")

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
      <div class="container mx-auto py-8">
         <div class="flex items-center justify-between mb-6">
             <h1 class="text-3xl font-bold">Employee Details</h1>
         </div>
         <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
             <!-- Employee details here (dummy data) -->
             <div class="border p-4 rounded-md bg-white shadow-md">
                 <h2 class="text-lg font-bold mb-2">Employee Name</h2>
                 <p class="mb-2">John Doe</p>
                 <!-- Add more details here as needed -->
             </div>
             <div class="border p-4 rounded-md bg-white shadow-md">
                 <h2 class="text-lg font-bold mb-2">Employee ID</h2>
                 <p class="mb-2">123456</p>
                 <!-- Add more details here as needed -->
             </div>
         </div>
         <!-- Form for entering new employee details -->
         <form class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
             <div>
                 <label class="block mb-2">Employee Name:</label>
                 <input type="text" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
             </div>
             <div>
                 <label class="block mb-2">Shift:</label>
                 <input type="text" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
             </div>
             <div>
                 <label class="block mb-2">Salary:</label>
                 <input type="number" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
             </div>
             <div>
                 <label class="block mb-2">Allowance:</label>
                 <input type="number" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
             </div>
             <div>
                 <label class="block mb-2">Deduction:</label>
                 <input type="number" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
             </div>
             <div>
                 <label class="block mb-2">Date of Join:</label>
                 <input type="date" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200" required>
             </div>
             <div class="col-span-2">
                 <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-md">Submit</button>
             </div>
         </form>
     </div>
   </div>
</div>

@include('admin.footer')
