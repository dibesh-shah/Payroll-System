@include("admin.sidenav")

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="container mx-auto mt-5">
        <h1 class="text-3xl font-bold mb-4">Tax Rate</h1>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-center">Income Tax Rate For Year 2080/81
                <button id="newEntry" class="bg-blue-500 text-white py-2 px-4 text-base rounded-md mb-4 float-right">New Entry</button>
            </h2>
            
            <div class="mt-4 mx-auto max-w-4xl">
                
                <table class="w-full border-collapse table-fixed shadow-lg">
                    <thead>
                        <tr>
                            <th class="w-1/3 py-2"></th>
                            <th class="w-1/3 py-2">Income Range (NPR)</th>
                            <th class="w-1/3 py-2">Tax Rate (%)</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-4 text-center">First</td>
                            <td class="py-4 text-center"">500000</td>
                            <td class="py-4 text-center"">10</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 text-center">Next</td>
                            <td class="py-2 text-center"">500000</td>
                            <td class="py-2 text-center"">10</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 text-center">Next</td>
                            <td class="py-2 text-center"">500000</td>
                            <td class="py-2 text-center"">10</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 text-center">Next</td>
                            <td class="py-2 text-center"">500000</td>
                            <td class="py-2 text-center"">10</td>
                        </tr>
                        <tr class="border-b">
                            <td class="py-4 text-center">Next</td>
                            <td class="py-2 text-center"">500000</td>
                            <td class="py-2 text-center"">10</td>
                        </tr>
                    </tbody>
                </table>
                <div class="grid grid-cols-1">
                    <div class="flex justify-end mt-10">
                        <button id="updateButton" class="bg-blue-500 text-white py-2 px-4 rounded-md">Update</button>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
   </div>
</div>

<script>
    const updateButton = document.getElementById('updateButton');

    updateButton.addEventListener('click', function() {
        const currentYear = "2080/81"; 
        const url = `http://127.0.0.1:8000/admin/tax?year=${currentYear}`;
        window.location.href = url;
    });

    newEntry.addEventListener('click', function() {
        const url = `http://127.0.0.1:8000/admin/tax_entry`;
        window.location.href = url;
    });
</script>


@include('admin.footer')
