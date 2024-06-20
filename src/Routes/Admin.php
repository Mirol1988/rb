<?php

declare(strict_types=1);

namespace Rb\Routes;

use Rb\Infrastructure\Application\Routes;

class Admin implements Routes
{
    public function value(): array
    {
        return [
            // OPTIONS need for CORS requests
            'GET /admin/version' => 'site/version',
            'GET /admin/test' => 'site/test',
        ];
    }
}