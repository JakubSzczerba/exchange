<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Domain\Currency\Factory;

use Exchange\Domain\Currency\Entity\Currency;

class CurrencyFactory implements CurrencyFactoryInterface
{
    public function createNew(string $code, float $usdPrice, \DateTimeImmutable $date): Currency
    {
        return new Currency(
            $code,
            $usdPrice,
            $date
        );
    }
}