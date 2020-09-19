<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * yBank API ROUTES
 */
Route::prefix('accounts')->group(function() { 
    Route::get('/', 'AccountController@index')->name('accounts.index');
    Route::post('/', 'AccountController@store')->name('accounts.store');
    Route::get('/{id}', 'AccountController@show')->name('accounts.show');
    Route::put('/{id}', 'AccountController@update')->name('accounts.update');
    Route::delete('/{id}', 'AccountController@delete')->name('accounts.delete');

    Route::get('/{id}/transactions', 'AccountController@getAccountTransactions')->name('transactions.account');
});

Route::prefix('transactions')->group(function() {
    Route::get('/', 'TransactionController@index')->name('transactions.index');
    Route::post('/', 'TransactionController@store')->name('transactions.store');
    Route::get('/{id}', 'TransactionController@show')->name('transactions.show');
});

Route::get('currencies', 'CurrencyController@index')->name('currencies.index');