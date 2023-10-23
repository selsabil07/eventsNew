<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventManagerController;
use App\Http\Controllers\PackageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::post('admin/logout', [AdminController::class , 'logout']);

    Route::post('/admin/eventManager/approve/{id}', [AdminController::class , 'approveEventManager']);

    Route::post('/admin/eventManager/reject/{id}',[AdminController::class , 'rejectEventManager']);

    Route::get('/eventManagers', [EventManagerController::class , 'index']);

    Route::delete('/delete', [EventManagerController::class , 'destroy']);
    
    Route::get('/search/{first_name}', [EventManagerController::class , 'search']);
    
    Route::post('/update/{id}', [EventManagerController::class , 'update']);
    
    Route::post('/addPackage', [PackageController::class , 'create']);    

});

Route::post('admin/login', [AdminController::class , 'login']);

Route::post('eventManager/register', [EventManagerController::class , 'register']);

Route::post('eventManager/login', [EventManagerController::class , 'login']);

Route::get('/admin/eventManager/pending', [AdminController::class , 'pendingEventManager']);



