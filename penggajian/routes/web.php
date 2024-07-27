<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NonTaxableIncomeController;
use App\Http\Controllers\TaxableIncomeRateController;
use App\Http\Controllers\IncomeTaxController;
use App\Http\Controllers\TaxCategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Models\TaxableIncomeRate;
use App\Models\TaxCategory;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', function () {
    return view('layouts/main',["title" => "", "tableid" =>""]);
});


// Middleware auth untuk membatasi akses
Route::middleware(['auth'])->group(function () {
    Route::get('/home', function() {
        return view('home');
    })->name('home');

    //Employee Controller
Route::get('/employee', [EmployeeController::class, 'index']);
Route::get('/employee_getNonTaxableIncomes', [EmployeeController::class, 'getNonTaxableIncomes']);
Route::get('/employee_getEmployee', [EmployeeController::class, 'getEmployee']);
Route::get('/employee_resign', [EmployeeController::class, 'resign']);
Route::get('/employee_destroy', [EmployeeController::class, 'destroy']);
Route::post('/employee_update', [EmployeeController::class, 'updateEmployee']);
Route::post('/employee_store', [EmployeeController::class, 'storeEmployee']);


// NonTaxableIncome Controller
Route::get('/nti', [NonTaxableIncomeController::class, 'index']);
Route::post('/nti_store', [NonTaxableIncomeController::class, 'storeNonTaxableIncome']);
Route::get('/nti_destroy', [NonTaxableIncomeController::class, 'destroy']);
Route::get('/nti_getNti', [NonTaxableIncomeController::class, 'getNti']);
Route::post('/nti_update', [NonTaxableIncomeController::class, 'updateNti']);

// TaxableIncomeRate Controller
Route::get('/tir', [TaxableIncomeRateController::class, 'index']);
Route::post('/tir_store', [TaxableIncomeRateController::class, 'storeTaxableIncomeRate']);
Route::get('/tir_destroy', [TaxableIncomeRateController::class, 'destroy']);
Route::get('/tir_getTir', [TaxableIncomeRateController::class, 'getTir']);
Route::post('/tir_update', [TaxableIncomeRateController::class, 'updateTir']);

// TaxCategory Controller
Route::get('/tc', [TaxCategoryController::class, 'index']);
Route::post('/tc_store', [TaxCategoryController::class, 'storeTaxCategory']);
Route::get('/tc_destroy', [TaxCategoryController::class, 'destroy']);
Route::get('/tc_getTc', [TaxCategoryController::class, 'getTc']);
Route::post('/tc_update', [TaxCategoryController::class, 'updateTc']);


// IncomeTax Controller
Route::get('/incometax', [IncomeTaxController::class, 'index']);
Route::post('/incometax_view', [IncomeTaxController::class, 'view']);
Route::get('/viewlist', [IncomeTaxController::class, 'viewlist'])->name('viewlist');;

Route::get('/settax', [IncomeTaxController::class, 'setTax']);
Route::get('/setlasttax', [IncomeTaxController::class, 'setLastPeriodTax']);
Route::get('/incometax_getemployee', [IncomeTaxController::class, 'getEmployee']);
Route::post('/gettaxrate', [IncomeTaxController::class, 'getTaxRate']);
Route::post('/storeincometax', [IncomeTaxController::class, 'store']);
Route::post('/storelastincometax', [IncomeTaxController::class, 'storeLastTax']);
Route::get('/incometax_destroy', [IncomeTaxController::class, 'destroy']);

Route::get('/slip', [IncomeTaxController::class, 'openslip']);
Route::post('/incometax_slipview', [IncomeTaxController::class, 'viewslip']);
Route::get('/viewlistslip', [IncomeTaxController::class, 'viewlistslip'])->name('viewlistslip');;
Route::get('/incometax_printslip/{a}/{b}/{c}', [IncomeTaxController::class, 'printSlip']);

});