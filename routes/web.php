<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\PumpController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
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

Route::resource('reports', ReportController::class)->only([
    'index'
]);
Route::get('/reports/pdf', [ReportController::class, 'createPDF'])->name('report.createPDF');
Route::resource('calculator', CalculatorController::class)->only([
    'index'
]);
Route::get('/calculator/calc', [CalculatorController::class, 'createPDF'])->name('calculator.createPDF');

Route::resource('fuels', FuelController::class)->only([
    'index', 'create', 'store', 'update', 'destroy', 'edit'
]);

Route::resource('modules', ModuleController::class);
Route::resource('pump', PumpController::class);


Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/create', [UsersController::class, 'create'])->name('users.create');
Route::post('/create', [UsersController::class, 'store'])->name('users.store');
Route::get('/{user}/show', [UsersController::class, 'show'])->name('users.show');
Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::patch('/{user}/update', [UsersController::class, 'update'])->name('users.update');
Route::delete('/{user}/delete', [UsersController::class, 'destroy'])->name('users.destroy');

Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);

// Route::get('/fuels', [FuelController::class, 'index']);
// Route::get('/fuels/new', [FuelController::class, 'create']);
// Route::post('/fuels', [FuelController::class, 'store']);
// Route::get('/fuels/{id}/edit', [FuelController::class, 'edit']);
// Route::put('/fuels/{id}', [FuelController::class, 'update']);
// Route::delete('/fuels/{id}', [FuelController::class, 'destroy']);
});
