<?php

namespace App\Tests\Application\Controller;

use App\DataFixtures\PortalFixtures;
use Symfony\Component\HttpFoundation\Response;

class StreetControllerTest extends ControllerTest
{
    /** @test */
    public function find_street_portals_not_found(): void
    {
        $response = $this->makeRequest('GET', '/street/d9e7a184-5d5b-11ea-a62a-3499710062d0/portal');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
    }

    /** @test */
    public function find_street_portals(): void
    {
        $response = $this->makeRequest('GET', '/street/7fbe27e3-0b58-48dd-8ba3-8cd23df30105/portal');

        $this->assertReponse(
            [
                'totalItems' => 8,
                'totalPages' => 1,
                'pageTotalItems' => 8,
                'pageFirstItem' => PortalFixtures::PORTALS[0],
            ],
            $response
        );
    }

    /** @test */
    public function find_street_portals_first_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/street/7fbe27e3-0b58-48dd-8ba3-8cd23df30105/portal?pageSize=5&page=1');

        $this->assertReponse(
            [
                'totalItems' => 8,
                'totalPages' => 2,
                'pageTotalItems' => 5,
                'pageFirstItem' => PortalFixtures::PORTALS[0],
            ],
            $response
        );
    }

    /** @test */
    public function find_street_portals_last_pagination_page(): void
    {
        $response = $this->makeRequest('GET', '/street/7fbe27e3-0b58-48dd-8ba3-8cd23df30105/portal?pageSize=5&page=2');

        $this->assertReponse(
            [
                'totalItems' => 8,
                'totalPages' => 2,
                'pageTotalItems' => 3,
                'pageFirstItem' => PortalFixtures::PORTALS[5],
            ],
            $response
        );
    }

    /** @test */
    public function find_street_portals_page_out_of_range(): void
    {
        $response = $this->makeRequest('GET', '/street/7fbe27e3-0b58-48dd-8ba3-8cd23df30105/portal?pageSize=5&page=999');

        $this->assertReponse(
            [
                'totalItems' => 8,
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
            $this->assertSame($expected['pageFirstItem'][2], $items[0]['number']);
            $this->assertSame($expected['pageFirstItem'][3], $items[0]['bis']);
        }
    }
}
