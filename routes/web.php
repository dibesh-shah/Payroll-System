<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\AllowanceOptionController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\DeductionOptionController;
use App\Http\Controllers\ApproveEmployeeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\HolidayController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('employees/welcome');
});
//register
Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');

// Login routes
Route::get('/login', [EmployeeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [EmployeeController::class, 'login'])->name('login.submit');

// Dashboard route
Route::get('/admin/dashboard', [EmployeeController::class, 'showDashboard']);
Route::get('/admin/approveEmployees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('/admin/approveEmployees/approve/{id}', [EmployeeController::class, 'approveEmployee'])->name('employees.approve');
Route::post('/admin/approveEmployees/reject/{id}', [EmployeeController::class, 'rejectEmployee'])->name('employees.reject');
Route::get('/admin/approveEmployees/{id}',[EmployeeController::class, 'show'])->name('employees.show');
Route::get('/admin/view_employee', [EmployeeController::class, 'viewEmployee'])->name('employees.viewEmployee');






//Department routes
Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/admin/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('/admin/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');


//Leave Type routes

Route::get('/admin/leaveTypes', [LeaveTypeController::class, 'index'])->name('leaveTypes.index');
Route::get('/admin/leaveTypes/create', [LeaveTypeController::class, 'create'])->name('leaveTypes.create');
Route::post('/admin/leaveTypes', [LeaveTypeController::class, 'store'])->name('leaveTypes.store');
Route::post('/admin/leaveTypes/edit', [LeaveTypeController::class,'edit'])->name('leaveTypes.edit');
// Route::get('/admin/leaveTypes/{leaveType}/edit', [LeaveTypeController::class, 'edit'])->name('leaveTypes.edit');
// Route::put('/admin/leaveTypes/{leaveType}', [LeaveTypeController::class, 'update'])->name('leaveTypes.update');
Route::delete('/admin/leaveTypes/{leaveType}', [LeaveTypeController::class, 'destroy'])->name('leaveTypes.destroy');

//Allowance routes
// Route::get('/admin/allowance', [AllowanceController::class, 'index'])->name('allowance.index');

//AllowanceOption routes
Route::get('/admin/allowanceOptions', [AllowanceOptionController::class, 'index'])->name('allowanceOptions.index');
Route::get('/admin/allowanceOptions/create', [AllowanceOptionController::class, 'create'])->name('allowanceOptions.create');
Route::post('/admin/allowanceOptions', [AllowanceOptionController::class, 'store'])->name('allowanceOptions.store');
Route::post('/admin/allowanceOptions/edit', [AllowanceOptionController::class,'edit'])->name('allowanceOptions.edit');

Route::delete('/admin/allowanceOptions/{allowanceOption}', [AllowanceOptionController::class, 'destroy'])->name('allowanceOptions.destroy');



//Deduction Routes
// Route::get('/admin/deduction', [DeductionController::class, 'index'])->name('deduction.index');

//DeductionOption Routes
Route::get('/admin/deductionOptions', [DeductionOptionController::class, 'index'])->name('deductionOptions.index');
Route::get('/admin/deductionOptions/create', [DeductionOptionController::class, 'create'])->name('deductionOptions.create');
Route::post('/admin/deductionOptions', [DeductionOptionController::class, 'store'])->name('deductionOptions.store');
Route::post('/admin/deductionOptions/edit', [DeductionOptionController::class,'edit'])->name('deductionOptions.edit');

Route::delete('/admin/deductionOptions/{deductionOption}', [DeductionOptionController::class, 'destroy'])->name('deductionOptions.destroy');




//Admin Login
Route::view('/admin', 'admin/login');

Route::view('/admin/calendar', 'admin/calendar')->name('calender');
Route::post('/admin/save-holidays', [HolidayController::class,'saveHolidays']);
// Route::view('/admin/leave', 'admin/leave');
Route::view('/admin/leave_request', 'admin/leave_request');
Route::view('/admin/leave_detail', 'admin/leave_detail');
