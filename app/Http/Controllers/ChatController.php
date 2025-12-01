<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ably\AblyRest;

class ChatController extends Controller
{
    /**
     * Envia uma mensagem para o canal 'chat-geral' no Ably
     */
    public function enviar(Request $request)
    {
        $dados = $request->validate([
            'usuario' => 'required|string',
            'texto'   => 'required|string',
            'hora'    => 'required|string',
        ]);

        Log::info('Enviando mensagem para Ably:', $dados);

        $ably = new AblyRest(env('ABLY_KEY'));
        $canal = $ably->channels->get('chat-geral');

        $canal->publish('nova-mensagem', $dados);

        return response()->json([
            'ok' => true,
            'mensagem' => $dados
        ]);
    }
}
