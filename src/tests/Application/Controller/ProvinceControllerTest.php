<?php

namespace App\Tests\Application\Controller;

use App\DataFixtures\CityFixtures;
use App\DataFixtures\ProvinceFixtures;
use Symfony\Component\HttpFoundation\Response;

class ProvinceControllerTest extends ControllerTest
{
    public function test_find_all_provinces(): void
    {
        $response = $this->makeRequest('GET', '/province');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $provinces = json_decode($response->getContent(), true);
        $expectedTotalProvinces = count(ProvinceFixtures::PROVINCES);
        $expectedProvince = ProvinceFixtures::PROVINCES[0];

        $this->assertCount($expectedTotalProvinces, $provinces);
        $this->assertSame($expectedProvince[0], $provinces[0]['code']);
        $this->assertSame($expectedProvince[1], $provinces[0]['name']);
    }

    public function test_should_return_the_cities_of_the_province(): void
    {
        $response = $this->makeRequest('GET', '/province/48/city');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $cities = json_decode($response->getContent(), true);
        $expectedTotalCities = count(CityFixtures::CITIES);

        $this->assertIsArray($cities);
        $this->assertCount($expectedTotalCities, $cities);

        $city = $cities[0];
        $this->assertIsArray($city);
        $this->assertArrayHasKey('code', $city);
        $this->assertArrayHasKey('name', $city);
        $this->assertSame('48001', $city['code']);
        $this->assertSame('Abadiño', $city['name']);
    }

    /**
     * @testWith ["XX"]
     *           ["99"]
     */
    public function test_should_not_return_the_cities_of_the_province(string $provinceCode): void
    {
        $response = $this->makeRequest('GET', "/province/{$provinceCode}/city");

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertSame('null', $response->getContent());
    }
}
