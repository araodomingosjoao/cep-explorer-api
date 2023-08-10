<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Support\Facades\Http;

class AddressService
{
    public static function findAndSaveCEP($cep)
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        $cepData = $response->json();

        if (!$response->successful() || array_key_exists('erro', $cepData)) {
            return [];
        }

        Address::create([
            'postal_code' => $cep,
            'city' => $cepData['localidade'],
            'state' => $cepData['uf'],
            'complement' => $cepData['complemento'],
            'street' => $cepData['bairro'],
            'number' => $cepData['ibge'],
            'neighborhood' => $cepData['logradouro'],
        ]);

        return $cepData;
    }

}

