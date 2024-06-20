<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Response\Pagination\PageSize;

use Rb\Infrastructure\Response\Pagination\PageSize;

class DefaultApiPageSize implements PageSize
{
    public function value(): int
    {
        return 20;
    }
}