<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\AllowanceOptionController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\DeductionOptionController;
use App\Http\Controllers\ApproveEmployeeController;


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
Route::get('/admin/approveEmployees', [ApproveEmployeeController::class, 'index'])->name('approveEmployees.index');
Route::get('/employees/approve/{id}', [ApproveEmployeeController::class, 'approveEmployee'])->name('employees.approve');
Route::get('/employees/reject/{id}', [ApproveEmployeeController::class, 'rejectEmployee'])->name('employees.reject');

Route::view('/admin/approvedetails', 'admin/approvedetails')->name('approvedetail');


//Department routes
Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/admin/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('/admin/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

//Allowance routes
// Route::get('/admin/allowance', [AllowanceController::class, 'index'])->name('allowance.index');

//AllowanceOption routes
Route::get('/admin/allowanceOptions', [AllowanceOptionController::class, 'index'])->name('allowanceOptions.index');
Route::get('/admin/allowanceOptions/create', [AllowanceOptionController::class, 'create'])->name('allowanceOptions.create');
Route::post('/admin/allowanceOptions', [AllowanceOptionController::class, 'store'])->name('allowanceOptions.store');



//Deduction Routes
// Route::get('/admin/deduction', [DeductionController::class, 'index'])->name('deduction.index');

//DeductionOption Routes
Route::get('/admin/deductionOptions', [DeductionOptionController::class, 'index'])->name('deductionOptions.index');
Route::get('/admin/deductionOptions/create', [DeductionOptionController::class, 'create'])->name('deductionOptions.create');
Route::post('/admin/deductionOptions', [DeductionOptionController::class, 'store'])->name('deductionOptions.store');





//Admin Login
Route::view('/admin', 'admin/login');
