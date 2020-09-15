<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->namespace('Finance')->group(function() {
    Route::post('/add-credits', [\App\Http\Controllers\Finance\WalletController::class, 'update'])->name('add_credits');
    Route::post('/create-deposit', [\App\Http\Controllers\Finance\DepositController::class, 'store'])->name('create_deposit');
    Route::get('/deposits', [\App\Http\Controllers\Finance\DepositController::class, 'index'])->name('deposits');
    Route::get('/transactions', [\App\Http\Controllers\Finance\TransactionController::class, 'index'])->name('transactions');
});

Route::get('/home', 'HomeController@index')->name('home');
