@extends('layouts.master')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class=" bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold mb-4">Update Profile</h2>
        @if(session('success'))
        <div class="text-green-500 mb-4">
            {{ session('success') }}
        </div>
          @endif
            <form action="{{ route('employee.update') }}" method="POST" class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @csrf
                @method('PUT')
            <div>
                <label class="block mb-2 font-semibold">First Name:</label>
                <input type="tel" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->first_name}}" disabled >

            </div>
            <div>
                <label class="block mb-2 font-semibold">Last Name:</label>
                <input type="email" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" value="{{$employee->last_name}}" disabled>
            </div>
            <div>
                <label class="block mb-2 font-semibold">Phone Number:</label>
                <input type="tel" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter phone number"  value="{{$employee->phone}}" name="phone">

            </div>
            <div>
                <label class="block mb-2 font-semibold">Email Address:</label>
                <input type="email" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter email address"  value="{{$employee->email}}" disabled>
            </div>

            <!-- Address -->
            <div>
                <label class="block mb-2 font-semibold">Home Address:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter home address"  value="{{$employee->permanent_address}}" name="permanent_address">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Mailing Address:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter mailing address"  value="{{$employee->mailing_address}}" name="mailing_address">
            </div>

            <!-- Personal Information -->
            <div>
                <label class="block mb-2 font-semibold">Date of Birth:</label>
                <input type="date" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue"  value="{{$employee->date_of_birth}}" name="date_of_birth">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Gender:</label>
                <select class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" name="gender">
                    <option value="male" @if($employee->gender === 'male') selected @endif>Male</option>
                    <option value="female" @if($employee->gender === 'female') selected @endif>Female</option>
                </select>
            </div>

            <!-- Bank Information -->
            <div>
                <label class="block mb-2 font-semibold">Bank Name:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter bank name" value="{{$employee->bank_name}}" name="bank_name">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Bank Account Number:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter bank account number" value="{{$employee->bank_account_number}}" name="bank_account_number">
            </div>


            <!-- Tax Information -->
            <div>
                <label class="block mb-2 font-semibold">Tax Identification Number:</label>
                <input type="text" class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter tax identification number" value="{{$employee->tax_payer_id}}" name="tax_payer_id">
            </div>
            <div>
                <label class="block mb-2 font-semibold">Tax Filing Status:</label>
                <select class="w-full bg-white py-2 border p-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" name="tax_filing_status">
                    <option value="single" @if($employee->tax_filing_status === 'single') selected @endif>Single</option>
                    <option value="married" @if($employee->tax_filing_status === 'married') selected @endif>Married</option>
                </select>

            </div>
            <div class="col-span-1 sm:col-span-2 flex justify-end">
                <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" id="updateButton" type="submit">Update</button>
            </div>
        </form>
    </div>

   </div>
</div>

@endsection
