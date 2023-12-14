<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Domain\Currency;

interface CurrencyRepositoryInterface
{
    public function findMinRate(string $code, \DateTimeImmutable $startDate, \DateTimeImmutable $endDate): ?string;

    public function findMaxRate(string $code, \DateTimeImmutable $startDate, \DateTimeImmutable $endDate): ?string;
}