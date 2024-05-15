<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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



Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/download/{file}', [UserController::class, 'download'])->name('userdownload');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/download/{file}', [AdminController::class, 'download'])->name('download');
    Route::post('/upload', [AdminController::class, 'upload'])->name('upload');
    Route::delete('/file/{file}', [AdminController::class, 'delete'])->name('delete');
});