<?php

use App\Enums\RoleEnum;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CargoCompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\Kahani\HomeController as KahaniHomeController;
use App\Http\Controllers\Kahani\ProductController as KahaniProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::view('/products', 'kahani-apparel.product')->name('products');
// Route::view('/product', 'kahani-apparel.product-view')->name('product');

Route::prefix('/')->name('kahani.')->group(function () {
    Route::get('/', [KahaniHomeController::class, 'index'])->name('home');
    // Route::view('/about', 'kahani-apparel.about')->name('about');
    Route::get('/about', [KahaniHomeController::class, 'about'])->name('about');
    Route::get('/privacy-policy', [KahaniHomeController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('/contact', [KahaniHomeController::class, 'contact'])->name('contact');

    Route::get('/faq', [KahaniHomeController::class, 'faq'])->name('faq');
    Route::get('/shop', [KahaniHomeController::class, 'products'])->name('products');
    Route::get('shop/{category}', [KahaniHomeController::class, 'category'])->name('category');
    Route::get('shop/products/{product}', [KahaniHomeController::class, 'product'])->name('product');
    Route::get('/cart', [KahaniProductController::class, 'cart'])->name('cart');
    Route::get('/checkout', [KahaniProductController::class, 'checkout'])->name('checkout');
    Route::get('/panel', [KahaniHomeController::class, 'panel'])->name('panel')->middleware(['auth', 'role:'.RoleEnum::ADMIN->value.'|'.RoleEnum::CUSTOMER->value]);
});

Route::post('/proceed-to-checkout/{order}', [KahaniProductController::class, 'proceedToCheckout'])->name('proceedToCheckout');

Route::post('/cart', [KahaniProductController::class, 'store_to_cart'])->name('store_to_cart');

Route::delete('/cart/remove/{orderItem}', [KahaniProductController::class, 'remove_from_cart'])->name('remove_from_cart');

Route::post('/cart/add', [KahaniProductController::class, 'add'])->name('cart.add');

Route::post('/apply-coupon', [KahaniProductController::class, 'coupon_apply'])->name('coupon.apply');
Route::post('/remove-coupon', [KahaniProductController::class, 'coupon_remove'])->name('coupon.remove');


// Socialite Routes

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google-callback');
});
// Route::get('product-view2', [KahaniProductController::class, 'productview2']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->middleware(['role:'.RoleEnum::ADMIN->value])->name('admin.')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('colors', ColorController::class);
        Route::resource('products', ProductController::class);
        Route::resource('addresses', AddressController::class);
        Route::resource('cargo-companies', CargoCompanyController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('order-items', OrderItemController::class);
    });
});

require __DIR__.'/auth.php';
