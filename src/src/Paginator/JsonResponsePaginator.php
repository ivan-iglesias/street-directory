<?php

namespace App\Paginator;

use Symfony\Component\HttpFoundation\JsonResponse;

class JsonResponsePaginator extends JsonResponse
{
    public function __construct(
        string $serializedData,
        Paginator $paginator,
        int $status = JsonResponse::HTTP_OK,
        array $headers = []
    ) {
        $headers = array_merge($headers, [
            'Total-Items' => $paginator->getTotalItems(),
            'Total-Pages' => $paginator->getTotalPages(),
        ]);

        parent::__construct($serializedData, $status, $headers, true);
    }
}
