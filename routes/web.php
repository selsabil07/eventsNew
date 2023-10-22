<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventManagerController;

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
    return view('welcome');
});

Route::get('/eventManagers', [EventManagerController::class , 'index']);


Route::get('/admin/eventManager/pending', [AdminController::class , 'pendingEventManager']);



Route::post('/admin/eventManager/approve/{id}', 'AdminController@approveEventManager')->name('admin.approveEventManager');
Route::post('/admin/eventManager/reject/{eventManager}', 'AdminController@rejectEventManager')->name('admin.rejectEventManager');
