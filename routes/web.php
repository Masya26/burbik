<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
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

use Illuminate\Support\Facades\Artisan;

Route::get('generate', function () {
    Artisan::call('storage:link');
    echo 'ok';
});

// вставить перед этим роутом
Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/korzina', function () {
    return view('korzina');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Для пользователя
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Для категорий
Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.category.show');
    Route::patch('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/', [ProductsController::class, 'admin'])->name('products.admin');
    Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/', [ProductsController::class, 'store'])->name('products.store');
    Route::post('/{product}/add-to-cart', [ProductsController::class, 'addToCart'])->name('products.addToCart');
    Route::get('/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
    Route::get('/{product}', [ProductsController::class, 'show'])->name('products.show');
    Route::patch('/{product}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');
});
// Для продуктов

Route::get('/', [ProductsController::class, 'index'])->name('index.welcome');

// Для корзины
Route::get('/korzina', [OrderController::class, 'showKorzina'])->name('korzina.show');
Route::delete('/korzina/{product}', [OrderController::class, 'removeFromKorzina'])->name('korzina.remove');
Route::patch('/korzina/{product}', [OrderController::class, 'updateQuantityInKorzina'])->name('korzina.updateQuantity');
Route::patch('/korzina/{product}/decrease', [OrderController::class,'decreaseQuantityInKorzina'])->name('korzina.decrease');
Route::patch('/korzina/{product}/increase', [OrderController::class,'increaseQuantityInKorzina'])->name('korzina.increase');

Route::get('/admin', Admincontroller::class)->name('admin.index');

require __DIR__ . '/auth.php';
