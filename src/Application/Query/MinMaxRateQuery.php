<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\Query;

class MinMaxRateQuery
{
    private string $code;

    private string $startDate;

    private string $endDate;

    public function __construct(string $code, string $dateRange)
    {
        $this->code = $code;
        [$this->startDate, $this->endDate] = explode(' - ', $dateRange);
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getStartDate(): string
    {
        return $this->startDate;
    }

    public function getEndDate(): string
    {
        return $this->endDate;
    }

    public function getStartDateTimeObject(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->startDate);
    }

    public function getEndDateTimeObject(): \DateTimeImmutable
    {
        return new \DateTimeImmutable($this->endDate);
    }
}