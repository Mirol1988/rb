<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\System;

use Rb\Infrastructure\Application\System;

class ApiV1 implements System
{
    public function name(): string
    {
        return 'Api';
    }

    public function controllerNamespace(): string
    {
        return '\Rb\Controller\Api\V1';
    }
}