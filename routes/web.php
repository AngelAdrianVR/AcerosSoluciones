<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//---------------- Landing Inicio -----------------------
// Route::get('/', function () {
//     return Inertia::render('Landing/Inicio', [
//         // 'canLogin' => Route::has('login'),
//         // 'canRegister' => Route::has('register'),
//         // 'laravelVersion' => Application::VERSION,
//         // 'phpVersion' => PHP_VERSION,
//     ]);
// })->name('home');


// //---------------- Landing Servicios -----------------------
// Route::get('/services', function () {
//     return Inertia::render('Landing/Servicios', [
//         // 'canLogin' => Route::has('login'),
//         // 'canRegister' => Route::has('register'),
//         // 'laravelVersion' => Application::VERSION,
//         // 'phpVersion' => PHP_VERSION,
//     ]);
// })->name('services');


//renderiza el dashboard cuando se loguea
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


//redirecciona del dashboard a productos. comentar cuando la pagina tenga dashboard
// Route::redirect('/dashboard', 'products');


//rutas de landing
Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('productos', [LandingController::class, 'products'])->name('landing.products');
Route::get('productos/{product}', [LandingController::class, 'show'])->name('landing.show');


//Product routes -------------------------------------------------------
// ---------------------------------------------------------------------
Route::resource('products', ProductController::class);
Route::get('products-get-popular', [ProductController::class, 'getPopular'])->name('products.get-popular');
Route::post('products/update-with-media/{product}', [ProductController::class, 'updateWithMedia'])->name('products.update-with-media');
Route::post('products/get-matches', [ProductController::class, 'getMatches'])->name('products.get-matches');


//category routes ------------------------------------------------------
// ---------------------------------------------------------------------
Route::resource('categories', CategoryController::class);
Route::post('categories/massive-delete', [CategoryController::class, 'massiveDelete'])->name('categories.massive-delete');
Route::get('categories-get-all', [CategoryController::class, 'getAll'])->name('categories.get-all');
