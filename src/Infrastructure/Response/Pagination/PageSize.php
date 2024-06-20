<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Response\Pagination;

interface PageSize
{
    public function value() : int;
}