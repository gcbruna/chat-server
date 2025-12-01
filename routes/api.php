<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ably\AblyRest;

use App\Http\Controllers\AblyTokenController;
use App\Http\Controllers\ChatController;

Route::get('/ably-token', [AblyTokenController::class, 'generate']);
Route::post('/chat/enviar', [ChatController::class, 'enviar']);
