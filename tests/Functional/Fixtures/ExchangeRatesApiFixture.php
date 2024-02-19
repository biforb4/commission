<?php

declare(strict_types=1);

namespace App\Tests\Functional\Fixtures;

class ExchangeRatesApiFixture
{
    public static function getRates(): string
    {
        return json_encode([
            'success' => true,
            'timestamp' => 1519296206,
            'base' => 'EUR',
            'date' => '2021-03-17',
            'rates' => [
                'USD' => 1.23396,
            ],
        ], JSON_THROW_ON_ERROR);
    }
}
