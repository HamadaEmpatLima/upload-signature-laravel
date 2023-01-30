<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/signin', [AuthController::class, 'signin'])->name('api.auth.signin');
Route::post('auth/register', [AuthController::class, 'register'])->name('api.auth.register');
Route::get('verify-email/{token}', [AuthController::class, 'verifyToken'])->name('api.verify.email');

Route::get('document', [DocumentController::class, 'index'])->name('api.document.index');
Route::get('document/{id}', [DocumentController::class, 'find'])->name('api.document.find');
Route::post('document', [DocumentController::class, 'store'])->name('api.document.store');
Route::patch('document/{id?}', [DocumentController::class, 'update'])->name('api.document.update');
Route::delete('document/{id}', [DocumentController::class, 'destroy'])->name('api.document.delete');

Route::get('user', [UserController::class, 'index'])->name('api.user.index');
Route::get('user/{id}', [UserController::class, 'find'])->name('api.user.find');
Route::patch('user/{id}', [UserController::class, 'update'])->name('api.user.update');
Route::delete('user/{id}', [UserController::class, 'destroy'])->name('api.user.delete');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
