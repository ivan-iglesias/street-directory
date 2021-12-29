<?php

namespace App\Tests\Integration\Repository;

use App\Entity\City;
use App\Entity\Street;

class CityRepositoryTest extends RepositoryTest
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository(City::class);
    }

    public function test_should_find_a_city(): void
    {
        $city = $this->repository->findOneBy(['code' => '48020']);

        $this->assertInstanceOf(City::class, $city);
        $this->assertSame('48020', $city->getCode());
        $this->assertSame('Bilbao', $city->getName());

        $streets = $city->getStreets();
        $this->assertCount(13, $streets);
        $this->assertInstanceOf(Street::class, $streets[0]);
    }

    /**
     * @testWith ["XX"]
     *           ["99"]
     */
    public function test_should_not_find_a_city($cityCode): void
    {
        $city = $this->repository->findOneBy(['code' => $cityCode]);

        $this->assertNull($city);
    }
}
