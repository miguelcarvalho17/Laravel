<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Http\Request;
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

Route::get('/homeCompany', [HomeController::class, 'companyHome'])->middleware('isCompany')->name('homeCompany');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/form',[CompanyController::class,'create'])->middleware('isCompany')->name('form');
Route::post('/form', [CompanyController::class,'store'])->middleware('isCompany');
Route::delete('/formEditRemove/{id}',[CompanyController::class,'removeJob'])->middleware('isCompany')->name('job.remove'); //passar id para saber qual remover
Route::get('/formEditRemove',[CompanyController::class,'listJobs'])->name('formEditRemove');
Route::put('/formEditRemove/{id}',[CompanyController::class,'editJobs'])->name('job.edit');

Route::delete('/formEditRemove/{id}',[AdminController::class,'removeJob'])->middleware('isAdmin')->name('job.remove'); //passar ir para saber qual remover
Route::get('/formEditRemove',[AdminController::class,'listJobs'])->middleware('isAdmin')->name('formEditRemove');
Route::put('/formEditRemove/{id}',[AdminController::class,'editJobs'])->middleware('isAdmin')->name('job.edit');

Route::get('/{job}', [JobController::class, 'show'])
    ->name('showJob');

Route::get('/{job}/apply', [JobController::class, 'apply'])
    ->name('applyJob');



