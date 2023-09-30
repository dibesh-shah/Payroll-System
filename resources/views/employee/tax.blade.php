@extends('layouts.master')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
     <div class="container mx-auto mt-5">
         <h1 class="text-3xl font-bold mb-4">Tax Rate</h1>

         <div class="bg-white p-6 rounded-lg shadow-md">
             <h2 class="text-2xl font-semibold mb-4 text-center">Income Tax Rate For Year @foreach ($taxes as $tax)
                {{$tax->year}}
                @php break; @endphp
             @endforeach

             </h2>

             <div class="mt-4 mx-auto max-w-4xl grid-cols-2">

                 <table class="w-full border-collapse table-fixed shadow-lg">
                     <thead>
                        <tr>
                            <th></th>
                            <th colspan="2">Single</th>
                            <th colspan="2">Couple</th>

                        </tr>
                         <tr>
                             <th class="w-1/3 py-2"></th>
                             <th class="w-1/3 py-2">Income Range (NPR)</th>
                             <th class="w-1/3 py-2">Tax Rate (%)</th>
                             <th class="w-1/3 py-2">Income Range (NPR)</th>
                             <th class="w-1/3 py-2">Tax Rate (%)</th>

                         </tr>
                     </thead>
                     <tbody>
                        @php
                        $length = count($classData['single']);
                        $val = 1;
                        @endphp
                        @foreach ($classData['single'] as $tax1)
                            @php $tax2 = $classData['couple'][ $loop->index ]; @endphp
                        <tr class="border-b">

                            <td class="py-4 text-center">
                                @php if ($val == 1) {
                                    echo "First";
                                }elseif ($val == $length) {
                                    echo "Above";
                                }else {
                                    echo "Next";
                                }
                                $val++;
                                @endphp
                                </td>

                                <td class="py-4 text-center">{{$tax1->income}}</td>
                                <td class="py-4 text-center">{{$tax1->tax_rate}}</td>
                                <td class="py-4 text-center">{{$tax2->income}}</td>
                                <td class="py-4 text-center">{{$tax2->tax_rate}}</td>



                        </tr>
                    @endforeach


                     </tbody>
                 </table>


             </div>
         </div>
     </div>
    </div>
 </div>

 {{-- <script>
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
 </script> --}}
 @endsection
