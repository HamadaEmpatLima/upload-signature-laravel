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

Route::get('/document', function () {
    return view('document.index');
})->name('document.index');

Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');

Route::post('api/auth/signin', [App\Http\Controllers\Api\AuthController::class, 'signin'])->name('api.auth.signin');
Route::post('api/auth/register', [App\Http\Controllers\Api\AuthController::class, 'register'])->name('api.auth.register');
Route::get('api/verify-email/{token}', [App\Http\Controllers\Api\AuthController::class, 'verifyToken'])->name('api.verify.email');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    });

    Route::get('/document', function () {
        return view('document.index');
    })->name('document.index');
    Route::get('api/document', [App\Http\Controllers\Api\DocumentController::class, 'index'])->name('api.document.index');
    Route::get('api/document/{id}', [App\Http\Controllers\Api\DocumentController::class, 'find'])->name('api.document.find');
    Route::post('api/document', [App\Http\Controllers\Api\DocumentController::class, 'store'])->name('api.document.store');
    Route::patch('api/document/{id?}', [App\Http\Controllers\Api\DocumentController::class, 'update'])->name('api.document.update');
    Route::delete('api/document/{id}', [App\Http\Controllers\Api\DocumentController::class, 'destroy'])->name('api.document.delete');

    Route::get('api/user', [App\Http\Controllers\Api\UserController::class, 'index'])->name('api.user.index');
    Route::get('api/user/{id}', [App\Http\Controllers\Api\UserController::class, 'find'])->name('api.user.find');
    Route::patch('api/user/{id}', [App\Http\Controllers\Api\UserController::class, 'update'])->name('api.user.update');
    Route::delete('api/user/{id}', [App\Http\Controllers\Api\UserController::class, 'destroy'])->name('api.user.delete');
});
