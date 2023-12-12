@extends('layouts.app')
@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
     <div class="container mx-auto mt-5">
         <h1 class="text-3xl font-bold mb-4">Tax Rate</h1>
         @if(session('success'))
         <div class="text-green-500 mb-4">
             {{ session('success') }}
         </div>

     @endif

         <div class="bg-white p-6 rounded-lg shadow-md">

            @if(!isset($taxes))
            <form id="taxRateForm" method="Post" action="{{route('tax.store')}}" >
                @csrf
                 <h2 class="text-2xl font-semibold mb-4">Income Tax Rate Entry
                     <input type="text" class="form-input w-40 ml-6 p-2 text-base border-zinc-800 border-2" placeholder="Enter Year" name="year">
                     <select name="status" class="form-input w-40 ml-6 p-2 text-base border-zinc-800 border-2">
                        <option value="single">Single </option>
                        <option value="couple">Couple</option>
                     </select>
                 </h2>
                 <!-- Tax Rate Entry Fields -->
                 <div class="grid grid-cols-4 gap-4 gap-x-8 ">
                     <div class="text-center">
                         <label class="block mb-2 mt-12 font-semibold">First</label>
                     </div>
                     <div>
                         <label class="block mb-2 font-semibold text-center">Income Range (NPR):</label>
                         <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]">
                     </div>
                     <div>
                         <label class="block mb-2 font-semibold text-center">Tax Rate (%):</label>
                         <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]">
                     </div>
                     <div></div>

                     <div class="text-center">
                         <label class="block mb-2 mt-6 font-semibold">Next</label>
                     </div>
                     <div>
                         <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]">
                     </div>
                     <div>
                         <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]">
                     </div>
                     <div></div>

                     <div class="text-center">
                         <label class="block mb-2 mt-6 font-semibold">Next</label>
                     </div>
                     <div>
                         <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]">
                     </div>
                     <div>
                         <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]">
                     </div>
                     <div></div>

                     <div class="text-center">
                         <label class="block mb-2 mt-6 font-semibold">Next</label>
                     </div>
                     <div>
                         <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]">
                     </div>
                     <div>
                         <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]">
                     </div>
                     <div></div>

                     <div class="text-center">
                         <label class="block mb-2 mt-6 font-semibold">Next</label>
                     </div>
                     <div>
                         <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]">
                     </div>
                     <div>
                         <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]">
                     </div>
                     <div></div>

                     <div class="text-center">
                         <label class="block mb-2 mt-6 font-semibold">Above</label>
                     </div>
                     <div>
                         <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]">
                     </div>
                     <div>
                         <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]">
                     </div>
                     <div></div>


                 </div>

                 <!-- Add More Rows for Additional Income Ranges -->
                 <div class="col-span-4 flex justify-end">
                     <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" id="save" type="submit">Save Tax Rates</button>
                 </div>
             </form>
            @else
                
                @for ($i = 1; $i <= $count; $i++)
                    @php
                    $tax = $taxes[$i-1];  
                @endphp
                    @if ($i==1)
                        
                        <form id="taxRateForm" method="Post" action="{{route('tax.update')}}" >
                            @csrf
                            <h2 class="text-2xl font-semibold mb-4">Income Tax Rate Entry
                                <input type="text" class="form-input w-40 ml-6 p-2 text-base border-zinc-800 border-2" readonly placeholder="Enter Year" name="year" value="{{ $tax->year ?? '' }}">
                                <select name="status" class="form-input w-40 ml-6 p-2 text-base border-zinc-800 border-2">
                                    <option value="{{ $tax->status ?? '' }}">{{ $tax->status ?? '' }} </option>

                                </select>
                            </h2>
                            <!-- Tax Rate Entry Fields -->
                            <div class="grid grid-cols-4 gap-4 gap-x-8 ">
                            <div class="text-center">
                                <label class="block mb-2 mt-12 font-semibold">First</label>
                            </div>
                            <div>
                                <label class="block mb-2 font-semibold text-center">Income Range (NPR):</label>
                                <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]" value="{{ $tax->income ?? '' }}">
                            </div>
                            <div>
                                <label class="block mb-2 font-semibold text-center">Tax Rate (%):</label>
                                <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]" value="{{ $tax->tax_rate ?? '' }}">
                            </div>
                            <div></div>
                    @elseif($i!=1 && $i!=($count))
                        <div class="text-center">
                            <label class="block mb-2 mt-6 font-semibold">Next</label>
                        </div>
                        <div>
                            <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]" value="{{ $tax->income ?? '' }}">
                        </div>
                        <div>
                            <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]" value="{{ $tax->tax_rate ?? '' }}">
                        </div>
                        <div></div>
                    @else
                        <div class="text-center">
                            <label class="block mb-2 mt-6 font-semibold">Above</label>
                        </div>
                        <div>
                            <input type="number" class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter Income" name="income[]" value="{{ $tax->income ?? '' }}">
                        </div>
                        <div>
                            <input type="number"  class="form-input w-full p-4 border-zinc-800 border-2" placeholder="Enter tax rate" name="tax_rate[]" value="{{ $tax->tax_rate ?? '' }}">
                        </div>
                        <div></div>
                        </div>

                        <!-- Add More Rows for Additional Income Ranges -->
                        <div class="col-span-4 flex justify-end">
                            <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" id="save" type="submit">Update</button>
                        </div>
                    </form>
                    @endif

                @endfor
            @endif

             
         </div>

     </div>

    </div>
 </div>
 @endsection
