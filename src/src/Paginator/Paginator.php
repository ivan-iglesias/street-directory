<?php

namespace App\Paginator;

use Doctrine\ORM\QueryBuilder;

abstract class Paginator
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PAGE_SIZE = 24;

    protected int $pageSize;
    protected int $currentPage;

    protected function setPageSize(?int $pageSize): void
    {
        $this->pageSize = (is_null($pageSize) || $pageSize < 1)
            ? self::DEFAULT_PAGE_SIZE
            : $pageSize;
    }

    protected function setCurrentPage(?int $page): void
    {
        $this->currentPage = (is_null($page) || $page < 1)
            ? self::DEFAULT_PAGE
            : $page;
    }

    abstract public function paginate(
        QueryBuilder $queryBuilder,
        ?int $page,
        ?int $pageSize
    ): void;

    abstract public function isPageOutOfRange(): bool;
    abstract public function getTotalPages(): int;
    abstract public function getTotalItems(): int;
    abstract public function getItems(): array;
}
