<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MstCustomerController;
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
    Route::post('users', [MstUsersController::class, 'store'])->name('user.create');
    Route::post('users/update/{id}', [MstUsersController::class, 'update'])->name('user.update');
    Route::delete('users/{id}', [MstUsersController::class, 'destroy'])->name('user.delete');
    
    // Customers route
    Route::get('customers', [MstCustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/getData', [MstCustomerController::class, 'getCustomerData'])->name('customers.getData');
    Route::get('customers/info/{id}', [MstCustomerController::class, 'getCustomerByID']);
    Route::post('customers', [MstCustomerController::class, 'store'])->name('customers.store'); 
    Route::post('customers/update/{id}', [MstCustomerController::class, 'update'])->name('customers.update'); 
    Route::get('customers/export', [MstCustomerController::class, 'export'])->name('customers.export'); 
    Route::post('customers/import', [MstCustomerController::class, 'import'])->name('customers.import');

    // Product
     Route::get('products', [MstProductController::class, 'index'])->name('products');
    // Route::get('products/details/{id}', [MstProductController::class, 'show'])->name('products.show'); 
    // Route::post('products', [MstProductController::class, 'store'])->name('products.store'); 
    // Route::post('products/update/{id}', [MstProductController::class, 'update'])->name('products.update'); 

    Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');

});
