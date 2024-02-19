<?php

declare(strict_types=1);

namespace App\Service\BinLookup;

interface BinDetailsProvider
{
    public function getAlpha2Country(string $bin): string;
}
