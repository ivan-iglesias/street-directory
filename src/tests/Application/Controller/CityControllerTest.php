<?php

namespace App\Tests\Application\Controller;

use App\DataFixtures\StreetFixtures;
use Symfony\Component\HttpFoundation\Response;

class CityControllerTest extends ControllerTest
{
    /** @test */
    public function find_city_streets_not_found(): void
    {
        $response = $this->makeRequest('GET', '/city/99999/street');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    /** @test */
    public function find_city_streets(): void
    {
        $response = $this->makeRequest('GET', '/city/48020/street');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 1,
                'pageTotalItems' => 13,
                'pageFirstItem' => StreetFixtures::STREETS[0],
            ],
            $response
        );
    }

    /** @test */
    public function find_city_streets_first_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/city/48020/street?pageSize=10&page=1');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 2,
                'pageTotalItems' => 10,
                'pageFirstItem' => StreetFixtures::STREETS[0],
            ],
            $response
        );
    }

    /** @test */
    public function find_city_streets_last_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/city/48020/street?pageSize=10&page=2');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 2,
                'pageTotalItems' => 3,
                'pageFirstItem' => StreetFixtures::STREETS[10],
            ],
            $response
        );
    }

    /** @test */
    public function find_city_streets_page_out_of_range(): void
    {
        $response = $this->makeRequest('GET', '/city/48020/street?pageSize=10&page=999');

        $this->assertReponse(
            [
                'totalItems' => 13,
                'totalPages' => 2,
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

        if (isset($expected['pageFirstItem'])) {
            $this->assertSame($expected['pageFirstItem'][0], $items[0]['thoroughfare']['code']);
            $this->assertSame($expected['pageFirstItem'][1], $items[0]['name']);
        }
    }
}
