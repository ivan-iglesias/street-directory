<?php

namespace App\Controller;

use App\Repository\StreetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class StreetController extends AbstractController
{
    private StreetRepository $repository;
    private SerializerInterface $serializer;

    public function __construct(
        StreetRepository $repository,
        SerializerInterface $serializer
    ) {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    #[Route('/street/{streetId}/portal', name: 'street_portal')]
    public function showStreet(string $streetId): Response
    {
        $city = $this->repository->find($streetId);

        if (is_null($city)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        $data = $this->serializer->serialize(
            $city->getPortals(),
            'json',
            ['groups' => ['portal']]
        );

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
