<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/my_roles', 'ExamplesController@show_my_roles')->middleware('auth');


Route::resource('/post', 'PostsController');


Route::get('/redis', function () {
    $users = Cache::remember('users', $minutes = 2, function () {
        return DB::table('users')->get();
    });

    dd($users);
});
