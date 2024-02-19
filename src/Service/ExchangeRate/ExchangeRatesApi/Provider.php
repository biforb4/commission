<?php

declare(strict_types=1);

namespace App\Service\ExchangeRate\ExchangeRatesApi;

use App\Exception\ApplicationException;
use App\Service\ExchangeRate\ExchangeRateProviderInterface;

class Provider implements ExchangeRateProviderInterface
{
    public function __construct(private ExchangeRateApiGateway $gateway)
    {
    }

    public function getRate(string $sourceValue, string $targetValue): string
    {
        $rates = $this->gateway->getLatestRates($sourceValue)['rates'];

        if (isset($rates[$targetValue])) {
            return (string) $rates[$targetValue];
        }

        throw new ApplicationException(sprintf('Unable to find exchange rate %s to %s', $sourceValue, $targetValue));
    }
}
