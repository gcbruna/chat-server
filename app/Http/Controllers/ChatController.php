<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ably\AblyRest;

class ChatController extends Controller
{
    public function enviar(Request $request)
    {
        $dados = $request->all();

        Log::info('Enviando para Ably:', $dados);

        // Publicar no Ably
        $ably = new AblyRest(env('ABLY_KEY'));
        $canal = $ably->channels->get('chat-geral');
        $canal->publish('nova-mensagem', $dados);

        return response()->json(['ok' => true]);
    }
}
