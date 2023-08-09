<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AddresssService
{
    public static function getCEPInfo($cep)
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful()) {
            $cepData = $response->json();

            dd($cepData);
        } else {
            return response()->json(['error' => 'Erro ao obter informações de CEP'], 500);
        }
    }
}

