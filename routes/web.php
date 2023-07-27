<?php

use Illuminate\Support\Facades\Route;



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