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
Route::post('login', [LoginController::class, 'loginUser'])->name('loginUser');
Route::group(['middleware' => ['auth']], function () {
    //Route::resource('users', MstUsersController::class);
    Route::get('users', [MstUsersController::class, 'index'])->name('users');
    Route::get('users/getData', [MstUsersController::class, 'getUsersData'])->name('user.getData');
    Route::get('users/info/{id}', [MstUsersController::class, 'getUserByID']);
    Route::post('users/{id}', [MstUsersController::class, 'lockOrUnlockUser'])->name('user.lock');
    Route::post('users', [MstUsersController::class, 'store'])->name('user.create');
    Route::post('users/update/{id}', [MstUsersController::class, 'update'])->name('user.update');
    Route::delete('users/{id}', [MstUsersController::class, 'destroy'])->name('user.delete');

    Route::get('check-email',[MstUsersController::class, 'checkEmail'])->name('user.chkemail');
    // Customers route
    Route::get('customers', [MstCustomerController::class, 'index'])->name('customers');
    Route::get('customers/getData', [MstCustomerController::class, 'getCustomerData'])->name('customers.getData');
    Route::get('customers/info/{id}', [MstCustomerController::class, 'getCustomerByID']);
    Route::post('customers', [MstCustomerController::class, 'store'])->name('customers.store'); 
    Route::post('customers/update', [MstCustomerController::class, 'update'])->name('customers.update'); 
    Route::get('customers/export', [MstCustomerController::class, 'export'])->name('customers.export'); 
    Route::post('customers/import', [MstCustomerController::class, 'import'])->name('customers.import');

    // Product
    Route::get('products', [MstProductController::class, 'index'])->name('products');
    Route::get('products/create', [MstProductController::class, 'create'])->name('products.create');
    Route::post('products', [MstProductController::class, 'store'])->name('products.store'); 
    Route::get('products/{id}/edit', [MstProductController::class, 'edit'])->name('products.edit');
    Route::post('products/update/{id}', [MstProductController::class, 'update'])->name('products.update'); 
    Route::get('products/detail/{id}', [MstProductController::class, 'getProductByID']);
    Route::delete('products/{id}', [MstProductController::class, 'destroy'])->name('products.delete');
    Route::get('products/getData', [MstProductController::class, 'getProductData'])->name('products.getData');
    
    Route::get('/logout', [LoginController::class, 'logOut'])->name('logout');

});
