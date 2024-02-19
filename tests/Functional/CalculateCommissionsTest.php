<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Functional\Fixtures\ExchangeRatesApiFixture;
use App\Tests\Functional\Fixtures\HandyApiFixture;
use donatj\MockWebServer\Response;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CalculateCommissionsTest extends WebServerAwareKernelTestCase
{
    public function testCommand(): void
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $this->setupApis();

        $command = $application->find('app:calculate-commission');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'filepath' => 'tests/Functional/Data/input.txt',
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString(
            <<<OUTPUT
1
0.81
OUTPUT
            ,
            $output
        );
    }

    private function setupApis(): void
    {
        self::$mockServer->setResponseOfPath(
            '/bin/45717360',
            new Response(HandyApiFixture::getBinDetails('AT'), [], HttpResponse::HTTP_OK)
        );

        self::$mockServer->setResponseOfPath(
            '/bin/516793',
            new Response(HandyApiFixture::getBinDetails('RU'), [], HttpResponse::HTTP_OK)
        );

        self::$mockServer->setResponseOfPath(
            '/latest',
            new Response(ExchangeRatesApiFixture::getRates(), [], HttpResponse::HTTP_OK)
        );
    }
}
