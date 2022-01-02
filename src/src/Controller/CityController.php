<?php

namespace App\Controller;

use App\Paginator\JsonResponsePaginator;
use App\Repository\CityRepository;
use App\Repository\StreetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CityController extends AbstractController
{
    public function __construct(
        private CityRepository $cityRepository,
        private StreetRepository $streetRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/city/{cityCode}/street', name: 'city_street')]
    public function findCityStreets(
        Request $request,
        string $cityCode
    ): Response {
        $city = $this->cityRepository->findOneBy([
            'code' => $cityCode
        ]);

        if (is_null($city)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        $paginator = $this->streetRepository->findByCityCode(
            $cityCode,
            $request->query->get('page'),
            $request->query->get('pageSize')
        );

        $data = $this->serializer->serialize(
            $paginator->getItems(),
            'json',
            ['groups' => ['street', 'thoroughfare']]
        );

        return new JsonResponsePaginator($data, $paginator);
    }
}
