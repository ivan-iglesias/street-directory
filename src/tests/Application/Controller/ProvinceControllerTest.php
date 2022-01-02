<?php

namespace App\Tests\Application\Controller;

use App\DataFixtures\CityFixtures;
use App\DataFixtures\ProvinceFixtures;
use Symfony\Component\HttpFoundation\Response;

class ProvinceControllerTest extends ControllerTest
{
    /** @test */
    public function find_all(): void
    {
        $response = $this->makeRequest('GET', '/province');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 1,
                'pageTotalItems' => 13,
            ],
            $response
        );

        $this->assertProvince(ProvinceFixtures::PROVINCES[0], $response);
    }

    /** @test */
    public function find_all_first_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/province?pageSize=10&page=1');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 2,
                'pageTotalItems' => 10,
            ],
            $response
        );

        $this->assertProvince(ProvinceFixtures::PROVINCES[0], $response);
    }

    /** @test */
    public function find_all_last_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/province?pageSize=10&page=2');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 2,
                'pageTotalItems' => 3,
            ],
            $response
        );

        $this->assertProvince(ProvinceFixtures::PROVINCES[10], $response);
    }

    /** @test */
    public function find_all_page_out_of_range(): void
    {
        $response = $this->makeRequest('GET', '/province?pageSize=10&page=999');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 2,
                'pageTotalItems' => 0,
            ],
            $response
        );
    }

    /** @test */
    public function find_province_cities_not_found(): void
    {
        $response = $this->makeRequest('GET', '/province/99999/city');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    /** @test */
    public function find_province_cities(): void
    {
        $response = $this->makeRequest('GET', '/province/48/city');

        $this->assertReponse(
            [
                'totalItems' => 25,
                'totalPages' => 2,
                'pageTotalItems' => 24,
            ],
            $response
        );

        $this->assertCity(CityFixtures::CITIES[0], $response);
    }

    /** @test */
    public function find_province_cities_first_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/province/48/city?pageSize=10&page=1');

        $this->assertReponse(
            [
                'totalItems' => 25,
                'totalPages' => 3,
                'pageTotalItems' => 10,
            ],
            $response
        );

        $this->assertCity(CityFixtures::CITIES[0], $response);
    }

    /** @test */
    public function find_province_cities_last_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/province/48/city?pageSize=10&page=3');

        $this->assertReponse(
            [
                'totalItems' => 25,
                'totalPages' => 3,
                'pageTotalItems' => 5,
            ],
            $response
        );

        $this->assertCity(CityFixtures::CITIES[20], $response);
    }

    /** @test */
    public function find_province_cities_page_out_of_range(): void
    {
        $response = $this->makeRequest('GET', '/province/48/city?pageSize=10&page=999');

        $this->assertReponse(
            [
                'totalItems' => 25,
                'totalPages' => 3,
                'pageTotalItems' => 0,
            ],
            $response
        );
    }

    public function assertReponse(array $expected, Response $response): void
    {
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertHeaders($expected, $response->headers);

        $items = json_decode($response->getContent(), true);
        $this->assertCount($expected['pageTotalItems'], $items);
    }

    public function assertProvince(array $expectedFirstItem, Response $response): void
    {
        $items = json_decode($response->getContent(), true);
        $this->assertSame($expectedFirstItem[0], $items[0]['code']);
        $this->assertSame($expectedFirstItem[1], $items[0]['name']);
    }

    public function assertCity(array $expectedFirstItem, Response $response): void
    {
        $items = json_decode($response->getContent(), true);
        $this->assertSame($expectedFirstItem[0], $items[0]['code']);
        $this->assertSame($expectedFirstItem[1], $items[0]['name']);
    }
}
