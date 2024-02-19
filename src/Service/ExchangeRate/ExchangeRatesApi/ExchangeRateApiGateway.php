<?php

declare(strict_types=1);

namespace App\Service\ExchangeRate\ExchangeRatesApi;

use App\Exception\ApplicationException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ExchangeRateApiGateway
{
    private const ENDPOINT = '%s/latest?access_key=%s&base=%s';

    public function __construct(
        private HttpClientInterface $client,
        #[Autowire('%env(EXCHANGE_RATES_API_IO_API_KEY)%')] private string $apiKey,
        #[Autowire('%env(EXCHANGE_RATES_API_IO_API_HOST)%')] private string $host
    ) {
    }

    public function getLatestRates(string $baseCurrency): array
    {
        $response = $this->client->request(
            'GET',
            sprintf(self::ENDPOINT, $this->host, $this->apiKey, $baseCurrency)
        );

        $content = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        if (true !== $content['success']) {
            throw new ApplicationException('Invalid api response');
        }

        return $content;
    }
}
