<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\FormRequestController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserAuthController;
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
    return view('login');
});

Route::post('/login', [UserAuthController::class, 'login']);
Route::get('/logout', [UserAuthController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('/equipment', [EquipmentController::class, 'index'])->name('equipment_index');
    Route::get('/items', [EquipmentController::class, 'items'])->name('items');
    Route::get('/equipment/create', [EquipmentController::class, 'create']);
    Route::post('/equipment/store', [EquipmentController::class, 'store']);
    Route::get('/equipment/edit/id={id}', [EquipmentController::class, 'edit']);
    Route::get('/equipment/delete/id={id}', [EquipmentController::class, 'destroy']);
    Route::post('/equipment/update/id={id}', [EquipmentController::class, 'update']);
    Route::get('/all_request/detail/id={id}', [FormRequestController::class, 'getAllDetail']);
});

Route::group(['middleware' => 'user'], function () {
    Route::get('/my_request/detail/id={id}', [FormRequestController::class, 'getDetail']);
});

Route::group(['middleware' => 'session'], function () {
    Route::get('/from_request', [FormRequestController::class, 'index'])->name('request');
    Route::post('/from_request/store', [FormRequestController::class, 'store']);
    Route::get('/getModels', [FormRequestController::class, 'getModels']);
});
