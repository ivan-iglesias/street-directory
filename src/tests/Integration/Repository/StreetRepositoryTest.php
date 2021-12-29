<?php

namespace App\Tests\Integration\Repository;

use App\Entity\Portal;
use App\Entity\Street;

class StreetRepositoryTest extends RepositoryTest
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository(Street::class);
    }

    public function test_should_find_a_street(): void
    {
        $street = $this->repository->find(10);

        $this->assertInstanceOf(Street::class, $street);
        $this->assertSame('Ybarra Rafaela', $street->getName());

        $portals = $street->getPortals();

        $this->assertCount(16, $portals);

        $portal = $portals[0];
        $this->assertInstanceOf(Portal::class, $portal);
        $this->assertSame(1, $portal->getNumber());
        $this->assertSame('A', $portal->getBis());
    }

    /**
     * @testWith ["XX"]
     *           ["99"]
     */
    public function test_should_not_find_a_street($streetId): void
    {
        $street = $this->repository->find($streetId);

        $this->assertNull($street);
    }
}
