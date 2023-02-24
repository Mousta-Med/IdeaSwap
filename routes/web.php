<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;

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

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/test', [HomeController::class, 'test']);

Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostsController::class, 'index']);
    Route::get('/add-post', [PostsController::class, 'addpost']);
    Route::post('/save-post', [PostsController::class, 'savepost']);
    Route::get('/delete-post/{id}', [PostsController::class, 'deletepost']);
    Route::get('/update-post/{id}', [PostsController::class, 'updatepost']);
    Route::post('/edite-post', [PostsController::class, 'editepost']);
});
