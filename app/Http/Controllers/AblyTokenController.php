<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ably\AblyRest;

class AblyTokenController extends Controller
{
    /**
     * Gera um TokenRequest para autenticação do Ably Realtime
     */
    public function generate(Request $request)
    {
        try {
            $apiKey = env('ABLY_KEY');

            if (!$apiKey) {
                return response()->json([
                    'error' => true,
                    'message' => 'ABLY_KEY não encontrada no .env'
                ], 500);
            }

            $ably = new AblyRest($apiKey);

            $clientId = $request->query('clientId') ?? null;
            $tokenRequestOptions = [];
            if ($clientId) $tokenRequestOptions['clientId'] = $clientId;

            $tokenRequest = $ably->auth->createTokenRequest($tokenRequestOptions);


            return response()->json($tokenRequest);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
