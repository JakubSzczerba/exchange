<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\QueryHandler;

use Exchange\Application\Query\MinMaxRateQuery;
use Exchange\Domain\Currency\CurrencyRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MinMaxRateHandler
{
    private CurrencyRepositoryInterface $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function __invoke(MinMaxRateQuery $query): array
    {
        $minRate = $this->currencyRepository->findMinRate(
            $query->getCode(),
            $query->getStartDateTimeObject(),
            $query->getEndDateTimeObject()
        );

        $maxRate = $this->currencyRepository->findMaxRate(
            $query->getCode(),
            $query->getStartDateTimeObject(),
            $query->getEndDateTimeObject()
        );

        return [
            'code' => $query->getCode(),
            'startDate' => $query->getStartDate(),
            'endDate' => $query->getEndDate(),
            'min' => $minRate,
            'max' => $maxRate
        ];
    }
}