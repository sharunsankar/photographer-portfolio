<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ImageController;

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
Route::fallback(function () {
    return '404';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/albums/{id}/add-image', [App\Http\Controllers\AlbumController::class, 'addImage'])->name('albums.addImage');
Route::post('/albums/store-image/{id}', [App\Http\Controllers\AlbumController::class, 'storeImage'])->name('albums.storeImage');
Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'categories' => CategoryController::class,
    'albums' => AlbumController::class,
    'images' => ImageController::class,
]);
