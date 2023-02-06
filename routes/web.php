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
    //Route::resource('users', MstUsersController::class);
    Route::get('users/index', [MstUsersController::class, 'index'])->name('user.index');
    Route::get('users/getData', [MstUsersController::class, 'getUsersData'])->name('user.getData');
    Route::get('users/info/{id}', [MstUsersController::class, 'getUserByID']);
    Route::post('users/{id}', [MstUsersController::class, 'lockOrUnlockUser'])->name('user.lock');
    Route::post('users/create', [MstUsersController::class, 'store'])->name('user.create');
    Route::post('users/update/{id}', [MstUsersController::class, 'update'])->name('user.update');
    Route::delete('users/{id}', [MstUsersController::class, 'destroy'])->name('user.delete');
    
    Route::get('users/edit', [MstUsersController::class, 'show'])->name('user.edit');
    //Route::post('users/delete', [MstUsersController::class, 'destroy'])->name('user.destroy');
    

    Route::get('/product', [MstProductController::class, 'index'])->name('product');

    Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');

});
