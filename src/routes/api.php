<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CampsiteController;

Route::apiResource('campsites', CampsiteController::class);

// 動作確認用：↓追加
Route::get('/test', function() {
    return 'api ok';
});

