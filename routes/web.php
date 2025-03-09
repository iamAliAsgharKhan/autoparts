<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{id}', [HomeController::class, 'show'])->name('product.show');
Route::get('/search', [HomeController::class, 'search'])->name('product.search');
Route::get('/search-parts', [HomeController::class, 'showFilterForm'])->name('parts.filter.form');
Route::get('/parts/filter', [HomeController::class, 'filter'])->name('parts.filter');
Route::get('/api/models', [HomeController::class, 'apimodel'])->name('api.models');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::resource('parts', PartController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('admin/parts/new', [PartController::class, 'create'])->name('admin.parts.create');
    Route::get('admin/parts/all', [PartController::class, 'index'])->name('admin.parts.index');
    Route::get('admin/parts/{part}/edit', [PartController::class, 'edit'])->name('admin.parts.edit');
    Route::put('admin/parts/{part}', [PartController::class, 'update'])->name('admin.parts.update');
    Route::delete('admin/parts/{part}', [PartController::class, 'destroy'])->name('admin.parts.destroy');
    Route::get('admin/parts/{part}', [PartController::class, 'show'])->name('admin.parts.show');
});

Auth::routes();







// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


