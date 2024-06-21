<?php

use App\Http\Controllers\ActionController;
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

// login
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', function (Illuminate\Http\Request $request) {
    return app()->make(\App\Http\Middleware\CheckLogin::class)->handle($request, function ($request) {
        // Logic setelah middleware berhasil
        return redirect()->route('dashboard');
    });
});
Route::post('/logout', [ActionController::class, 'logout'])->name('logout');

// user
Route::get('/', [ActionController::class, 'index'])->name('index');
Route::get('/userdownload/{file}', [ActionController::class, 'userdownload'])->name('userdownload');

// admin
Route::middleware(['checklogin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [ActionController::class, 'dashboard'])->name('dashboard');
    Route::get('/nas', [ActionController::class, 'nas'])->name('nas');
    Route::get('/download/{file}', [ActionController::class, 'download'])->name('download');
    Route::post('/upload', [ActionController::class, 'upload'])->name('upload');
    Route::delete('/file/{file}', [ActionController::class, 'delete'])->name('delete');
});