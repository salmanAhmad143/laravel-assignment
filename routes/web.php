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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index'])->name('authors');
Route::get('/author/detail/{id}', [App\Http\Controllers\AuthorController::class, 'detail'])->name('author.detail');
Route::get('/author/delete/{id}', [App\Http\Controllers\AuthorController::class, 'delete'])->name('author.delete');
Route::get('/book/delete/{id}', [App\Http\Controllers\BookController::class, 'delete'])->name('book.delete');
Route::get('/book/create', [App\Http\Controllers\BookController::class, 'create'])->name('book.create');
Route::post('/book/store', [App\Http\Controllers\BookController::class, 'store'])->name('book.store');

