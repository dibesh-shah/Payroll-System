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
// Approve  routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'showDashboard']);
    Route::get('approve', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/approve/approve/{id}', [EmployeeController::class, 'approveEmployee'])->name('employees.approve');
    Route::post('/approve/reject/{id}', [EmployeeController::class, 'rejectEmployee'])->name('employees.reject');
    Route::get('/approve/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/view_employee', [EmployeeController::class, 'viewEmployee'])->name('employees.viewEmployee');
});




Route::view('/admin', 'admin/login');

Route::view('/admin/calendar', 'admin/calendar')->name('calender');
Route::view('/admin/leave_request', 'admin/leave_request');
Route::view('/admin/leave_detail', 'admin/leave_detail');
Route::post('/admin/save-holidays', [HolidayController::class,'saveHolidays']);
Route::post('/ajax-endpoint', [AjaxController::class,'handleAjaxRequest'])->name('ajax.endpoint');

Route::view('/admin/inbox', 'admin/inbox');

// Protect other routes with the auth middleware
// Route::middleware(['auth'])->group(function () {
Route::view('/dashboard', 'employee/dashboard')->name('employees.dashboard');
Route::view('/inbox', 'employee/inbox');
Route::view('/calendar', 'employee/calendar');
// Route::view('/attendance', 'employee/attendance');
// Route::middleware(['auth'])->group(function () {
Route::get('/employee/attendance', [AttendanceController::class, 'index'])->name('employee.attendance');
Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('clock.in');
Route::post('/clock-out', [AttendanceController::class, 'clockOut'])->name('clock.out');
// });
Route::get('/attendance', [AttendanceController::class, 'showAttendance'])->name('attendance.show');


Route::view('/leave_apply', 'employee/leave_apply');
Route::view('/leave_balance', 'employee/leave_balance');
Route::view('/leave_history', 'employee/leave_history');
Route::post('/logout', [EmployeeController::class, 'logout'])->name('logout');


