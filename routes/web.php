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




Route::get('/login', function () {
    return view('admin.login');
});

Route::post('/login', function (Illuminate\Http\Request $request) {
    return app()->make(\App\Http\Middleware\CheckLogin::class)->handle($request, function ($request) {
        // Logic setelah middleware berhasil
        return redirect()->route('dashboard');
    });
});

Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware(['checklogin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/nas', [AdminController::class, 'nas'])->name('nas');
    Route::get('/download/{file}', [AdminController::class, 'download'])->name('download');
    Route::post('/upload', [AdminController::class, 'upload'])->name('upload');
    Route::delete('/file/{file}', [AdminController::class, 'delete'])->name('delete');
});
