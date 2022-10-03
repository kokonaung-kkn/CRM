<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

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
Route::get('/', [DashboardController::class,'index'])->middleware('auth');

Route::get('schedule', function(){
    return view('schedule');
});

Route::resource('leads',LeadController::class);
Route::get('leadsearch',[LeadController::class,'search'])->name('leads.search');
Route::put('leads/{lead}/convert', [LeadController::class, 'convert'])->name('leads.convert');

Route::get('/clients',[ClientController::class,'index'])->name('clients.index');
Route::delete('/clients{lead}',[ClientController::class,'destroy'])->name('clients.destroy');
Route::get('clientsearch',[ClientController::class,'search'])->name('clients.search');
Route::get('clients/{lead}/edit',[ClientController::class,'edit'])->name('clients.edit');

Route::resource('staff', UserController::class)->except([
    'create', 'show'
]);

Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
Route::get('/admin/{staff}/edit', [AdminController::class,'edit'])->name('admin.edit');
Route::post('/admin', [AdminController::class, 'store'])->name('admin.store');
Route::delete('/admin{staff}',[AdminController::class,'destroy'])->name('admin.destroy');

Route::resource('tasks',TaskController::class);

Auth::routes([
    'register' => false,
]);
