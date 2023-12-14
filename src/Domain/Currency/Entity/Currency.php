<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace Exchange\Domain\Currency\Entity;

use Exchange\Infrastructure\Currency\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(nullable: false)]
    private string $code;

    #[ORM\Column(nullable: false)]
    private float $usdPrice;

    #[ORM\Column(nullable: false)]
    private \DateTimeImmutable $ratedAt;

    public function __construct(string $code, float $usdPrice, \DateTimeImmutable $ratedAt)
    {
        $this->code = $code;
        $this->usdPrice = $usdPrice;
        $this->ratedAt = $ratedAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getUsdPrice(): float
    {
        return $this->usdPrice;
    }

    public function getRatedAt(): \DateTimeImmutable
    {
        return $this->ratedAt;
    }
}