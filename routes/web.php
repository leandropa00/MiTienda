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

Route::get('/home', 'HomeController@index')->name('home');