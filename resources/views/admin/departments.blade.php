@extends('layouts.app')

@section('content')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 rounded-lg dark:border-gray-700 mt-14">
        <div class="container mx-auto mt-5">
            <h1 class="text-3xl font-bold mb-4">Department Details</h1>
            <button id="addDepartmentBtn" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded float-right mb-3">Add Department</button>
            <div id="departmentFormContainer" class="mb-3 hidden">
                <form id="departmentForm" class="flex" action="{{ route('departments.store') }}" method="POST">
                    @csrf
                    <input type="text" class="form-input mr-2" placeholder="Department Name" required name="name">
                    @error('name')
                    <div class="text-sm text-red-700">{{ $message }}</div>
                    @enderror
                    <input type="text" class="form-input mr-2" placeholder="Description" name="description">
                    @error('description')
                    <div class="text-sm text-red-700">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Add</button>
                </form>

            </div>

            <div id="departmentList" class="mt-16">
                @if(session('success'))
                <div class="text-green-500 mb-4">
                    {{ session('success') }}
                </div>

            @endif
                </br>
                @foreach ($departments as $department)
                    <div class="border p-4 rounded-md bg-white shadow-md flex justify-between items-center">
                        <h2 class="text-lg font-bold mb-2">{{ $department->name }}</h2>
                        <div class="dropdown">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded" aria-expanded="false" data-dropdown-toggle="dropdown-department">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </button>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-department">
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('departments.edit', $department->id) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                            </svg>
                                            &nbsp;Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('departments.destroy', $department->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this department?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                &nbsp;Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#addDepartmentBtn").click(function () {
                    $("#departmentFormContainer").toggle();
                });

                // // AJAX to submit the department form
                // $("#departmentForm").submit(function (e) {
                //     e.preventDefault();

                //     const formData = $(this).serialize();
                //     $.post("/add-department", formData, function (data) {
                //         // Process the response and update the department list
                //         const department = JSON.parse(data);
                //         const departmentElement = `
                //             <div class="bg-white shadow-md rounded mb-2 p-4">
                //                 <h5 class="text-lg font-bold mb-2">${department.name}</h5>
                //                 <p class="mb-2">${department.description}</p>
                //                 <div class="dropdown float-right">
                //                     <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded" type="button" data-toggle="dropdown">
                //                         Options
                //                     </button>
                //                     <div class="dropdown-menu">
                //                         <a class="block px-4 py-2 text-gray-800 hover:bg-gray-200" href="#">Edit</a>
                //                         <a class="block px-4 py-2 text-gray-800 hover:bg-gray-200" href="#">Delete</a>
                //                     </div>
                //                 </div>
                //             </div>
                //         `;
                //         $("#departmentList").prepend(departmentElement);
                //     });
                // });
            });
        </script>
    </div>
</div>
@endsection
