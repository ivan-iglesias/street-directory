<?php

namespace App\Tests\Integration\Repository;

use App\Entity\City;
use App\Paginator\Paginator;

class CityRepositoryTest extends RepositoryTest
{
    private $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->getRepository(City::class);
    }

    /** @test */
    public function find_by_province_code_should_return_a_paginator(): void
    {
        $paginator = $this->repository->findByProvinceCode('48', null, null);

        $this->assertInstanceOf(Paginator::class, $paginator);
    }
}
