<?php

declare(strict_types=1);

namespace Rb\Routes;

use Rb\Infrastructure\Application\Routes;

class Common implements Routes
{
    public function value(): array
    {
        return [
            'GET /swagger/admin' => 'swagger/admin-export',
            'GET /doc/admin' => 'swagger/admin-doc',
            'GET /swagger/v1' => 'swagger/v1-export',
            'GET /doc/v1' => 'swagger/v1-doc',
            'GET /swagger/frontend' => 'swagger/frontend-export',
            'GET /doc/frontend' => 'swagger/frontend-doc',
            'GET /swagger/socket' => 'swagger/socket-export',
            'GET /doc/socket' => 'swagger/socket-doc',
        ];
    }
}