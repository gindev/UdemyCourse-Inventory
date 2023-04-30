<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\SupplierController;

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
Route::middleware(['auth'])->group(function(){
    Route::controller(AdminController::class)->group(function() {
        Route::get('/logout', 'destroy')->name('admin.logout');
        Route::get('/profile', 'Profile')->name('admin.profile');
        Route::get('/profile/edit', 'EditProfile')->name('edit.profile');
        Route::post('/profile/edit', 'StoreProfile')->name('store.profile');
        Route::get('/profile/password', 'ChangePassword')->name('change.password');
        Route::post('/profile/password', 'UpdatePassword')->name('update.password');
    });
    
    Route::controller(SupplierController::class)->group(function() {
        Route::get('/supplier/all', 'SupplierAll')->name('supplier.all');
        Route::get('/supplier/add', 'SupplierAdd')->name('supplier.add');
        Route::post('/supplier/store', 'SupplierStore')->name('supplier.store');
        Route::get('/supplier/edit/{id}', 'SupplierEdit')->name('supplier.edit');
        Route::post('/supplier/update', 'SupplierUpdate')->name('supplier.update');
        Route::get('/supplier/delete/{id}', 'SupplierDelete')->name('supplier.delete');
    });

    Route::get('/dashboard', function () {
        return view('admin.index');
    })->middleware(['verified'])->name('dashboard');
});

Route::get('/', function () {
    return view('/frontend.index');
})->name('home');

require __DIR__.'/auth.php';
