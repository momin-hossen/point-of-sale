<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UnitController;
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
Route::get('/', [FrontendController::class, 'welcome'])->name('welcome');

// ProfileController
Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// UnitController
Route::resource('units', UnitController::class);

// CategoryController
Route::resource('categories', CategoryController::class);

// expense_categories
Route::resource('expense_categories', ExpenseCategoryController::class);

// expenses
Route::resource('expenses', ExpenseController::class);

// ProductController
Route::resource('products', ProductController::class);

// PurchaseController
Route::resource('purchases', PurchaseController::class);