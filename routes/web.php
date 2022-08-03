<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user/profile/{id}', [App\Http\Controllers\HomeController::class, 'userProfile'])->name('user.profile');
Route::put('user/update/{id}', [App\Http\Controllers\HomeController::class, 'userUpdate'])->name('user.update');
Route::get('/url/exit', [App\Http\Controllers\URLController::class, 'exits'])->name('url.exit');
Route::post('/generate', [App\Http\Controllers\URLController::class, 'generate'])->name('url.generate');
Route::get('url/disable/{id}', [App\Http\Controllers\URLController::class, 'disable'])->name('url.disable');
Route::delete('url/delete/{id}', [App\Http\Controllers\URLController::class, 'destroy'])->name('url.destroy');
Route::get('url/show/{id}', [App\Http\Controllers\URLController::class, 'show'])->name('url.show');
