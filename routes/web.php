<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/filter', [ProductController::class, 'filter'])->name('filter');
Route::get('/live-search', [ProductController::class, 'liveSearch'])->name('liveSearch');

Route::get('/about', function () {
    return view('about.index');
})->name('about.index');
Route::get('/contact', function () {
    return view('contact.index');
})->name('contact.index');

Route::middleware(['auth', 'capre'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/confirmChanges', [CartController::class, 'confirmChanges'])->name('cart.confirmChanges');

    Route::get('/history/{id}', [HistoryController::class, 'index'])->name('history.index');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::middleware(['auth', 'admin', 'capre'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/get-chart-data', [AdminController::class, 'getChartData'])->name('admin.getChartData');

    Route::get('/admin/products/v2', [AdminController::class, 'products_v2'])->name('admin.products.products');
    Route::get('/admin/products/table', [AdminController::class, 'productTable'])->name('admin.products.table');
    Route::get('/admin/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/admin/products/create', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/admin/products/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');

    Route::get('/admin/products/add/v2', [AdminController::class, 'createProduct'])->name('admin.products.add');
    Route::post('/admin/products/add/save', [AdminController::class, 'storeProduct_v2']);

    Route::get('/admin-dashboard/get-recent-orders', [AdminController::class, 'getRecentOrders'])->name('admin.getRecentOrders');

    Route::get('/admin/orders/update/{id}', [AdminController::class, 'showOrders'])->name('admin.orders.update');
    Route::post('/admin/orders/update/save/{id}', [AdminController::class, 'updateOrders'])->name('admin.orders.update');

    Route::get('/admin/products/edit/v2/{id}', [AdminController::class, 'editProduct_v2'])->name('admin.products.edit');
    Route::get('/admin/products/edit/stock/v2/{id}', [AdminController::class, 'editStock'])->name('admin.products.add_stock');
    Route::post('/admin/products/edit/stock/save/v2/{id}', [AdminController::class, 'updateStock'])->name('admin.products.update_stock');
    Route::get('/admin/products/delete/stock/v2/{id}', [AdminController::class, 'showStock'])->name('admin.products.delete_stock');
    Route::get('/admin/products/delete/stock/v2/{id}/{ret}', [AdminController::class, 'deleteStock']);
    Route::post('/admin/products/update/v2/{id}', [AdminController::class, 'updateProduct_v2'])->name('admin.products.update');

    Route::delete('/admin/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/table', [AdminController::class, 'userTable'])->name('admin.users.table');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users/create', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/edit/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});


require __DIR__ . '/auth.php';
