<?php

namespace App\Controller;

use App\Paginator\JsonResponsePaginator;
use App\Repository\CityRepository;
use App\Repository\ProvinceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProvinceController extends AbstractController
{
    public function __construct(
        private ProvinceRepository $provinceRepository,
        private CityRepository $cityRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/province', name: 'province')]
    public function findAll(Request $request): Response
    {
        $paginator = $this->provinceRepository->findAllPaginate(
            $request->query->get('page'),
            $request->query->get('pageSize')
        );

        $data = $this->serializer->serialize(
            $paginator->getItems(),
            'json',
            ['groups' => ['province']]
        );

        return new JsonResponsePaginator($data, $paginator);
    }

    #[Route('/province/{provinceCode}/city', name: 'province_city')]
    public function findProvinceCities(
        Request $request,
        string $provinceCode
    ): Response {
        $province = $this->provinceRepository->findOneBy([
            'code' => $provinceCode
        ]);

        if (is_null($province)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        $paginator = $this->cityRepository->findByProvinceCode(
            $provinceCode,
            $request->query->get('page'),
            $request->query->get('pageSize')
        );

        $data = $this->serializer->serialize(
            $paginator->getItems(),
            'json',
            ['groups' => ['city']]
        );

        return new JsonResponsePaginator($data, $paginator);
    }
}
