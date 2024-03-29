<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController as A;
use App\Http\Controllers\SumaController as S;
use App\Http\Controllers\ColorController as C;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;
use App\Http\Controllers\CartController as Cart;
use App\Http\Controllers\MasterController as M;

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

Route::get('/welcome', function () {
    return view('welcome');
});


//Front
Route::get('', [F::class, 'index'])->name('front-index');

Route::post('add-animal-to-order', [O::class, 'add'])->name('front-add');
Route::get('my-orders', [O::class, 'showMyOrders'])->name('my-orders');

Route::post('add-animal-to-cart', [Cart::class, 'add'])->name('front-add-cart');

Route::get('my-small-cart', [Cart::class, 'showSmallCart'])->name('my-small-cart');

Route::delete('my-small-cart', [Cart::class, 'deleteSmallCart'])->name('my-small-cart');



//Colors
Route::prefix('colors')->name('colors-')->group(function () {
    Route::get('', [C::class, 'index'])->name('index')->middleware('rp:user');
    Route::get('create', [C::class, 'create'])->name('create')->middleware('rp:admin');
    Route::post('', [C::class, 'store'])->name('store')->middleware('rp:admin');
    Route::get('edit/{color}', [C::class, 'edit'])->name('edit')->middleware('rp:admin');
    Route::put('{color}', [C::class, 'update'])->name('update')->middleware('rp:admin');
    Route::delete('{color}', [C::class, 'destroy'])->name('delete')->middleware('rp:admin');
    Route::get('show/{id}', [C::class, 'show'])->name('show')->middleware('rp:user');
    Route::get('show', [C::class, 'link'])->name('show-route');
});

//Orders
Route::prefix('orders')->name('orders-')->group(function () {
    Route::get('', [O::class, 'index'])->name('index')->middleware('rp:admin');
    Route::put('status/{order}', [O::class, 'setStatus'])->name('status')->middleware('rp:admin');
    Route::get('/pdf/{order}', [O::class, 'getPdf'])->name('pdf')->middleware('rp:admin');
});


//Animals
Route::get('/animals', [A::class, 'index'])->name('animals-index');
Route::get('/animals/create', [A::class, 'create'])->name('animals-create');
Route::post('/animals', [A::class, 'store'])->name('animals-store');
Route::get('/animals/edit/{animal}', [A::class, 'edit'])->name('animals-edit');
Route::put('/animals/{animal}', [A::class, 'update'])->name('animals-update');
Route::delete('/animals/{animal}', [A::class, 'destroy'])->name('animals-delete');
Route::get('/animals/show/{id}', [A::class, 'show'])->name('animals-show');
Route::put('/animals/delete-picture/{animal}', [A::class, 'deletePicture'])->name('animals-delete-picture');

//Masters
Route::prefix('masters')->name('masters-')->group(function () {
    Route::get('', [M::class, 'index'])->name('index')->middleware('rp:admin');
    Route::get('edit/{master}', [M::class, 'edit'])->name('edit')->middleware('rp:admin');
    Route::put('{master}', [M::class, 'update'])->name('update')->middleware('rp:admin');
    Route::delete('{master}', [M::class, 'destroy'])->name('delete')->middleware('rp:admin');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
