<?php

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

Route::prefix('leads')->as('leads.')->group(function (){
    Route::get('/', [\App\Http\Controllers\LeadController::class, 'index'])->name('index');
    Route::post('/add/contact', [\App\Http\Controllers\LeadController::class, 'addContact'])->name('add-contact');
});

Route::prefix('logs')->as('logs.')->group(function (){
    Route::get('/', [\App\Http\Controllers\LogController::class, 'index'])->name('index');
});
