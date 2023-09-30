<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxController;
use App\Models\Holiday;
use App\Models\Leave;

Route::get('/', function () {
    return view('employee/welcome');
});


// Employee routes
Route::middleware(['guest'])->prefix('employee')->group(function () {
    Route::get('/register', [EmployeeController::class, 'createWithDepartment'])->name('employees.register');
    Route::post('/register', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/login', [EmployeeController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [EmployeeController::class, 'login'])->name('login.submit');
});

// Department routes
Route::prefix('admin')->group(function () {
    Route::get('/department', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('/department', [DepartmentController::class, 'store'])->name('departments.store');
    Route::post('/department/edit', [DepartmentController::class,'edit'])->name('departments.edit');
    Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
});

// Leave  routes
Route::prefix('admin')->group(function () {
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
    Route::get('/leave/create', [LeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveController::class, 'store'])->name('leave.store');
    Route::post('/leave/edit', [LeaveController::class,'edit'])->name('leave.edit');
    Route::delete('/leave/{leave}', [LeaveController::class, 'destroy'])->name('leave.destroy');
});

// Approve  routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('approve', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/approve/approve/{id}', [EmployeeController::class, 'approveEmployee'])->name('employees.approve');
    Route::post('/approve/reject/{id}', [EmployeeController::class, 'rejectEmployee'])->name('employees.reject');
    Route::get('/approve/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/view_employee', [EmployeeController::class, 'viewEmployee'])->name('employees.viewEmployee');
});

// Allowance  routes
Route::prefix('admin')->group(function () {
    Route::get('/allowance', [AllowanceController::class, 'index'])->name('allowance.index');
    Route::get('/allowance/create', [AllowanceController::class, 'create'])->name('allowance.create');
    Route::post('/allowance', [AllowanceController::class, 'store'])->name('allowance.store');
    Route::post('/allowance/edit', [AllowanceController::class,'edit'])->name('allowance.edit');
    Route::delete('/allowance/{allowance}', [AllowanceController::class, 'destroy'])->name('allowance.destroy');
});

// Deduction  routes
Route::prefix('admin')->group(function () {
    Route::get('/deduction', [DeductionController::class, 'index'])->name('deduction.index');
    Route::get('/deduction/create', [DeductionController::class, 'create'])->name('deduction.create');
    Route::post('/deduction', [DeductionController::class, 'store'])->name('deduction.store');
    Route::post('/deduction/edit', [DeductionController::class,'edit'])->name('deduction.edit');
    Route::delete('/deduction/{deduction}', [DeductionController::class, 'destroy'])->name('deduction.destroy');
});



Route::view('/admin', 'admin/login');

// Route::view('/admin/calendar', 'admin/calendar')->name('calender');
Route::get('/admin/calendar', [HolidayController::class, 'getHolidays'])->name('admin.calendar');
Route::view('/admin/leave_request', 'admin/leave_request');
Route::view('/admin/leave_detail', 'admin/leave_detail');
Route::post('/admin/save-holidays', [HolidayController::class,'saveHolidays']);
Route::post('/ajax-endpoint', [AjaxController::class,'handleAjaxRequest'])->name('ajax.endpoint');


Route::view('/dashboard', 'employee/dashboard')->name('employees.dashboard');

Route::get('/employee/attendance', [AttendanceController::class, 'index'])->name('employee.attendance');
Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('clock.in');
Route::post('/clock-out', [AttendanceController::class, 'clockOut'])->name('clock.out');

Route::get('/attendance', [AttendanceController::class, 'showAttendance'])->name('attendance.show');


Route::view('/leave_balance', 'employee/leave_balance');
Route::view('/leave_history', 'employee/leave_history');
Route::view('/admin/tax_entry', 'admin/tax_entry');

// Route::view('/calendar', 'employee/calendar');
// Route::view('/admin/inbox', 'admin/inbox');

Route::get('/admin/inbox', [InboxController::class, 'index'])->name('admin.inbox');
Route::get('/admin/inbox/{id}', [InboxController::class, 'getUser'])->name('admin.getUser');
Route::get('/employee/inbox', [InboxController::class, 'indexEmp'])->name('employee.inbox');
Route::Post('/employee/inbox', [InboxController::class, 'storeEmp']);
Route::Post('/admin/inbox', [InboxController::class, 'store']);

Route::Post('/admin/inbox/search', [InboxController::class, 'search']);

Route::Post('/employee/inbox/adminMssgFetch', [InboxController::class, 'getMessage']); 
Route::Post('/admin/inbox/employeeMssgFetch', [InboxController::class, 'getMessage']); 


Route::get('/employee/tax', [TaxController::class, 'indexEmp'])->name('taxEmp');
Route::get('/admin/tax', [TaxController::class, 'index'])->name('tax');
Route::post('/admin/tax_entry', [TaxController::class, 'store'])->name('tax.store');

Route::get('/employee/leave_apply', [LeaveController::class, 'leaveHolidays'])->name('employee.leaveApply');
Route::get('/employee/calendar', [HolidayController::class, 'showHolidays'])->name('employee.calendar');
Route::post('/employee/logout', [ProfileController::class, 'logout'])->name('logout');
Route::get('/employee/profile', [ProfileController::class, 'profile'])->name('employee.profile');
Route::get('/employee/update', [ProfileController::class, 'edit'])->name('employee.edit');
Route::put('/employee/update',[ProfileController::class, 'update'])->name('employee.update');
Route::get('/employee/password', [ProfileController::class, 'password'])->name('employee.password');
Route::post('/employee/password', [ProfileController::class, 'changePassword'])->name('employee.changePassword');


