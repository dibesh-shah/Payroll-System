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
<<<<<<< HEAD

Route::view('/login', 'user/login');
=======
>>>>>>> 0a23985b19acbab78629bbf74bdf5ed44bf1fac9
