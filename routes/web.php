<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::get('/', [JobController::class,'indexMainPage']);

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout']); //logout route

Route::get('/', [JobController::class, 'indexMainPage'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/form',[CompanyController::class,'create'])->middleware('isCompany')->name('form');
Route::post('/form', [CompanyController::class,'store'])->middleware('isCompany');
Route::delete('/formEditRemove/{id}',[CompanyController::class,'removeProducts'])->name('product.remove'); //passar id para saber qual remover
Route::get('/formEditRemove',[CompanyController::class,'idexAllProducts'])->name('formEditRemove');
Route::put('/formEditRemove/{id}',[CompanyController::class,'editProducts'])->name('product.edit');

Route::get('/{job}', [JobController::class, 'show'])
    ->name('showJob');

Route::get('/{job}/apply', [JobController::class, 'apply'])
    ->name('applyJob');

