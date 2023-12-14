<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration - Payroll Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
  <!-- Include Toastr CSS and JS files -->
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
      <a class="text-xl font-bold" href="#">Payroll System</a>
      <a href="{{ route('login') }}" class="text-white bg-custom-blue hover:bg-blue-800 px-4 py-4 rounded-md" >Login</a>
    </div>
  </nav>

  <div  class="container mx-auto mt-4 px-4 py-6 sm:px-8 md:px-16 lg:px-24 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-6">Employee Registration</h1>

    <form class="grid grid-cols-2 gap-6" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
      <div>
        <label class="block mb-2">First Name:
          @error('first_name')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your first name" name="first_name"  pattern="[A-Za-z]{3,}" title="Please enter valid First name" required >

      </div>

      <div>
        <label class="block mb-2">Last Name:
          @error('last_name')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your last name" name="last_name"  pattern="[A-Za-z]{3,}" title="Please enter valid Last name" required>
      </div>

      <div>
        <label class="block mb-2">Email:
          @error('email')
          <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
        @enderror
        </label>
        <input type="email" id="email" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your email address" name="email" title="Please enter valid Email Address" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" oninvalid="setCustomValidity('Please enter a valid email address')"
        oninput="setCustomValidity('')" required>
      </div>

      <div>
        <label class="block mb-2">Phone:
          @error('phone')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="tel" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your phone number" name="phone" pattern="98\d{8}" title="Please enter a valid 10-digit phone number "  required>
      </div>

      <div>
        <label class="block mb-2">Date of Birth:
          @error('date_of_birth')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
        </label>
        <input type="date" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" name="date_of_birth" required>
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
          <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your bank name" name="bank_name" pattern="[A-Za-z\s]+" title="Please enter valid Bank" required>
        </div>

        <div>
            <label class="block mb-2">Bank Account Number
              @error('bank_account_number')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
            </label>
            <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your bank account number" name="bank_account_number" pattern="\d+" title="Please enter valid account number" required>
        </div>

        <div>
            <label class="block mb-2">Tax Payer Id
              @error('tax_payer_id')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
            </label>
            <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue" placeholder="Enter your tax identification number"  name="tax_payer_id" pattern="\d+" title="Please enter valid Pan number" required>
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
          <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue"  placeholder="Enter your address" name="permanent_address" pattern="[A-Za-z0-9\s]+" title="Please enter valid address" required/>
        </div>

        <div>
          <label class="block mb-2">Mailing Address
            @error('mailing_address')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
          </label>
          <input type="text" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue"  placeholder="Enter your address" name="mailing_address" pattern="[A-Za-z0-9\s]+" title="Please enter valid address" required/>
        </div>

        <div>
            <label class="block mb-2">Document
              @error('document')
            <span class="ml-4 text-red-400 text-sm">{{ $message }}</span>
          @enderror
            </label>
            <input type="file" class="w-full px-4 py-2 border rounded-md border-gray-300 focus:border-custom-blue focus:ring-custom-blue"  name="document" required>
          </div>

      <div class="col-span-2 flex justify-end">
        <button class="text-white bg-blue-800 hover:bg-blue-600 px-6 py-3 rounded-md" type="submit">Register</button>
      </div>
    </form>
  </div>

  <script>
    function validateForm() {
        var emailInput = document.getElementById('email');
        var isValidEmail = validateEmail(emailInput.value);

        if (!isValidEmail) {
            setCustomEmailValidity('Please enter a valid email address');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }

    function validateEmail(email) {
        // Your email validation regex
        var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailRegex.test(email);
    }

    function setCustomEmailValidity(message) {
        var emailInput = document.getElementById('email');
        emailInput.setCustomValidity(message);
    }
</script>

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
