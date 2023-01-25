<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produkController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\statusEdit_Controller;

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

Route::get('dashboard', [produkController::class, 'index'])->name('dashboard');
// Route::resource('login', AkunController::class);
    Route::get('/login', [AkunController::class, 'login'])->name('loginShow');
    Route::post('/login', [AkunController::class, 'loginInput'])->name('login.store');

    Route::get('/signup', [AkunController::class, 'signup'])->name('signupShow');
    Route::post('/signup', [AkunController::class, 'signupInput'])->name('signup.store');

    Route::get('/logout', [AkunController::class, 'logout'])->name('logout');

Route::resource('/article', produkController::class);
Route::resource('/profile', produkController::class);
Route::resource('/myarticle', produkController::class);
Route::get('/upload/{id_akun}', 'App\Http\Controllers\uploadArtikel_Controller@index')->name('upload');
Route::resource('status', statusEdit_Controller::class);
