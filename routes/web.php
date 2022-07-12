<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\CalculatorController;
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
    // return view('welcome');
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
Route::get('/', function () { return view('dashboard');});

Route::resource('reports', ReportController::class);
Route::resource('calculator', CalculatorController::class);
Route::post('/calculator/calc', [CalculatorController::class, 'createPDF'])->name('calculator.createPDF');

Route::resource('fuels', FuelController::class)->only([
    'index', 'create', 'store', 'update', 'destroy', 'edit'
]);

// Route::get('/fuels', [FuelController::class, 'index']);
// Route::get('/fuels/new', [FuelController::class, 'create']);
// Route::post('/fuels', [FuelController::class, 'store']);
// Route::get('/fuels/{id}/edit', [FuelController::class, 'edit']);
// Route::put('/fuels/{id}', [FuelController::class, 'update']);
// Route::delete('/fuels/{id}', [FuelController::class, 'destroy']);
});
