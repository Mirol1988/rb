<?php

declare(strict_types=1);

namespace Rb\Generic\Response;

interface Pagination
{
    public function isUsed(): bool;
    public function total(): int;
    public function perPage(): int;
    public function page(): int;
    public function pages(): int;
}