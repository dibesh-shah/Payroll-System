<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\EmployeeController;

Route::get('/', function () {
    return view('user/welcome');
});
//register
Route::get('/user/register', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('/user', [EmployeeController::class, 'store'])->name('employees.store');

// Login routes
Route::get('/login', [EmployeeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [EmployeeController::class, 'login'])->name('login.submit');

Route::view('/login', 'user/login')->name('login');
Route::view('/admin', 'admin/login');
Route::view('/admin/dashboard', 'admin/dashboard');
Route::view('/admin/approve', 'admin/approve');
Route::view('/admin/approvedetails', 'admin/approvedetails')->name('approvedetail');
Route::view('/admin/department', 'admin/department');
Route::view('/admin/allowance', 'admin/allowance');
Route::view('/admin/deduction', 'admin/deduction');
Route::view('/admin/calendar', 'admin/calendar');
Route::view('/admin/view_employee', 'admin/view_employee');
Route::view('/admin/leave', 'admin/leave');
Route::view('/admin/leave_request', 'admin/leave_request');
Route::view('/admin/leave_detail', 'admin/leave_detail');
Route::post('/admin/save-holidays', [HolidayController::class,'saveHolidays']);
Route::post('/ajax-endpoint', [AjaxController::class,'handleAjaxRequest'])->name('ajax.endpoint');

Route::view('/admin/inbox', 'admin/inbox');
