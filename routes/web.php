<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AdminOrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\frontend\CartListController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\FrontEndController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\WishListController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\Brand\Index;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontEndController::class,'index'])->name('welcome');
Route::get('/collections',[FrontEndController::class,'categories'])->name('collections');
Route::get('/collections/{category_slug}',[FrontEndController::class,'categoryProduct'])->name('collection.category');
Route::get('/collections/{category_slug?}/{product_slug?}',[FrontEndController::class,'viewProduct'])->name('product.view');
Route::get('/thank-you',[FrontEndController::class,'thankYou'])->name('thank.you');


Route::middleware(['auth'])->group(function() {

    Route::get('/wish-list',[WishListController::class,'index'])->name('wish.list');
    Route::get('/cart-list',[CartListController::class,'index'])->name('cart.list');
    Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
    Route::get('/order',[OrderController::class,'index'])->name('order');
    Route::get('/order-view/{order_id}',[OrderController::class,'orderView'])->name('order.view');
});

Route::get('/new-arrivals',[FrontEndController::class,'newArrivals'])->name('new.arrivals');


Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function() {

    Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');

    Route::controller(CategoryController::class)->group(function () {

        Route::get('/category', 'index')->name('admin.category');
        Route::get('/category/create', 'categoryCreate')->name('category.create');
        Route::post('/category/post', 'categoryPost')->name('post.category');
        Route::get('/category/edit/{category}', 'categoryEdit')->name('category.edit');
        Route::post('/category/update', 'categoryUpdate')->name('category.update');
        Route::delete('/category/delete', 'categoryDelete')->name(' ');
    });

    Route::get('/brands',Index::class)->name('brands');

    Route::controller(ProductController::class)->group(function () {

        Route::get('/product', 'index')->name('admin.product');
        Route::get('/product/create', 'productCreate')->name('product.create');
        Route::post('/product/post', 'productPost')->name('product.post');
        Route::get('/product/edit/{product}', 'productEdit')->name('product.edit');
        Route::put('/product/{product}', 'productUpdate')->name('product.update');
        Route::get('/product/image/delete/{product}', 'productImageDelete')->name('pimage.delete');
        Route::get('/product/delete/{product}', 'productDelete')->name('product.delete');
        Route::post('/colors/product/color/update', 'productColorUpdate')->name('prdclr.update');
        Route::post('/colors/product/color/delete', 'productColorDelete')->name('prdclr.delete');
    });

    Route::controller(ColorController::class)->group(function () {

        Route::get('/colors', 'index')->name('colors');
        Route::get('/colors/create', 'colorCreate')->name('color.create');
        Route::post('/colors/post', 'colorPost')->name('color.post');
        Route::get('/colors/edit/{color}', 'colorEdit')->name('color.edit');
        Route::put('/colors/{color}', 'colorUpdate')->name('color.update');
        Route::get('/colors/delete/{color}', 'colorDelete')->name('color.delete');
    });

    Route::controller(SliderController::class)->group(function () {

        Route::get('/slider','index')->name('admin.slider');
        Route::get('/slider/create','sliderCreate')->name('slider.create');
        Route::post('/slider/post','sliderPost')->name('slider.post');
        Route::get('/slider/edit/{slider}', 'sliderEdit')->name('slider.edit');
        Route::put('/slider/{slider}', 'sliderUpdate')->name('slider.update');
        Route::get('/slider/delete/{slider}', 'sliderDelete')->name('slider.delete');

    });
    Route::controller(AdminOrderController::class)->group(function () {

        Route::get('/orders','index')->name('admin.orders');
        Route::get('/order/view/{order_id}','orderView')->name('admin.order.view');
        Route::put('/order/view/{order_id}','updateOrderStatus')->name('admin.order.update');
        Route::get('/invoice/view/{order_id}','viewInvoice')->name('admin.invoice.view');
        Route::get('/invoice/download/{order_id}', 'downloadInvoice')->name('admin.invoice.download');

    });

});

require __DIR__.'/auth.php';
