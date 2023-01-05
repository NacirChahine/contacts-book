<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;


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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard',[ContactsController::class, 'index'])->name('dashboard');

    Route::get('/contact',[ContactsController::class, 'add']);
    Route::post('/contact',[ContactsController::class, 'create']);
    
    Route::get('/contact/{contact}', [ContactsController::class, 'edit']);
    Route::post('/contact/{contact}', [ContactsController::class, 'update']);
});