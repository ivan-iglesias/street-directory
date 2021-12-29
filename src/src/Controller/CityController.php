<?php

namespace App\Controller;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CityController extends AbstractController
{
    private CityRepository $repository;
    private SerializerInterface $serializer;

    public function __construct(
        CityRepository $repository,
        SerializerInterface $serializer
    ) {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    #[Route('/city/{cityCode}/street', name: 'city_street')]
    public function showStreet(string $cityCode): Response
    {
        $city = $this->repository->findOneBy(['code' => $cityCode]);

        if (is_null($city)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializer->serialize(
            $city->getStreets(),
            'json',
            ['groups' => ['street', 'thoroughfare']]
        );

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
