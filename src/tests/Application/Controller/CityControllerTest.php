<?php

namespace App\Tests\Application\Controller;

use App\DataFixtures\StreetFixtures;
use Symfony\Component\HttpFoundation\Response;

class CityControllerTest extends ControllerTest
{
    public function test_should_return_the_streets_of_the_city(): void
    {
        $response = $this->makeRequest('GET', '/city/48020/street');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $streets = json_decode($response->getContent(), true);
        $expectedTotalStreets = count(StreetFixtures::STREETS);

        $this->assertIsArray($streets);
        $this->assertCount($expectedTotalStreets, $streets);

        $street = $streets[0];
        $this->assertIsArray($street);
        $this->assertArrayHasKey('thoroughfare', $street);
        $this->assertArrayHasKey('name', $street);
        $this->assertSame('Iruña', $street['name']);

        $thoroughfare = $street['thoroughfare'];
        $this->assertArrayHasKey('code', $thoroughfare);
        $this->assertArrayHasKey('name', $thoroughfare);
        $this->assertSame('CL', $thoroughfare['code']);
        $this->assertSame('Calle', $thoroughfare['name']);
    }

    /**
     * @testWith ["XX"]
     *           ["99"]
     */
    public function test_should_not_return_the_streets_of_the_city(string $cityCode): void
    {
        $response = $this->makeRequest('GET', "/city/{$cityCode}/street");

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertSame('null', $response->getContent());
    }
}
