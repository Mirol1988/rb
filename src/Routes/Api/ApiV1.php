<?php

declare(strict_types=1);

namespace Rb\Routes\Api;

use Rb\Infrastructure\Application\Routes;

class ApiV1 implements Routes
{
    public function value(): array
    {
        return [
            'GET,OPTIONS /api/v1/version' => 'site/version',

            'POST,OPTIONS /api/v1/tasks' => 'task/create',
            'PUT,OPTIONS /api/v1/tasks/<id:[\w-]+>' => 'task/update',
            'GET,OPTIONS /api/v1/tasks/<id:[\w-]+>' => 'task/view',
            'GET,OPTIONS /api/v1/tasks' => 'task/list',
            'DELETE,OPTIONS /api/v1/tasks/<id:[\w-]+>' => 'task/deleted',

            'GET,OPTIONS /api/v1/statuses' => 'status/list',

            'GET,OPTIONS /api/v1/priorities' => 'priority/list',
        ];
    }
}