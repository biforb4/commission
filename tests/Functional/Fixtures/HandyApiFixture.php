<?php

declare(strict_types=1);

namespace App\Tests\Functional\Fixtures;

class HandyApiFixture
{
    public static function getBinDetails(string $countryCode): string
    {
        return json_encode([
            'Status' => 'SUCCESS',
            'Scheme' => 'MASTERCARD',
            'Type' => 'CREDIT',
            'Issuer' => 'COMMONWEALTH BANK OF AUSTRALIA',
            'CardTier' => 'STANDARD',
            'Country' => [
                'A2' => $countryCode,
                'A3' => 'AUS',
                'N3' => '036',
                'ISD' => '61',
                'Name' => 'Australia',
                'Cont' => 'Oceania',
            ],
            'Luhn' => true,
        ], JSON_THROW_ON_ERROR);
    }
}
