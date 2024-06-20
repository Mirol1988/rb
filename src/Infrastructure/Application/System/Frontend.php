<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\System;

use Rb\Infrastructure\Application\System;

class Frontend implements System
{
    public function name(): string
    {
        return 'Frontend';
    }

    public function controllerNamespace(): string
    {
        return '\Rb\Controller\Frontend';
    }
}