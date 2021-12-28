<?php

namespace App\Tests\Integration\Repository;

use App\DataFixtures\ProvinceFixtures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProvinceControllerTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

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

    public function test_should_find_a_province(): void
    {
        $response = $this->makeRequest('GET', '/province/bizkaia');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $province = json_decode($response->getContent(), true);

        $this->assertIsArray($province);
        $this->assertArrayHasKey('code', $province);
        $this->assertArrayHasKey('name', $province);
        $this->assertArrayHasKey('cities', $province);
        $this->assertSame('48', $province['code']);
        $this->assertSame(25, count($province['cities']));

        $city = $province['cities'][0];
        $this->assertIsArray($city);
        $this->assertArrayHasKey('code', $city);
        $this->assertArrayHasKey('name', $city);
        $this->assertSame('48001', $city['code']);
        $this->assertSame('Abadiño', $city['name']);
    }

    public function test_should_not_find_a_province(): void
    {
        $response = $this->makeRequest('GET', '/province/kansai');

        $this->assertEquals(Response::HTTP_NOT_FOUND, $response->getStatusCode());
        $this->assertSame('null', $response->getContent());
    }

    private function makeRequest(string $method, string $url): Response
    {
        $this->client->request($method, $url);

        return $this->client->getResponse();
    }
}
