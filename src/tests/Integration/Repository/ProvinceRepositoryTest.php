<?php

namespace App\Tests\Integration\Repository;

use App\DataFixtures\ProvinceFixtures;
use App\Entity\City;
use App\Entity\Province;

class ProvinceRepositoryTest extends RepositoryTest
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository(Province::class);
    }

    public function test_find_all_provinces(): void
    {
        $provinces = $this->repository->findAll();

        $totalProvinces = count(ProvinceFixtures::PROVINCES);

        $this->assertCount($totalProvinces, $provinces);
        $this->assertProvince(1, $provinces[0]);
        $this->assertProvince($totalProvinces, $provinces[$totalProvinces-1]);
    }

    private function assertProvince(int $expectedId, Province $province): void
    {
        $expectedProvince = ProvinceFixtures::PROVINCES[$expectedId - 1];

        $this->assertSame($expectedId, $province->getId());
        $this->assertSame($expectedProvince[0], $province->getCode());
        $this->assertSame($expectedProvince[1], $province->getName());
    }

    public function test_should_find_a_province(): void
    {
        $province = $this->repository->findOneBy(['code' => '48']);

        $this->assertInstanceOf(Province::class, $province);
        $this->assertSame('48', $province->getCode());
        $this->assertSame('Bizkaia', $province->getName());

        $cities = $province->getCities();

        $this->assertCount(25, $cities);
        $this->assertInstanceOf(City::class, $cities[0]);
    }

    /**
     * @testWith ["XX"]
     *           ["99"]
     */
    public function test_should_not_find_a_province($provinceCode): void
    {
        $province = $this->repository->findOneBy(['code' => $provinceCode]);

        $this->assertNull($province);
    }
}
