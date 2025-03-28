<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MakeController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\YearController;
use App\Http\Controllers\SocialLinkController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [HomeController::class, 'products']);
Route::get('/products/{id}', [HomeController::class, 'show'])->name('product.show');
Route::get('/search', [HomeController::class, 'search'])->name('product.search');
Route::get('/search-parts', [HomeController::class, 'showFilterForm'])->name('parts.filter.form');
Route::get('/parts/filter', [HomeController::class, 'filter'])->name('parts.filter');
Route::get('/api/models', [HomeController::class, 'apimodel'])->name('api.models');
Route::get('/api/years', [HomeController::class, 'apiyears'])->name('api.years');
Route::get('/categories/{slug}', [CategoryController::class, 'publicshow'])->name('categories.show');




Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    
    Route::get('admin/parts/new', [PartController::class, 'create'])->name('admin.parts.create');
    Route::get('admin/parts/all', [PartController::class, 'index'])->name('admin.parts.index');
    Route::get('admin/parts/{part}/edit', [PartController::class, 'edit'])->name('admin.parts.edit');
    Route::put('admin/parts/{part}', [PartController::class, 'update'])->name('admin.parts.update');
    Route::delete('admin/parts/{part}', [PartController::class, 'destroy'])->name('admin.parts.destroy');
    Route::get('admin/parts/{part}', [PartController::class, 'show'])->name('admin.parts.show');
    Route::post('/admin/parts/store', [PartController::class, 'store'])->name('admin.parts.store');



    Route::get('admin/categories/all', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('admin/categories/new', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('admin/categories/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    
    // Make Routes (New) - Using explicit routes like the others
    Route::get('admin/makes/all', [MakeController::class, 'index'])->name('admin.makes.index');
    Route::get('admin/makes/new', [MakeController::class, 'create'])->name('admin.makes.create');
    Route::post('admin/makes/store', [MakeController::class, 'store'])->name('admin.makes.store');
    Route::get('admin/makes/{make}', [MakeController::class, 'show'])->name('admin.makes.show'); // Added show route
    Route::get('admin/makes/{make}/edit', [MakeController::class, 'edit'])->name('admin.makes.edit');
    Route::put('admin/makes/{make}', [MakeController::class, 'update'])->name('admin.makes.update');
    Route::delete('admin/makes/{make}', [MakeController::class, 'destroy'])->name('admin.makes.destroy');

    
    Route::get('admin/car-models/all', [CarModelController::class, 'index'])->name('admin.car_models.index');
    Route::get('admin/car-models/new', [CarModelController::class, 'create'])->name('admin.car_models.create');
    Route::post('admin/car-models/store', [CarModelController::class, 'store'])->name('admin.car_models.store');
    Route::get('admin/car-models/{car_model}', [CarModelController::class, 'show'])->name('admin.car_models.show'); // Added show route
    Route::get('admin/car-models/{car_model}/edit', [CarModelController::class, 'edit'])->name('admin.car_models.edit');
    Route::put('admin/car-models/{car_model}', [CarModelController::class, 'update'])->name('admin.car_models.update');
    Route::delete('admin/car-models/{car_model}', [CarModelController::class, 'destroy'])->name('admin.car_models.destroy');

    Route::get('admin/years/all', [YearController::class, 'index'])->name('admin.years.index');
    Route::get('admin/years/new', [YearController::class, 'create'])->name('admin.years.create');
    Route::post('admin/years/store', [YearController::class, 'store'])->name('admin.years.store');
    Route::get('admin/years/{year}', [YearController::class, 'show'])->name('admin.years.show');
    Route::get('admin/years/{year}/edit', [YearController::class, 'edit'])->name('admin.years.edit');
    Route::put('admin/years/{year}', [YearController::class, 'update'])->name('admin.years.update');
    Route::delete('admin/years/{year}', [YearController::class, 'destroy'])->name('admin.years.destroy');


    Route::get('admin/social-links/all', [SocialLinkController::class, 'index'])->name('admin.social_links.index');
    Route::get('admin/social-links/new', [SocialLinkController::class, 'create'])->name('admin.social_links.create');
    Route::post('admin/social-links/store', [SocialLinkController::class, 'store'])->name('admin.social_links.store');
    Route::get('admin/social-links/{social_link}', [SocialLinkController::class, 'show'])->name('admin.social_links.show');
    Route::get('admin/social-links/{social_link}/edit', [SocialLinkController::class, 'edit'])->name('admin.social_links.edit');
    Route::put('admin/social-links/{social_link}', [SocialLinkController::class, 'update'])->name('admin.social_links.update');
    Route::delete('admin/social-links/{social_link}', [SocialLinkController::class, 'destroy'])->name('admin.social_links.destroy');


    // Keep this route in web.php
});

Auth::routes();






// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


