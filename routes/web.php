<?php

use GuzzleHttp\Middleware;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/contacts', [App\Http\Controllers\HomeController::class, 'contacts'])->name('contacts');

//con group e prefix possiamo rimuovere da tutte le route la dicitura /foods all'inizio e lasciare solo
//successiva parte della route; questo rende anche il codice piu pulito e organizzato
Route::group(["prefix" => "foods"], function () {
    Route::get('/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'foodDetails'])->name('food.details');

    //cart
    Route::post('/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'cart'])->name('food.cart');
    Route::get('/cart', [App\Http\Controllers\Foods\FoodsController::class, 'displayCartItems'])->name('food.display.cart');

    //delete from cart
    Route::get('/delete-cart/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'deleteCartItems'])->name('food.delete.cart');

    //checkout
    Route::post('/prepare-checkout', [App\Http\Controllers\Foods\FoodsController::class, 'prepareCheckout'])->name('prepare.checkout');
    Route::get('/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'checkout'])->name('foods.checkout');
    Route::post('/store-checkout', [App\Http\Controllers\Foods\FoodsController::class, 'storeCheckout'])->name('store.checkout');

    //pay with paypal
    Route::get('/pay', [App\Http\Controllers\Foods\FoodsController::class, 'payWithPaypal'])->name('foods.pay');
    Route::get('/success', [App\Http\Controllers\Foods\FoodsController::class, 'success'])->name('foods.success');
    Route::get('/successView', [App\Http\Controllers\Foods\FoodsController::class, 'successView'])->name('foods.success.view');


    //booking tables
    Route::post('/booking', [App\Http\Controllers\Foods\FoodsController::class, 'bookingTables'])->name('foods.booking.table');

    //menu
    Route::get('/menu', [App\Http\Controllers\Foods\FoodsController::class, 'menu'])->name('foods.menu');
});

//users
Route::group(["prefix" => "users"], function () {

    Route::get('/all-bookings', [App\Http\Controllers\Users\UsersController::class, 'getBookings'])->name('users.bookings');
    Route::get('/all-orders', [App\Http\Controllers\Users\UsersController::class, 'getOrders'])->name('users.orders');

    //review
    Route::get('/review', [App\Http\Controllers\Users\UsersController::class, 'review'])->name('users.reviews.form');
    Route::post('/storeReview', [App\Http\Controllers\Users\UsersController::class, 'storeReview'])->name('users.reviews');
});


Route::get('/admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('checkforauth');
Route::post('/admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');

Route::group(["prefix" => "admin", "middleware" => "auth:admin"], function () {
    //Admin
    Route::get('/admin/logout', [App\Http\Controllers\Admins\AdminsController::class, 'logout'])->name('view.logout');
    Route::get('/dashboard', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

    //All admins
    Route::get('/all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])->name('admins.all');

    //create admin
    Route::get('/admins-create', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('admins.create');
    Route::post('/admins-create', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('admins.store');


    //orders
    Route::get('/all-orders', [App\Http\Controllers\Admins\AdminsController::class, 'allOrders'])->name('orders.all');
    Route::get('/edit-orders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editOrders'])->name('orders.edit');
    Route::post('/edit-orders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateOrders'])->name('orders.update');
    Route::get('/delete-orders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteOrder'])->name('orders.delete');

    //bookings
    Route::get('/all-bookings', [App\Http\Controllers\Admins\AdminsController::class, 'allBookings'])->name('bookings.all');
    Route::get('/edit-bookings/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editBooking'])->name('bookings.edit');
    Route::post('/edit-bookings/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBooking'])->name('bookings.update');
    Route::get('/delete-bookings/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteBooking'])->name('bookings.delete');

    //Food items
    Route::get('/all-foods', [App\Http\Controllers\Admins\AdminsController::class, 'allFoods'])->name('foods.all');
    Route::get('/create-foods', [App\Http\Controllers\Admins\AdminsController::class, 'createFood'])->name('create.food');
    Route::post('/create-foods', [App\Http\Controllers\Admins\AdminsController::class, 'storeFood'])->name('store.food');
    Route::get('/delete-food/{id}/{image}',[App\Http\Controllers\Admins\AdminsController::class, 'deleteFood'])->name('food.delete');


});