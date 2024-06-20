<?php

declare(strict_types=1);

namespace Rb\Generic\Response\Pagination\PageSize;

class DefaultPageSize
{
    public function value(): int
    {
        return 20;
    }
}