<?php

namespace App\Tests\Integration\Repository;

use App\Entity\Portal;
use App\Paginator\Paginator;

class PortalRepositoryTest extends RepositoryTest
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository(Portal::class);
    }

    /** @test */
    public function find_by_street_id_should_return_a_paginator(): void
    {
        $paginator = $this->repository->findByStreetId(10, null, null);

        $this->assertInstanceOf(Paginator::class, $paginator);
    }
}
