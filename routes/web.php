<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produkController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\statusEdit_Controller;
use App\Http\Controllers\ArtikelController;

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

Route::get('/', function(){
    return redirect()->route('dashboard');
});
Route::get('dashboard', [produkController::class, 'index'])->name('dashboard');

Route::get('/login', [AkunController::class, 'login'])->name('loginShow');
Route::post('/login', [AkunController::class, 'loginInput'])->name('login.store');

Route::get('/signup', [AkunController::class, 'signup'])->name('signupShow');
Route::post('/signup', [AkunController::class, 'signupInput'])->name('signup.store');

Route::get('/logout', [AkunController::class, 'logout'])->name('logout');

Route::get('/profile', [AkunController::class, 'showProfile'])->name('profile');
Route::put('/profile/{id}', [AkunController::class, 'updateProfie'])->name('profile.update');

Route::get('/myarticle', [produkController::class, 'myarticle'])->name('myarticle');
Route::get('/{id_penulis}', [ArtikelController::class, 'showbyPenulis'])->name('article.penulis');
Route::group(['prefix' => 'article'], function()
{
    Route::get('/{id_article}', [ArtikelController::class, 'show'])->name('article');

    Route::resource('upload', ArtikelController::class);
    Route::group(['prefix' => 'upload'], function() {
        Route::resource('re-upload', ArtikelController::class);
    });
});
Route::get('/status/{level_status}', [statusEdit_Controller::class, 'index'])->name('status.index');
