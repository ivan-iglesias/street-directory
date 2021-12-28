<?php

namespace App\Tests\Integration\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class RepositoryTest extends KernelTestCase
{
    protected $entityManager;

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

    protected function getRepository(string $respositoryName): ServiceEntityRepository
    {
        return $this->entityManager->getRepository($respositoryName);
    }
}
