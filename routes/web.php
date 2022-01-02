<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/', [JobController::class, 'indexMainPage'])->name('welcome');

Route::get('/account/settings',[UserController::class,'information']);
Route::get('/account/settings.php',[UserController::class,'updateInformation']);
Route::post('/account/settings.php',[UserController::class,'updateInformation']);

Route::get('/account/changeInfo',[UserController::class,'information']);
Route::post('/account/changeInfo',[UserController::class,'updateInformation']);

Auth::routes();

Route::get('company/home', [HomeController::class, 'companyHome'])->name('company.home')->middleware('isCompany');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::get('/homeCompany', [HomeController::class, 'companyHome'])->middleware('isCompany')->name('homeCompany');

Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout'); //logout route

Route::get('/form',[CompanyController::class,'create'])->middleware('isCompany')->name('form');
Route::post('/form', [CompanyController::class,'store'])->middleware('isCompany');
Route::delete('/formEditRemoveCompany/{id}',[CompanyController::class,'removeJob'])->middleware('isCompany')->name('job.removeCompany'); //passar id para saber qual remover
Route::get('/formEditRemoveCompany',[CompanyController::class,'listJobs'])->name('formEditRemoveCompany');
Route::put('/formEditRemoveCompany/{id}',[CompanyController::class,'editJobs'])->middleware('isCompany')->name('job.editCompany');


Route::get('/formAdmin',[AdminController::class,'showJobs'])->middleware('isAdmin')->name('formAdmin');
Route::put('/formAdmin/{id}',[AdminController::class,'rejectJob'])->middleware('isAdmin')->name('job.rejectJob');
Route::delete('/removeJobAdmin/{id}',[AdminController::class,'removeJob'])->middleware('isAdmin')->name('job.remove'); //passar ir para saber qual remover
Route::get('/removeJobAdmin',[AdminController::class,'listJobs'])->middleware('isAdmin')->name('removeJobAdmin');

Route::get('/{job}', [JobController::class, 'show'])
    ->name('showJob');

Route::get('/{job}/apply', [JobController::class, 'apply'])
    ->name('applyJob');



