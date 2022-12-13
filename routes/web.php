<?php

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

Route::get('/', function () {
    return view('login');
});
Route::get('register', [\App\Http\Controllers\operationController::class,'registrview']);
Route::post('store', [\App\Http\Controllers\OperationController::class,'entertoDB']);
Route::get('checklogin', [\App\Http\Controllers\operationController::class,'checklogin']);
Route::get('login', [\App\Http\Controllers\operationController::class,'login']);
Route::get('/logout', [\App\Http\Controllers\OperationController::class, 'logout'])->name('logout');
Route::get('file-upload', [\App\Http\Controllers\FileUploadController::class,'index']);
Route::post('/storee', [\App\Http\Controllers\FileUploadController::class,'storee']);
