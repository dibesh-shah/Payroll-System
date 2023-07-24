<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


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
Route::get('/admin/approve', [EmployeeController::class, 'showApprove'])->name('showApprove');
Route::view('/admin/approvedetails', 'admin/approvedetails')->name('approvedetail');


//Department routes
Route::get('/admin/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/admin/departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('/admin/departments', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('/admin/departments/{department}/edit', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::put('/admin/departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('/admin/departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');


//Admin Login
Route::view('/admin', 'admin/login');
