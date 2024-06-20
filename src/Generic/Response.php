<?php

declare(strict_types=1);

namespace Rb\Generic;

use Rb\Generic\Response\Pagination;

interface Response
{
    public function code(): int;
    public function isSuccessful(): bool;
    public function payload(): array;
    public function pagination(): Pagination;
}