<?php

namespace App\Paginator;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;

class PagerfantaPaginator extends Paginator
{
    private Pagerfanta $paginator;

    public function paginate(
        QueryBuilder $queryBuilder,
        ?int $page,
        ?int $pageSize
    ): void {
        $adapter = new QueryAdapter($queryBuilder);

        $this->paginator = new Pagerfanta($adapter);

        $this->setPageSize($pageSize);
        $this->setCurrentPage($page);

        $this->paginator->setMaxPerPage($this->pageSize);

        if (!$this->isPageOutOfRange()) {
            $this->paginator->setCurrentPage($this->currentPage);
        }
    }

    public function isPageOutOfRange(): bool
    {
        return $this->currentPage > $this->getTotalPages();
    }

    public function getTotalPages(): int
    {
        if ($this->getTotalItems() === 0) {
            return 0;
        }

        return $this->paginator->getNbPages();
    }

    public function getTotalItems(): int
    {
        return $this->paginator->getNbResults();
    }

    public function getItems(): array
    {
        if ($this->isPageOutOfRange()) {
            return [];
        }

        return iterator_to_array(
            $this->paginator->getCurrentPageResults()
        );
    }
}
