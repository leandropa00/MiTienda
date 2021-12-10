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
    Route::resource('productos', ProductoController::class);
});