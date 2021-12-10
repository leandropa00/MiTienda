<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'reset'   => false,
    'verify'  => false,
    'confirm' => false
]);

Route::middleware(['auth', 'variables'])->group(function () {
    //* Productos
    Route::resource('productos', ProductoController::class);
    //* Stock
    Route::get('stock/{producto}', 'StockController@index')->name('stock.index');
    Route::get('stock/{producto}/create', 'StockController@create')->name('stock.create');
    Route::post('stock/{producto}', 'StockController@store')->name('stock.store');
    //* Facturas
    Route::resource('facturas', FacturaController::class)->only(['index', 'create', 'store']);

});