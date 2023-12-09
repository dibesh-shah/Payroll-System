@extends('layouts.master')
@section('content')

<div class="p-4 sm:ml-64">
   <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
    @if(session('success'))
    <div class="text-green-500 mb-4">
        {{ session('success') }}
    </div>
      @endif
   </div>

    <!-- Header Section -->
    <div class="header">
        <h2>Welcome, [Employee Name]!</h2>
        <p>Employee ID: [Employee ID]</p>
    </div>

    <!-- Current Payroll Information -->
    <div class="current-payroll">
        <h3>Payroll for November 2023</h3>
        <p>Net Pay: $X,XXX</p>

        <!-- Earnings and Deductions Overview -->
        <div class="overview">
            <div class="earnings">
                <h4>Earnings</h4>
                <ul>
                    <li>Basic Salary: $X,XXX</li>
                    <li>Overtime: $XXX</li>
                    <li>Bonus: $XXX</li>
                </ul>
            </div>

            <div class="deductions">
                <h4>Deductions</h4>
                <ul>
                    <li>Income Tax: $XXX</li>
                    <li>Health Insurance: $XXX</li>
                </ul>
            </div>
        </div>

        <!-- Status and Approval Information -->
        <div class="status">
            <p>Payroll Status: Approved</p>
            <p>Approval Date: [Date]</p>
            <p>Reason for Rejection: [Reason, if applicable]</p>
        </div>

        <!-- Download/Print Options -->
        <div class="actions">
            <button class="download-button">Download Payroll Statement</button>
            <button class="print-button">Print Payroll</button>
        </div>
    </div>

    <!-- Historical Payroll Information -->
    <div class="historical-payrolls">
        <h3>Historical Payrolls</h3>
        <ul>
            <li>October 2023: Approved</li>
            <li>September 2023: Approved</li>
            <!-- Add more historical payroll entries as needed -->
        </ul>
    </div>

    <!-- Notification or Alert -->
    <div class="notification">
        <p>[Notification: Your payroll for November 2023 has been approved.]</p>
    </div>
</div>

@endsection
