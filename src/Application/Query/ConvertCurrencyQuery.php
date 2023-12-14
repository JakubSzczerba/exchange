<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\Query;

class ConvertCurrencyQuery
{
    private string $amount;

    private string $from;

    private string $to;

    public function __construct(float $amount, string $from, string $to)
    {
        $this->amount = (string)$amount;
        $this->from = $from;
        $this->to = $to;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }
}