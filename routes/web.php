<?php

use Illuminate\Support\Facades\Route;

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