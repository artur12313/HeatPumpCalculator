<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FuelController;
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
Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

Route::get('/report-new', [ReportController::class, 'index'])->name('report-new');

Route::get('/fuels', [FuelController::class, 'index'])->name('fuels');
Route::get('/fuels/new', [FuelController::class, 'create'])->name('fuels-new');
Route::post('/fuels', [FuelController::class, 'store']);
Route::get('/fuels/edit/{id}', [FuelController::class, 'edit']);
});
