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

    #[Route('/province', name: 'province')]
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

    #[Route('/province/{provinceCode}/city', name: 'province_city')]
    public function show(string $provinceCode): Response
    {
        $province = $this->repository->findOneBy(['code' => $provinceCode]);

        if (is_null($province)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializer->serialize(
            $province->getCities(),
            'json',
            ['groups' => ['city']]
        );

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
