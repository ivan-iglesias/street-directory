<?php

namespace App\Tests\Application\Controller;

use Symfony\Component\HttpFoundation\Response;

class StreetControllerTest extends ControllerTest
{
    public function test_should_return_the_portals_of_the_street(): void
    {
        $response = $this->makeRequest('GET', '/street/10/portal');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $portals = json_decode($response->getContent(), true);

        $this->assertIsArray($portals);

        $portal = $portals[0];
        $this->assertIsArray($portal);
        $this->assertArrayHasKey('number', $portal);
        $this->assertArrayHasKey('bis', $portal);
        $this->assertSame(1, $portal['number']);
        $this->assertSame('A', $portal['bis']);
    }

    /**
     * @testWith ["XX"]
     *           ["99"]
     */
    public function test_should_not_return_the_portals_of_the_street(string $streetId): void
    {
        $response = $this->makeRequest('GET', "/street/{$streetId}/portal");

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertSame('null', $response->getContent());
    }
}
