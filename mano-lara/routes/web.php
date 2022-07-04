<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController as A;
use App\Http\Controllers\SumaController as S;

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

Route::get('/barsukas', [A::class, 'barsukas']);

Route::get('/briedis/{id}', [A::class, 'briedis']);

Route::get('/suma/{s1?}/{s2?}', [S::class, 'suma']);
