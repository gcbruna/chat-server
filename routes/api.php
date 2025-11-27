<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/teste', function () {
    return response()->json([
        'message' => 'API funcionando!'
    ]);
});

Route::post('/mensagens', [ChatController::class, 'enviar']);
