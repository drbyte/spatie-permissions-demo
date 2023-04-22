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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/testmiddleware', [App\Http\Controllers\HomeController::class, 'testmiddleware'])->name('testmiddleware');

Route::get('/my_roles', [App\Http\Controllers\ExamplesController::class, 'show_my_roles'])->middleware('auth')->name('show');

Route::resource('/post', App\Http\Controllers\PostsController::class);

