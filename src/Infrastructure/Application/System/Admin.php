<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\System;

use Rb\Infrastructure\Application\System;

class Admin implements System
{
    public function name(): string
    {
        return 'Admin';
    }

    public function controllerNamespace(): string
    {
        return 'Rb\Controller\Admin';
    }
}