<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// FrontendController
Route::get('/', [FrontendController::class, 'index'])->name('welcome');

// DashboardController
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
