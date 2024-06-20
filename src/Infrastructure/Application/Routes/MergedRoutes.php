<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Routes;

use Rb\Infrastructure\Application\Routes;

class MergedRoutes implements Routes
{
    private array $routes;

    public function __construct(Routes ...$routes)
    {
        $this->routes = $routes;
    }

    public function value(): array
    {
        return
            array_reduce(
                $this->routes,
                fn (array $carry, Routes $routes) => array_merge($carry, $routes->value()),
                []
            );
    }
}