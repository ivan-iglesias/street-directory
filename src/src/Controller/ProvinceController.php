<?php

namespace App\Controller;

use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProvinceController extends AbstractController
{
    private ProvinceRepository $repository;

    public function __construct(ProvinceRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/province', name: 'province')]
    public function index(): Response
    {
        $provinces = $this->repository->findAll();

        return $this->json($provinces);
    }
}
