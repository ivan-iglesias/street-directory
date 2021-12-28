<?php

namespace App\Controller;

use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProvinceController extends AbstractController
{
    private ProvinceRepository $repository;
    private SerializerInterface $serializer;

    public function __construct(
        ProvinceRepository $repository,
        SerializerInterface $serializer
    ) {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    #[Route('/province', name: 'province_index')]
    public function index(): Response
    {
        $provinces = $this->repository->findAll();

        $data = $this->serializer->serialize(
            $provinces,
            'json',
            ['groups' => ['province']]
        );

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route('/province/{name}', name: 'province_show')]
    public function show(string $name): Response
    {
        $province = $this->repository->findOneBy(['name' => $name]);

        if (is_null($province)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializer->serialize(
            $province,
            'json',
            ['groups' => ['province', 'province_detail', 'city']]
        );

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
