<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration - Payroll Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
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
      <a class="text-white bg-custom-blue hover:bg-blue-800 px-4 py-2 rounded-md" href="login">Login</a>
    </div>
  </nav>

  <div class="container mx-auto px-4 py-8 sm:px-8 md:px-16 lg:px-24">
    <h1 class="text-3xl font-bold mb-6">Employee Registration</h1>
  </br>
    <form class="grid grid-cols-1 gap-6 sm:grid-cols-2">
      <div>
        <label class="block mb-2">First Name:</label>
        <input type="text" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your first name" required>
      </div>
      <div>
        <label class="block mb-2">Last Name:</label>
        <input type="text" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your last name" required>
      </div>
      <div>
        <label class="block mb-2">Email:</label>
        <input type="email" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your email address" required>
      </div>
      <div>
        <label class="block mb-2">Phone:</label>
        <input type="tel" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your phone number" required>
      </div>
      <div>
        <label class="block mb-2">Date of Birth:</label>
        <input type="date" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" required>
      </div>
      <div>
        <label class="block mb-2">Address:</label>
        <input class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your address" required>
      </div>
      <div>
        <label class="block mb-2">Bank Account Number:</label>
        <input type="text" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your bank account number" required>
      </div>
      <div>
        <label class="block mb-2">Tax Identification Number:</label>
        <input type="text" class="w-full px-4 py-2 rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your tax identification number" required>
      </div>
      <div class="col-span-1 sm:col-span-2 flex justify-end">
        <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" type="submit">Register</button>
      </div>
    </form>
  </div>

</body>

</html>
