<?php

namespace App\Services;

use GuzzleHttp\Client;

class ViaCepService
{
    public function handle(string $zipCode): array
    {
        $client = new Client();

        try {
            $response = $client->get("https://viacep.com.br/ws/{$zipCode}/json/");
            $data     = json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            return [];
        }

        if (isset($data->erro)) {
            return [];
        }

        return [
            'address'      => $data->logradouro,
            'neighborhood' => $data->bairro,
            'city'         => $data->localidade,
            'state'        => $data->uf,
        ];
    }
}
