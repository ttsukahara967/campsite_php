<?php

use Illuminate\Support\Facades\Route;

Route::get('/webtest', function() {
    return 'web ok';
});


Route::get('/', function () {
    return view('welcome');
});
