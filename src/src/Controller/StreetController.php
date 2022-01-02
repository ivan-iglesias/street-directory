<?php

namespace App\Controller;

use App\Paginator\JsonResponsePaginator;
use App\Repository\PortalRepository;
use App\Repository\StreetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class StreetController extends AbstractController
{
    public function __construct(
        private StreetRepository $streetRepository,
        private PortalRepository $portalRepository,
        private SerializerInterface $serializer
    ) {
    }

    #[Route('/street/{uuid}/portal', name: 'street_portal')]
    public function findStreetPortals(Request $request, string $uuid): Response
    {
        $street = $this->streetRepository->findOneBy([
            'uuid' => $uuid
        ]);

        if (is_null($street)) {
            return $this->json(null, Response::HTTP_NOT_FOUND);
        }

        $paginator = $this->portalRepository->findByStreetUuid(
            $uuid,
            $request->query->get('page'),
            $request->query->get('pageSize')
        );

        $data = $this->serializer->serialize(
            $paginator->getItems(),
            'json',
            ['groups' => ['portal']]
        );

        return new JsonResponsePaginator($data, $paginator);
    }
}
