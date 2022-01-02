<?php

namespace App\Tests\Integration\Repository;

use App\Entity\Street;
use App\Paginator\Paginator;

class StreetRepositoryTest extends RepositoryTest
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository(Street::class);
    }

    /** @test */
    public function find_by_city_code_should_return_a_paginator(): void
    {
        $paginator = $this->repository->findByCityCode('48020', null, null);

        $this->assertInstanceOf(Paginator::class, $paginator);
    }
}
