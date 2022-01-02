<?php

namespace App\Tests\Integration\Repository;

use App\Entity\Province;
use App\Paginator\Paginator;

class ProvinceRepositoryTest extends RepositoryTest
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository(Province::class);
    }

    /** @test */
    public function find_all_should_return_a_paginator(): void
    {
        $paginator = $this->repository->findAllPaginate(null, null);

        $this->assertInstanceOf(Paginator::class, $paginator);
    }
}
