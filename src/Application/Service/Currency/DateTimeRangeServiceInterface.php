<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

namespace Exchange\Application\Service\Currency;

interface DateTimeRangeServiceInterface
{
    public function getRange(\DateTimeImmutable $endDate): \DatePeriod;
}