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
      <a class="text-xl font-bold" href="#">Payroll System</a>
      <a href="{{ route('login') }}" class="text-white bg-custom-blue hover:bg-blue-800 px-4 py-4 rounded-md" >Login</a>
    </div>
  </nav>

  <div  class="container mx-auto mt-4 px-4 py-6 sm:px-8 md:px-16 lg:px-24 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-6">Employee Registration</h1>
    @if(session('success'))
    <div class="text-green-500 mb-4">
        {{ session('success') }}
    </div>

@endif
    <form class="grid grid-cols-2 gap-6" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
      <div>
        <label class="block mb-2">First Name:
          @error('first_name')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your first name" name="first_name" required >

      </div>

      <div>
        <label class="block mb-2">Last Name:
          @error('last_name')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your last name" name="last_name" required>
      </div>

      <div>
        <label class="block mb-2">Email:
          @error('email')
          <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
        @enderror
        </label>
        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your email address" name="email" required>
      </div>

      <div>
        <label class="block mb-2">Phone:
          @error('phone')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your phone number" name="phone" required>
      </div>

      <div>
        <label class="block mb-2">Date of Birth:
          @error('date_of_birth')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="date" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" name="date_of_birth" required max="{{ date('Y-m-d', strtotime('-18 years')) }}">

      </div>

      <div>
          <Label class="block mb-2">Gender</Label>
          <select  class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-custom-blue focus:ring-custom-blue" name="gender">
              <Option value="male">Male</Option>
              <option value="female">Female</option>
          </select>
      </div>
      <div>
          <label class="block mb-2">Bank Name
            @error('bank_name')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
          </label>
          <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your bank account number" name="bank_name" required>
        </div>

        <div>
            <label class="block mb-2">Bank Account Number
              @error('bank_account_number')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
            </label>
            <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your bank account number" name="bank_account_number" required>
        </div>

        <div>
            <label class="block mb-2">Tax Payer Id
              @error('tax_payer_id')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
            </label>
            <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your tax identification number"  name="tax_payer_id" required>
        </div>

        <div>
          <Label class="block mb-2">Tax Filing Status</Label>
          <select  class="w-full px-4 py-2 rounded-md border border-gray-300 focus:border-custom-blue focus:ring-custom-blue" name="tax_filing_status">
              <Option value="single">Single</Option>
              <option value="married">Married</option>
          </select>
      </div>

        <div>
          <label class="block mb-2">Permanent Address
            @error('permanent_address')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
          </label>
          <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue"  placeholder="Enter your address" name="permanent_address" required/>
        </div>

        <div>
          <label class="block mb-2">Mailing Address
            @error('mailing_address')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
          </label>
          <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue"  placeholder="Enter your address" name="mailing_address" required/>
        </div>

        <div>
            <label class="block mb-2">Document
              @error('document')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
            </label>
            <input type="file" accept=".pdf, .doc, .docx" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" name="document" required>

          </div>

      <div class="col-span-2 flex justify-end">
        <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" type="submit">Register</button>
      </div>
    </form>
  </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
      const form = document.querySelector("form");

      // Add event listeners to input fields
      const inputs = form.querySelectorAll("input, select");
      inputs.forEach((input) => {
        input.addEventListener("blur", validateField);
      });

      function validateField(event) {
        const input = event.target;
        const fieldName = input.getAttribute("name");
        const value = input.value;

        // Reset previous error messages
        const errorMessage = input.parentElement.querySelector(".text-red-400");
        if (errorMessage) {
          errorMessage.textContent = "";
        }

        // Validate based on field name
        switch (fieldName) {
          case "email":
            if (!isValidEmail(value)) {
              displayErrorMessage(input, "Invalid email format");
            }
            break;

          case "phone":
            if (!isValidPhone(value)) {
              displayErrorMessage(input, "Invalid phone format");
            }
            break;

          // Add more cases for other fields...

          default:
            break;
        }
      }

      function isValidEmail(email) {
        const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
        return emailRegex.test(email);
      }

      function isValidPhone(phone) {
        const phoneRegex = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
        return phoneRegex.test(phone);
      }

      function displayErrorMessage(inputElement, message) {
        const errorMessage = document.createElement("span");
        errorMessage.className = "ml-4 text-red-400 text-sm";
        errorMessage.textContent = message;
        inputElement.parentElement.appendChild(errorMessage);
      }
    });
  </script>

</html>
