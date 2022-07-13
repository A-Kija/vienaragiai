<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController as A;
use App\Http\Controllers\SumaController as S;
use App\Http\Controllers\ColorController as C;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/bebras', fn() => 'Valio, bebrams');

// Route::get('/barsukas', [A::class, 'barsukas']);

// Route::get('/briedis/{id}', [A::class, 'briedis']);

// Route::get('/suma/{s1?}/{s2?}', [S::class, 'suma']);

Route::get('/skirtumas', [S::class, 'skirtumas'])->name('forma');
Route::post('/skirtumas', [S::class, 'skaiciuoti'])->name('skaiciuokle');

//Colors
Route::get('/colors', [C::class, 'index'])->name('colors-index');
Route::get('/colors/create', [C::class, 'create'])->name('colors-create');
Route::post('/colors', [C::class, 'store'])->name('colors-store');
Route::get('/colors/edit/{color}', [C::class, 'edit'])->name('colors-edit');
Route::put('/colors/{color}', [C::class, 'update'])->name('colors-update');
Route::delete('/colors/{color}', [C::class, 'destroy'])->name('colors-delete');
Route::get('/colors/show/{id}', [C::class, 'show'])->name('colors-show');

//Animals
Route::get('/animals', [A::class, 'index'])->name('animals-index');
Route::get('/animals/create', [A::class, 'create'])->name('animals-create');
Route::post('/animals', [A::class, 'store'])->name('animals-store');
Route::get('/animals/edit/{animal}', [A::class, 'edit'])->name('animals-edit');
Route::put('/animals/{animal}', [A::class, 'update'])->name('animals-update');
Route::delete('/animals/{animal}', [A::class, 'destroy'])->name('animals-delete');
Route::get('/animals/show/{id}', [A::class, 'show'])->name('animals-show');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
