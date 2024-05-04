<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;

Auth::routes();
Route::get('/', [ProductController::class, 'home'])->name('products.home');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');


Route::group(['middleware' => ['auth']], function () {
	Route::get('/home', [HomeController::class, 'index'])->name('home');

	// Users
	Route::group(['prefix' => 'users', 'middleware' => ['role:admin'], 'controller' => UserController::class], function () {
		Route::get('/', 'index')->name('users.index')->middleware('can:users.index');
		Route::get('/create', 'create')->name('users.create')->middleware('can:users.create');
		Route::post('/', 'store')->name('users.store')->middleware('can:users.store');
		Route::get('/{user}/edit', 'edit')->name('users.edit')->middleware('can:users.edit');
		Route::put('/{user}', 'update')->name('users.update')->middleware('can:users.update');
		Route::delete('/{user}', 'destroy')->name('users.destroy')->middleware('can:users.destroy');
	});


	// Products
	Route::group(['prefix' => 'products', 'controller' => ProductController::class], function () {
		Route::get('/', 'index')->name('products.index')->middleware('can:products.index');
		Route::get('/show/{product}', 'show')->name('products.show')->middleware('can:products.show');
		Route::get('/product/{idproduct}', 'productoSeleccionado')->name('products.productoSeleccionado');

		Route::post('/store', 'store')->name('products.store')->middleware('can:products.store');
		Route::post('/update/{product}', 'update')->name('products.update')->middleware('can:products.update');
		Route::delete('/{product}', 'destroy')->name('products.destroy')->middleware('can:products.destroy');
	});


	// Category
	Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {
		Route::get('/', 'index')->name('categories.index')->middleware('can:categories.index');
		Route::get('/get-all', 'getCategory')->name('categories.get-all')->middleware('can:categories.get-all');
		Route::get('/get-all-dt', 'getAll')->name('categories.get-all-dt');

		Route::get('/show/{category}', 'show')->name('categories.show');

		Route::post('/store', 'store')->name('categories.store')->middleware('can:categories.store');

		Route::post('/update/{category}', 'update')->name('categories.update')->middleware('can:categories.update');

		Route::delete('/{category}', 'destroy')->name('categories.destroy')->middleware('can:categories.destroy');
	});

	//Cart shop
	Route::group(['prefix' => 'cart', 'controller' => CartController::class], function () {
		Route::post('cart/add', 'add')->name('add');
		Route::get('cart/checkout', 'checkout')->name('checkout');
		Route::get('cart/clear', 'clear')->name('clear');
		Route::post('cart/removeitem', 'removeItem')->name('removeitem');
	});
});
Route::get('/products/{nameCategory}', [ProductController::class, 'productosPorCategoria'])->name('products.productosPorCategoria');
