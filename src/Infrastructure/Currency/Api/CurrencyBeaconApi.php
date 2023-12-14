<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Infrastructure\Currency\Api;

use GuzzleHttp\Client;

class CurrencyBeaconApi
{
    private const HISTORICAL = 'historical';

    private const SYMBOLS = 'PLN,EUR,USD';

    private const CONVERT = 'convert';

    private string $apiUrl;

    private string $apiKey;

    private Client $httpClient;

    public function __construct(string $apiUrl, string $apiKey, Client $httpClient)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
    }

    public function getRatesForDate(string $date): array
    {
        $symbols = self::SYMBOLS;
        $url = $this->apiUrl . self::HISTORICAL . "?api_key={$this->apiKey}&date={$date}&symbols={$symbols}";
        $response = $this->httpClient->get($url);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getRatesConvert(string $from, string $to, string $amount): array
    {
        $url = $this->apiUrl . self::CONVERT . "?api_key={$this->apiKey}&from={$from}&to={$to}&amount={$amount}";
        $response = $this->httpClient->get($url);

        return json_decode($response->getBody()->getContents(), true);
    }
}