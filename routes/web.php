<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFlightController;
use App\Http\Controllers\UserTransactionController;

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

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(
    ['middleware' => ['auth']],
    function () {
        Route::resource('town', TownController::class)->middleware('cek.level:admin');
        Route::resource('admin-flight', FlightController::class)->middleware(['cek.level:admin']);
        Route::get('admin-transaction', [TransactionController::class, 'index'])->name('admin-transaction.index')->middleware(['cek.level:admin']);
        Route::get('admin-flight/save/{id}', [FlightController::class, 'buy'])->name('admin-flight.save')->middleware(['cek.level:admin']);
        Route::get('user', [UserController::class, 'index'])->name('user.index')->middleware(['cek.level:admin']);
        Route::delete('user/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware(['cek.level:admin']);

        ## User Route
        Route::resource('flight', UserFlightController::class)->middleware(['cek.level:user']);
        Route::get('flight/buy/{id}', [UserFlightController::class, 'buy'])->name('flight.buy');
        Route::post('flight/buy', [UserFlightController::class, 'buyStore'])->name('flight.buy.store');

        Route::resource('transaction', UserTransactionController::class)->middleware(['cek.level:user']);
    }
);
