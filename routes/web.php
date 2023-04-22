<?php

use App\Http\Controllers\RolesAndPermissionsController;
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

// role-assignment screen
Route::group(['prefix' => 'admin', 'middleware' => ['role:Admin|Super-Admin']], function () {
    Route::get('/permissions', [RolesAndPermissionsController::class, 'index'])->name('showAssignedRoles');
    Route::post('/assign_role', [RolesAndPermissionsController::class, 'store'])->name('assignRole');
    Route::delete('/revoke_role', [RolesAndPermissionsController::class, 'destroy'])->name('revokeRole');
});

