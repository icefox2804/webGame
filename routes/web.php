<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.show');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/buy-now/{id}', [CartController::class, 'buyNow'])->name('cart.buyNow');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');
Route::get('/order/success', [CartController::class, 'success'])->name('cart.success');

// Product Routes
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');

// Register & Login Routes
Route::get('/register', [RegisterController::class, 'showRegister'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.post');
Route::get('/login', [LoginController::class, 'showLogin'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

// Admin Login Routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Routes (Protected by auth middleware)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Trash Dashboard
    Route::get('/trash', [TrashController::class, 'index'])->name('admin.trash.index');
    
    // Category Routes
    Route::resource('categories', AdminCategoryController::class);
    Route::get('categories-trash', [AdminCategoryController::class, 'trash'])->name('admin.categories.trash');
    Route::post('categories/{id}/restore', [AdminCategoryController::class, 'restore'])->name('admin.categories.restore');
    Route::delete('categories/{id}/force-delete', [AdminCategoryController::class, 'forceDelete'])->name('admin.categories.forceDelete');
    
    // Product Routes
    Route::resource('products', AdminProductController::class)->names([
        'index' => 'admin.products.index',
        'show' => 'admin.products.show',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    Route::get('products-trash', [AdminProductController::class, 'trash'])->name('admin.products.trash');
    Route::post('products/{id}/restore', [AdminProductController::class, 'restore'])->name('admin.products.restore');
    Route::delete('products/{id}/force-delete', [AdminProductController::class, 'forceDelete'])->name('admin.products.forceDelete');
    
    // Contact Routes
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
    Route::get('contacts-trash', [AdminContactController::class, 'trash'])->name('admin.contacts.trash');
    Route::post('contacts/{id}/restore', [AdminContactController::class, 'restore'])->name('admin.contacts.restore');
    Route::delete('contacts/{id}/force-delete', [AdminContactController::class, 'forceDelete'])->name('admin.contacts.forceDelete');
    
    // Setting Routes
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');
});

