<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login.index');
})->name('login');

Route::get('/register', function () {
    return view('auth.register.index');
})->name('register');

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/document', function () {
    return view('document.index');
})->name('document.index');
// Route::get('/document', function () {
//     return view('document.form');
// })->name('document.form');

Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');
