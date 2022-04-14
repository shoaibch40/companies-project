<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
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



Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/employees',[EmployeeController::class, 'index']);
    Route::get('/employee/add',[EmployeeController::class, 'create']);
    Route::post('/employee/save',[EmployeeController::class, 'save'])->name('employee.save');
    Route::get('/employee/edit/{id}',[EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('/employee/update',[EmployeeController::class, 'update'])->name('employee.update');
    Route::post('/employee/delete',[EmployeeController::class, 'delete'])->name('employee.delete');


    Route::get('/companies',[CompanyController::class, 'index']);
    Route::get('/company/add',[CompanyController::class, 'create']);
    Route::post('/company/save',[CompanyController::class, 'save'])->name('company.save');
    Route::get('/company/edit/{id}',[CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/company/update',[CompanyController::class, 'update'])->name('company.update');
    Route::post('/company/delete',[CompanyController::class, 'delete'])->name('company.delete');


    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/test', function () {
//         echo asset('storage/company_logo/default.jpg');
//         echo public_path('storage/company_logo/default.jpg');
//         echo storage_path('app/public/company_logo/default.jpg');
    });
});



