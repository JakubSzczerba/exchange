<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Application\Provider;

class TimeRangeProvider
{
    public static function getQuarterChoices(): array
    {
        $quarterChoices = [];

        for ($i = 1; $i <= 4; $i++) {
            $startMonth = ($i - 1) * 3 + 1;
            $endMonth = $i * 3;

            $quarterName = "Quarter $i";
            $startDate = sprintf('01-%02d-2023', $startMonth);
            $endDate = date('d-m-Y', strtotime('last day of ' . "01-$endMonth-2023"));

            $quarterChoices[$quarterName] = "$startDate - $endDate";
        }

        return $quarterChoices;
    }

    public static function getMonthChoices(): array
    {
        $monthChoices = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', strtotime("01-$i-2023"));
            $startDate = sprintf('01-%02d-2023', $i);
            $endDate = date('d-m-Y', strtotime('last day of ' . "01-$i-2023"));

            $monthChoices[$monthName] = "$startDate - $endDate";
        }

        return $monthChoices;
    }

    public static function getWeekChoices(): array
    {
        $weekChoices = [];
        $startDate = new \DateTime('2023-01-01');

        if ($startDate->format('N') !== '1') {
            $startDate->modify('next monday');
        }

        for ($i = 1; $i <= 52; $i++) {
            $endDate = clone $startDate;
            $endDate->modify('+6 days');

            $weekName = "Week $i";
            $startDateString = $startDate->format('d-m-Y');
            $endDateString = $endDate->format('d-m-Y');

            $weekChoices[$weekName] = "$startDateString - $endDateString";

            $startDate->modify('+7 days');
        }

        return $weekChoices;
    }
}