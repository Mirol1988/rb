<?php

declare(strict_types=1);

namespace Rb\Generic\Response\Pagination;

use Rb\Generic\Response\Pagination;
use Rb\Generic\Response\Pagination\PageSize\DefaultPageSize;

class DefaultPagination implements Pagination
{
    private int $total;
    private int $page;
    private int $perPage;

    public function __construct(int $total, int $page, int $perPage = null)
    {
        $this->total = $total;
        $this->page = $page;
        $this->perPage = $perPage ?? (new DefaultPageSize())->value();
    }

    public function isUsed(): bool
    {
        return true;
    }

    public function total(): int
    {
        return $this->total;
    }

    public function perPage(): int
    {
        return $this->perPage;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function pages(): int
    {
        return (int)ceil($this->total / $this->perPage);
    }

}