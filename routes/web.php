<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::get('/home', function (){return redirect()->route('home');});

    Route::resource('clients', \App\Http\Controllers\ClientController::class);
    Route::resource('clients.orders', \App\Http\Controllers\OrderController::class)->shallow();

    Route::post('items/search', [\App\Http\Controllers\ItemController::class, 'search'])->name('items.search');

});
