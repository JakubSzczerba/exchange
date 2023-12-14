<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Domain\Currency\Command;

use Exchange\Application\Service\Currency\DateTimeRangeServiceInterface;
use Exchange\Domain\Currency\Factory\CurrencyFactoryInterface;
use Exchange\Infrastructure\Currency\Api\CurrencyBeaconApi;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'exchange:load:currency')]
class LoadCurrencyCommand extends Command
{
    private const BATCH = 300;

    private const ITERATION_START = 0;

    private DateTimeRangeServiceInterface $dateTimeRangeService;

    private CurrencyBeaconApi $currencyBeaconApi;

    private CurrencyFactoryInterface $currencyFactory;

    private EntityManagerInterface $em;

    public function __construct(
        DateTimeRangeServiceInterface $dateTimeRangeService,
        CurrencyBeaconApi $currencyBeaconApi,
        CurrencyFactoryInterface $currencyFactory,
        EntityManagerInterface $em
    ) {
        parent::__construct();

        $this->dateTimeRangeService = $dateTimeRangeService;
        $this->currencyBeaconApi = $currencyBeaconApi;
        $this->currencyFactory = $currencyFactory;
        $this->em = $em;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting to import the currencies');

        $dateRange = $this->dateTimeRangeService->getRange(new \DateTimeImmutable());

        $iterationCount = self::ITERATION_START;
        foreach ($dateRange as $dateTime) {
            $date = $dateTime->format('Y-m-d');
            $result = $this->currencyBeaconApi->getRatesForDate($date);

            foreach ($result['response']['rates'] as $code => $price) {
                $currency = $this->currencyFactory->createNew($code, $price, $dateTime);
                $this->em->persist($currency);
            }

            if ((++$iterationCount % self::BATCH) === 0) {
                $this->em->flush();
                $this->em->clear();
            }
        }
        $io->success('Currencies has been imported');

        return Command::SUCCESS;
    }
}