<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\QueryHandler;

use Exchange\Application\Query\ConvertCurrencyQuery;
use Exchange\Infrastructure\Currency\Api\CurrencyBeaconApi;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ConvertCurrencyHandler
{
    private CurrencyBeaconApi $currencyBeaconApi;

    public function __construct(CurrencyBeaconApi $currencyBeaconApi)
    {
        $this->currencyBeaconApi = $currencyBeaconApi;
    }

    public function __invoke(ConvertCurrencyQuery $query): array
    {
        $response = $this->currencyBeaconApi->getRatesConvert(
            $query->getFrom(),
            $query->getTo(),
            $query->getAmount()
        );

        return [
            'amount' => $response['amount'],
            'from' => $response['from'],
            'to' => $response['to'],
            'value' => $response['value'],
        ];
    }
}