<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AjaxController;



Route::get('/', function () {
    return view('user/welcome');
});

Route::get('/register', function () {
    return view('user/register');
});

Route::view('/login', 'user/login');
Route::view('/admin', 'admin/login');
Route::view('/admin/dashboard', 'admin/dashboard');
Route::view('/admin/approve', 'admin/approve');
Route::view('/admin/approvedetails', 'admin/approvedetails')->name('approvedetail');
Route::view('/admin/department', 'admin/department');
Route::view('/admin/allowance', 'admin/allowance');
Route::view('/admin/deduction', 'admin/deduction');
Route::view('/admin/calendar', 'admin/calendar');
Route::view('/admin/tax', 'admin/tax');
Route::view('/admin/tax_entry', 'admin/tax_entry');
Route::view('/admin/view_employee', 'admin/view_employee');
Route::view('/admin/leave', 'admin/leave');
Route::view('/admin/leave_request', 'admin/leave_request');
Route::view('/admin/leave_detail', 'admin/leave_detail');
Route::post('/admin/save-holidays', [HolidayController::class,'saveHolidays']);

Route::post('/ajax-endpoint', [AjaxController::class,'handleAjaxRequest'])->name('ajax.endpoint');

Route::view('/admin/inbox', 'admin/inbox');


Route::view('/dashboard', 'user/dashboard');
Route::view('/inbox', 'user/inbox');
Route::view('/calendar', 'user/calendar');
Route::view('/attendance', 'user/attendance');
Route::view('/leave_apply', 'user/leave_apply');
Route::view('/leave_balance', 'user/leave_balance');
Route::view('/leave_history', 'user/leave_history');
Route::view('/profile', 'user/profile');
Route::view('/update', 'user/update');
Route::view('/password', 'user/password');