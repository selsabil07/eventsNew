<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventManagerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\exposantController;
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

// routes/api.php
// Route::middleware('auth:api')->group(function() {

// });


Route::middleware('auth:sanctum')->group(function () {
    // Define your routes here that require 'sanctum' guard and 'admin' middleware
       Route::get('/eventManagers', [EventManagerController::class , 'index'])->middleware('admin');
    
       Route::get('/events', [EventController::class , 'index']);

       Route::get('/admin/event/pending', [AdminController::class , 'pendingEvent']);
});

// Route::group(['middleware' => ['isAdmin']], function () {
    
    //  Route::middleware('auth:sanctum')->group(function () {

//         Route::get('/eventManagers', [EventManagerController::class , 'index']);
    
//     });

// });
Route::get('/ShowEventManager', [EventManagerController::class , 'showEventManager']);  

Route::get('/uploadPhoto', [EventManagerController::class , 'upload']);

Route::get('/showPackages', [PackageController::class , 'index']);

Route::post('/createPackage', [PackageController::class , 'create']);

Route::get('/EventCount', [EventController::class , 'EventCount']);

Route::get('/exposantCount', [exposantController::class , 'exposantCount']);

Route::get('/exposantShow', [exposantController::class , 'exposantShow']);


    Route::post('admin/logout', [AdminController::class , 'logout']);

    Route::post('/admin/event/approve/{id}', [AdminController::class , 'approveEvent']);

    Route::post('/admin/eventManager/reject/{id}',[AdminController::class , 'rejectEventManager']);

    Route::get('/eventManagers', [EventManagerController::class , 'index']);

    Route::delete('/delete', [EventManagerController::class , 'destroy']);
    
    Route::get('/search/{first_name}', [EventManagerController::class , 'search']);
    
    Route::post('/update/{id}', [EventManagerController::class , 'update']);

    Route::get('/count', [EventManagerController::class , 'EventManagerCount']);  

    Route::get('/ShowEventManager/{id}', [EventManagerController::class , 'showEventManager']);  

    Route::post('/createEvent', [EventController::class , 'create']);

    Route::get('/ShowEvent/{id}', [EventController::class , 'show']);

    Route::get('/events', [EventController::class , 'index']);

    Route::post('/updateEvent/{id}', [EventController::class , 'update']);

    Route::delete('/delete/{id}', [EventController::class , 'destroy']);

    Route::get('/admin', [AdminController::class , 'index']);


    Route::get('/allEvents', [EventController::class , 'index']);

    Route::get('/approvedEvents', [EventController::class , 'approvedEvents']);

    Route::get('/nonApprovedEvents', [EventController::class , 'nonApprovedEvents']);
    
    Route::get('/nonApprovedEvents/show', [EventController::class , 'showEvent']);

    Route::post('/updateEvent/{id}', [EventController::class , 'update']);

    Route::post('/ShowEvent', [EventController::class , 'show']);

    Route::post('/createEvent', [EventController::class , 'create']);

// });

Route::post('admin/login', [AdminController::class , 'login']);

Route::post('eventManager/register', [EventManagerController::class , 'register']);

Route::post('eventManager/login', [EventManagerController::class , 'login']);

// // web.php (or admin.php for admin routes)/

// Route::middleware('eventManager')->group(function () {

//     Route::delete('/delete/{id}', [EventController::class , 'destroy']);

//     Route::get('/approvedEvents', [EventController::class , 'approvedEvents']);

//     Route::get('/EventCount', [EventController::class , 'EventCount']);

//     Route::post('/updateEvent/{id}', [EventController::class , 'update']);

//     Route::post('/ShowEvent', [EventController::class , 'show']);

//     Route::post('/createEvent', [EventController::class , 'create']);



Route::get('/', function () {
    return view('welcome');
});

 


