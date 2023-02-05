<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MstProductController;
use App\Http\Controllers\MstUsersController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('loginUser');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/product', [MstProductController::class, 'index'])->name('product');
    Route::get('/users', [MstUsersController::class, 'index'])->name('userList');
    Route::get('/edit', [MstUsersController::class, 'show'])->name('user.edit');
    Route::post('/delete', [MstUsersController::class, 'destroy'])->name('user.destroy');
    Route::post('/lock', [MstUsersController::class, 'lock'])->name('user.lock');
});
Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');
