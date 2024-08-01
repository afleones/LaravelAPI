<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\ConsumesExternalServices;

class CurrencyConversionService
{
    use ConsumesExternalServices;

    protected $baseUri;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUri = config('services.currency_conversion.base_uri');
        $this->apiKey = config('services.currency_conversion.api_key');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $queryParams['apiKey'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function resolveAccessToken()
    {
        return $this->apiKey;
    }

    public function convertCurrency($from, $to)
    {
        $response = $this->makeRequest(
            'GET',
            '/api/v7/convert',
            [
                'q' => "{$from}_{$to}",
                'compact' => 'ultra',
            ]
        );
    
        // Decodifica la respuesta JSON a un array
        $responseData = json_decode($response, true);
    
        // Agrega una verificación para asegurarte de que $responseData no sea null
        if (is_null($responseData)) {
            throw new \Exception('Error decoding JSON response');
        }
    
        // Verifica que la clave esté presente en el array
        if (!isset($responseData["{$from}_{$to}"])) {
            throw new \Exception("Conversion rate not found for {$from}_{$to}");
        }
    
        return $responseData["{$from}_{$to}"];
    }
}