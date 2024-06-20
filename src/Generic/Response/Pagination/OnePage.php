<?php

declare(strict_types=1);

namespace Rb\Generic\Response\Pagination;

use Rb\Generic\Response\Pagination;

class OnePage implements Pagination
{
    private int $total;

    public function __construct(int $total)
    {
        $this->total = $total;
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
        return $this->total;
    }

    public function page(): int
    {
        return 1;
    }

    public function pages(): int
    {
        return 1;
    }
}