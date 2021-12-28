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

    #[Route('/province', name: 'province_index')]
    public function index(): Response
    {
        $provinces = $this->repository->findAll();

        return $this->json($provinces);
    }

    #[Route('/province/{name}', name: 'province_show')]
    public function show(string $name): Response
    {
        $province = $this->repository->findOneBy(['name' => $name]);

        if (is_null($province)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        return $this->json($province);
    }
}
