@extends('layouts.master')
@section('content')


<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    <div class="flex justify-center">
        <div class="w-full">
            <div class=" bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4">Change Password</h2>
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <form action="{{ route('employee.changePassword') }}" method="POST" class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                @csrf
                    <!-- Old Password -->
                    <div class="col-span-2 relative">
                        <label class="block mb-2 font-semibold">Old Password:</label>
                        <div class="flex items-center">
                            <input type="password" class="w-2/3 bg-white border p-2 pr-10 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter old password" id="oldPassword" name="old_password">
                            <span class="ml-2 cursor-pointer toggle-password" data-target="oldPassword">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                  </svg>


                            </span>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div class="col-span-2 relative">
                        <label class="block mb-2 font-semibold">New Password:</label>
                        <div class="flex items-center">
                            <input type="password" class="w-2/3 bg-white border p-2 pr-10 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter new password" id="newPassword" name="new_password">
                            <span class="ml-2 cursor-pointer toggle-password" data-target="newPassword">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                  </svg>


                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-span-2 relative">
                        <label class="block mb-2 font-semibold">Confirm Password:</label>
                        <div class="flex items-center">
                            <input type="password" class="w-2/3 bg-white border p-2 pr-10 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Confirm new password" id="confirmPassword" name="confirm_password">
                            <span class="ml-2 cursor-pointer toggle-password" data-target="confirmPassword">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                  </svg>


                            </span>
                        </div>
                    </div>

                    <!-- Add other password fields similarly -->

                    <div class="col-span-2 flex justify-start mt-2">
                        <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" id="changePasswordButton">Change Password</button>
                    </div>
                </form>
                 @error('old_password')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror

                @error('new_password')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror

                @error('confirm_password')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
   </div>
</div>

<script>
    const togglePasswordIcons = document.querySelectorAll(".toggle-password");

    togglePasswordIcons.forEach(icon => {
        icon.addEventListener("click", function () {
            const targetId = icon.getAttribute("data-target");
            const targetField = document.getElementById(targetId);

            if (targetField.type === "password") {
                targetField.type = "text";
                icon.innerHTML = '';
                icon.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>`;
            } else {
                targetField.type = "password";
                icon.innerHTML = '';
                icon.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    `;
            }
        });
    });
</script>

@endsection
