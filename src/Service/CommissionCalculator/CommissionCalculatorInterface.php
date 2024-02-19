<?php

declare(strict_types=1);

namespace App\Service\CommissionCalculator;

interface CommissionCalculatorInterface
{
    public function calculate(Transaction $transaction): string;
}
