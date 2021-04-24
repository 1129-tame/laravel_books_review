<?php

use Illuminate\Support\Facades\App;
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
Route::get('/', [\App\Http\Controllers\ReviewController::class, 'index'])->name('index');

Auth::routes();

Route::get('/show/{id}', [\App\Http\Controllers\ReviewController::class, 'show'])->name('show');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/review', [\App\Http\Controllers\ReviewController::class, 'create'])->name('create'); //ルートに名前をつけている

    Route::post('/review/store', [\App\Http\Controllers\ReviewController::class, 'store'])->name('store');

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


