<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\ArticleController::class, 'index'])->name('main_index');

Route::get('/article/{id}', [App\Http\Controllers\ArticleController::class, 'show'])->name('show_article');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin_index');
    Route::get('/create', [App\Http\Controllers\ArticleController::class, 'create'])->name('create_article');
    Route::post('/store', [App\Http\Controllers\ArticleController::class,'store'])->name('store_article');
    Route::get('/edit/{id}', [App\Http\Controllers\ArticleController::class,'edit'])->name('edit_article');
    Route::put('/update/{id}', [App\Http\Controllers\ArticleController::class,'update'])->name('update_article');
    Route::put('/delete', [App\Http\Controllers\ArticleController::class,'destroy'])->name('delete_article');
});





