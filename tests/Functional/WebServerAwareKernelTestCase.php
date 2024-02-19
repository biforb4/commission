<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use donatj\MockWebServer\MockWebServer;
use donatj\MockWebServer\Responses\NotFoundResponse;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class WebServerAwareKernelTestCase extends WebTestCase
{
    private const PORT = 8099;
    protected static MockWebServer $mockServer;

    public static function setUpBeforeClass(): void
    {
        $server = new MockWebServer(self::PORT);
        if (!$server->isRunning()) {
            $server->start();
        }
        $server->setDefaultResponse(new NotFoundResponse());

        self::$mockServer = $server;
    }

    public static function tearDownAfterClass(): void
    {
        self::$mockServer->stop();
    }
}
