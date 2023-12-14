<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Payroll Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <style>
    .custom-blue {
      --color-primary: #3B82F6;
    }
  </style>
</head>

<body class="bg-gray-100">
  <nav class="bg-gray-900 text-white px-8 py-4">
    <div class="container mx-auto flex justify-between items-center">
      <a class="text-xl font-bold" href="/">Payroll System</a>
      <a class="text-white bg-blue-800 px-4 py-2 rounded-md" href="register">Register</a>
    </div>
  </nav>

  <div class="container mx-auto h-screen flex justify-center items-center ">
    <div class="bg-gray-200 p-8 rounded-md shadow-md w-96">
      <h1 class="text-3xl font-bold mb-6">Login</h1>
      {{-- @if(session('success'))
      <div class="text-green-500 mb-4">
          {{ session('success') }}
      </div>
        @endif --}}
      <form method="POST" action="{{route('login.submit')}}">
        @csrf
        <div class="mb-4">
          <label class="block mb-2">Email:</label>
          <input type="email" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your email" required name="email">
        </div>
        <div class="mb-6">
          <label class="block mb-2">Password:</label>
          <input type="password" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your password" required name="password">
        </div>
        <button class="w-full text-white bg-blue-800 hover:bg-blue-600 py-2 rounded-md" type="submit">Login</button>
      </form>
      <p class="mt-4 text-center">
        Don't have an account? <a href="{{route('employees.register')}}">Register here</a>
      </p>
    </div>
  </div>

  <script>
    toastr.options = {
        "positionClass": "toast-bottom-right",
        "progressBar": true,
        "timeOut": 5000, // Duration in milliseconds
    }
  </script>
  
  @if(session('success'))
      <script>
          // Display Toastr success message
          toastr.success("{{ session('success') }}");
      </script>
  @endif
</body>

</html>
