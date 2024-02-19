<?php

declare(strict_types=1);

namespace App\Service\CommissionCalculator;

readonly class Transaction
{
    public function __construct(public string $bin, public string $amount, public string $currency)
    {
    }

    public function convertToEUR(string $amount): Transaction
    {
        return new self($this->bin, $amount, 'EUR');
    }
}
