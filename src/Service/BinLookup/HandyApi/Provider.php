<?php

declare(strict_types=1);

namespace App\Service\BinLookup\HandyApi;

use App\Service\BinLookup\BinDetailsProvider;

class Provider implements BinDetailsProvider
{
    public function __construct(private HandyApiGateway $gateway)
    {
    }

    public function getAlpha2Country(string $bin): string
    {
        $binDetails = $this->gateway->getDetails($bin);

        return $binDetails['Country']['A2'];
    }
}
