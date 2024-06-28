<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Authorization\LoginController;
use App\Http\Controllers\FasilitasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TipeProdukController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UsersController;

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

Route::get('/', [HotelController::class, 'index']);
Route::get('/tampil-produk/{id}', [ProductController::class, 'tampilProduk']);

Route::resource('hotel', HotelController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('tipe', TypeController::class);

Route::middleware(['auth'])->group(function () {
    Route::resource('hotel', HotelController::class);
    Route::resource('transaction', TransactionController::class);
    Route::resource('tipe', TypeController::class);
    Route::get('/', [HotelController::class, 'index']);
});

Auth::routes();

Route::group(["middleware" => ["auth-login"]], function () {
    Route::get("/dashboard", [AppController::class, "dashboard"]);
    Route::resource("tipe-produk", TipeProdukController::class);
    Route::resource("produk", ProdukController::class);
    Route::resource("fasilitas", FasilitasController::class);
    Route::resource("users", UsersController::class);
});

Route::group(["middleware" => ["guest"]], function () {
    Route::prefix("authorization")->group(function () {
        Route::prefix("login")->group(function () {
            Route::get("/", [LoginController::class, "login"]);
            Route::post("/", [LoginController::class, "postLogin"]);
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
