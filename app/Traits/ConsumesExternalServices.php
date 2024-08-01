<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [], $isJsonRequest = false)
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
    
        if (method_exists($this, 'resolveAuthorization')) {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
        }
    
        try {
            $response = $client->request($method, $requestUrl, [
                $isJsonRequest ? 'json' : 'form_params' => $formParams,
                'headers' => $headers,
                'query' => $queryParams,
            ]);
        } catch (\Exception $e) {
            // Maneja cualquier excepción lanzada por Guzzle
            throw new \Exception('Request failed: ' . $e->getMessage());
        }
    
        $responseBody = $response->getBody()->getContents();
    
        if (method_exists($this, 'decodeResponse')) {
            return $this->decodeResponse($responseBody);
        }
        echo($responseBody);
        return $responseBody;
    }
}