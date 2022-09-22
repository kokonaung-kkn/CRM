<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\StaffController;
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
Route::get('/', function(){
    return view('dashboard');
});

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

Route::resource('staff', StaffController::class)->except([
    'create', 'show'
]);
