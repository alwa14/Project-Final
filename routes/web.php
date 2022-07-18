<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TransaksiController;

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

Route::get('/', [PageController::class, 'index']);


Route::post('home', [UserController::class, 'login']);
// Route::post('/home', function () {
//     echo "hello";
//     die;
// });
Route::get('home', [PageController::class, 'index']);


// daftar akun
Route::post('register', [UserController::class, 'register']);
Route::get('register', [UserController::class, 'index']);



// Belanja Semua
Route::post('invoices', [TransaksiController::class, 'allBuy']);
Route::get('invoices', [KeranjangController::class, 'index']);

// input ke Keranjang
Route::post('insertBasket', [PageController::class, 'insertBasket']);
Route::get('insertBasket', [PageController::class, 'index']);

//buka halaman basket
Route::get('basket', [KeranjangController::class, 'index']);
Route::get('basket/{any}', [KeranjangController::class, 'index']);
Route::post('basket/delete', [KeranjangController::class, 'delete']);


// Belanja satu-satu
Route::post('invoice', [TransaksiController::class, 'addBuy']);
Route::get('invoice', [KeranjangController::class, 'index']);


// Logout
Route::get('logout', [UserController::class, 'logout']);




// Profile User Route
Route::get('user/{any}', [UserController::class, 'profile']);


// Update Profile
Route::get('edit', [UserController::class, 'profile']);
Route::post('edit', [UserController::class, 'edit']);


// Change password
Route::get('changePassword', [UserController::class, 'profile']);
Route::post('changePassword', [UserController::class, 'changePassword']);
