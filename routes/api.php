<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use Ably\AblyRest;

Route::get('/ably-token', function () {
    $ably = new AblyRest(env('ABLY_KEY'));
    $token = $ably->auth->createTokenRequest();

    return response()->json($token);
});

Route::post('/mensagens', [ChatController::class, 'enviar']);
