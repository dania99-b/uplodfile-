<?php

use App\Http\Middleware\CheckApiToken;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register_user',[\App\Http\Controllers\UserController::class, 'store_user']);
Route::group(['middleware' =>[CheckApiToken::class]], function(){
    Route::post('/uploadFile',[App\Http\Controllers\FileUploadController::class,'storee']);
Route::post('/deleteFile',[App\Http\Controllers\FileUploadController::class,'delete_file']);
Route::post('/add_group',[\App\Http\Controllers\GroupController::class, 'add_group']);
    Route::post('/add_file_group',[\App\Http\Controllers\GroupController::class, 'add_file_togroup']);
    Route::post('/delete_file_group',[\App\Http\Controllers\GroupController::class, 'delete_file_fromgroup']);
    Route::post('/add_user_group',[\App\Http\Controllers\GroupController::class, 'add_user_togroup']);
    Route::post('/delete_user_group',[\App\Http\Controllers\GroupController::class, 'delete_user_fromgroup']);
    Route::post('/delete_group_noreservFiles',[\App\Http\Controllers\GroupController::class, 'delete_GroupNoreserv_files']);
    Route::get('/uploaded_file',[\App\Http\Controllers\FileUploadController::class,'uploaded_file']);

    Route::get('/show_user_group',[\App\Http\Controllers\GroupController::class,'show_user_group']);
    Route::get('/show_files_group',[\App\Http\Controllers\GroupController::class,'show_files_group']);
    Route::post('/show_usersname_reserv_file',[\App\Http\Controllers\FileUploadController::class,'show_usersname_reserv_file']);
    Route::get('/cache',[\App\Http\Controllers\FileUploadController::class,'cache_file']);
    Route::post('/read_file',[\App\Http\Controllers\FileUploadController::class,'read_file']);
    Route::post('/checkin',[\App\Http\Controllers\FileUploadController::class,'checkin_file']);
    Route::post('/checkout',[\App\Http\Controllers\FileUploadController::class,'checkout_file']);


});
Route::post('/add_public_group',[\App\Http\Controllers\GroupController::class,'add_public_group']);



Route::prefix('user')->group(function() {
    // authenticated staff routes here
    Route::post('login',[\App\Http\Controllers\UserController::class,'userLogin']);
});
