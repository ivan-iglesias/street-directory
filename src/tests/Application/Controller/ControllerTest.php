<?php

namespace App\Tests\Application\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class ControllerTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    protected function makeRequest(string $method, string $url): Response
    {
        $this->client->request($method, $url);

        return $this->client->getResponse();
    }

    protected function assertHeaders(
        array $expected,
        $headers
    ): void {
        $totalItems = $headers->get('total-items');
        $this->assertNotNull($totalItems);
        $this->assertSame((string)$expected['totalItems'], $totalItems);

        $totalPages = $headers->get('total-pages');
        $this->assertNotNull($totalPages);
        $this->assertSame((string)$expected['totalPages'], $totalPages);
    }
}
