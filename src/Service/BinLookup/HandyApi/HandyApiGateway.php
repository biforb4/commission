<?php

declare(strict_types=1);

namespace App\Service\BinLookup\HandyApi;

use App\Exception\ApplicationException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HandyApiGateway
{
    private const ENDPOINT = '%s/bin/%s';

    public function __construct(
        private HttpClientInterface $client,
        #[Autowire('%env(HANDY_API_HOST)%')] private string $host
    ) {
    }

    public function getDetails(string $bin): array
    {
        $response = $this->client->request(
            'GET',
            sprintf(self::ENDPOINT, $this->host, $bin)
        );

        $content = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);
        if ('SUCCESS' !== $content['Status']) {
            throw new ApplicationException('Invalid api response');
        }

        return $content;
    }
}
