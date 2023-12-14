<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Infrastructure\Currency\Repository;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Exchange\Domain\Currency\Entity\Currency;
use Exchange\Domain\Currency\CurrencyRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CurrencyRepository extends ServiceEntityRepository implements CurrencyRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function findMinRate(string $code, \DateTimeImmutable $startDate, \DateTimeImmutable $endDate): ?string
    {
        $qb = $this->createQueryBuilder('c')
            ->select('MIN(c.usdPrice)')
            ->andWhere('c.code = :code')
            ->andWhere('c.ratedAt BETWEEN :start_date AND :end_date')
            ->setParameter('code', $code)
            ->setParameter('start_date', $startDate)
            ->setParameter('end_date', $endDate);

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function findMaxRate(string $code, \DateTimeImmutable $startDate, \DateTimeImmutable $endDate): ?string
    {
        $qb = $this->createQueryBuilder('c')
            ->select('MAX(c.usdPrice)')
            ->andWhere('c.code = :code')
            ->andWhere('c.ratedAt BETWEEN :start_date AND :end_date')
            ->setParameter('code', $code)
            ->setParameter('start_date', $startDate)
            ->setParameter('end_date', $endDate);

        return $qb->getQuery()->getSingleScalarResult();
    }
}