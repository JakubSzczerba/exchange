<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\Service\Currency;

class DateTimeRangeService implements DateTimeRangeServiceInterface
{
    private const RANGE = 'P365D';

    private const INTERVAL = 'P1D';

    public function getRange(\DateTimeImmutable $endDate): \DatePeriod
    {
        $startDate = (new \DateTimeImmutable($endDate->format('Y-01-01')));
        $dateInterval = new \DateInterval(self::INTERVAL);

        return new \DatePeriod($startDate, $dateInterval, $endDate);
    }
}