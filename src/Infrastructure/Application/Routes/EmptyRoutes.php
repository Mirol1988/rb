<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Routes;

use Rb\Infrastructure\Application\Routes;

class EmptyRoutes implements Routes
{
    public function value(): array
    {
        return [];
    }
}