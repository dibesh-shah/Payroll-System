@include("user.sidenav")

<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14 ">
     
     <h2 class="text-2xl font-semibold mb-4">Leave History</h2>
        
        <!-- Search Filter -->
        <div class="flex items-center space-x-2 mb-4">
            <label for="search" class="font-medium">Search:</label>
            <input type="text" id="search" class=" w-96 p-2 border rounded-md p-1">
        </div>
        
       <div class="space-y-2">
            <div class="bg-white p-4 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-lg font-semibold">June</span>
                </div>
                <!-- Individual Leave Entries -->
                <div class="space-y-2">
                    <!-- Leave Entry 1 -->
                    <div class="bg-white p-2 rounded-md shadow-md relative">
                        <span class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 toggle-dropdown">▼</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Leave ID:</span>
                            <span>123</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Start Date:</span>
                            <span>2023-06-01</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">End Date:</span>
                            <span>2023-06-10</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Status:</span>
                            <span>Approved</span>
                        </div>
                        <!-- Dropdown Content -->
                        <div class="hidden message-container">
                            <div class="employee-message text-gray-700 mt-2">
                                <strong>Employee Message:</strong> Lorem ipsum dolor sit amet... Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.
                            </div>
                            <div class="admin-response text-green-600 mt-2">
                                <strong>Admin Response:</strong> Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request.Thank you for your request. It has been approved.
                            </div>
                        </div>
                    </div>

                    <!-- Leave Entry 2 (similar structure) -->
                    <div class="bg-white p-2 rounded-md shadow-md relative">
                        <span class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 toggle-dropdown">▼</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Leave ID:</span>
                            <span>123</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Start Date:</span>
                            <span>2023-06-01</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">End Date:</span>
                            <span>2023-06-10</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Status:</span>
                            <span>Approved</span>
                        </div>
                        <!-- Dropdown Content -->
                        <div class="hidden message-container">
                            <div class="employee-message text-gray-700 mt-2">
                                <strong>Employee Message:</strong> Lorem ipsdfkfkjdfum dolor sit amet...
                            </div>
                            <div class="admin-response text-green-600 mt-2">
                                <strong>Admin Response:</strong> Thank you for your request. It has been approved.
                            </div>
                        </div>
                    </div>

                    <!-- Leave Entry 3 (similar structure) -->
                    <div class="bg-white p-2 rounded-md shadow-md relative">
                        <span class="cursor-pointer absolute top-0 right-0 mt-2 mr-2 toggle-dropdown">▼</span>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Leave ID:</span>
                            <span>123</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Start Date:</span>
                            <span>2023-06-01</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">End Date:</span>
                            <span>2023-06-10</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-medium">Status:</span>
                            <span>Approved</span>
                        </div>
                        <!-- Dropdown Content -->
                        <div class="hidden message-container">
                            <div class="employee-message text-gray-700 mt-2">
                                <strong>Employee Message:</strong> Lorem ipsum dolor sit amet...
                            </div>
                            <div class="admin-response text-green-600 mt-2">
                                <strong>Admin Response:</strong> Thank you for your rkdfjkdequest. It has been approved.
                            </div>
                        </div>
                    </div>
                    <!-- Add more leave entries for the month -->
                </div>
            </div>
            <!-- Add more months and their leave entries -->
        </div>


    </div>
 </div>
 <script>
    // jQuery code to toggle the hidden content
    $(document).ready(function() {
    $(document).on('click', '.toggle-dropdown', function() {

        if ($(this).text() === "▼") {
            $(this).text("▲");
        } else {
            $(this).text("▼");
        }
        $(this).parent().find('.hidden').toggle();

    });
});
</script>

@include('user.footer')
