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
    public function find_by_street_uuid_should_return_a_paginator(): void
    {
        $paginator = $this->repository->findByStreetUuid('7fbe27e3-0b58-48dd-8ba3-8cd23df30105', null, null);

        $this->assertInstanceOf(Paginator::class, $paginator);
    }
}
