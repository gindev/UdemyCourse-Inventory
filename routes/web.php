<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
    
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->middleware(['verified'])->name('dashboard');
});

Route::get('/', function () {
    return view('/frontend.index');
})->name('home');

require __DIR__.'/auth.php';
