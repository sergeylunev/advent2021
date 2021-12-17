<?php

namespace Advent\Dto;

use JetBrains\PhpStorm\Pure;

class LifeSupportRating
{
    private string $oxygen;

    private string $co2;

    public function __construct(string $oxygen, string $co2)
    {
        $this->oxygen = $oxygen;
        $this->co2 = $co2;
    }

    public function getOxygen(): string
    {
        return $this->oxygen;
    }

    #[Pure] public function getOxygenDec(): int
    {
        return bindec($this->getOxygen());
    }

    public function getCo2(): string
    {
        return $this->co2;
    }

    #[Pure] public function getCo2Dec(): int
    {
        return bindec($this->getCo2());
    }

    #[Pure] public function getRating(): int
    {
        return $this->getOxygenDec() * $this->getCo2Dec();
    }
}