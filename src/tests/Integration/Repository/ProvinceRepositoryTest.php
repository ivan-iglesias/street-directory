<?php

namespace App\Tests\Integration\Repository;

use App\DataFixtures\ProvinceFixtures;
use App\Entity\Province;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProvinceRepositoryTest extends KernelTestCase
{
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null;
    }

    public function test_find_all_provinces(): void
    {
        $provinces = $this->entityManager
            ->getRepository(Province::class)
            ->findAll();

        $totalProvinces = count(ProvinceFixtures::PROVINCES);

        $this->assertCount($totalProvinces, $provinces);
        $this->assertProvince(1, $provinces[0]);
        $this->assertProvince($totalProvinces, $provinces[$totalProvinces-1]);
    }

    public function assertProvince(int $expectedId, Province $province)
    {
        $expectedProvince = ProvinceFixtures::PROVINCES[$expectedId - 1];

        $this->assertSame($expectedId, $province->getId());
        $this->assertSame($expectedProvince[0], $province->getCode());
        $this->assertSame($expectedProvince[1], $province->getName());
    }
}
