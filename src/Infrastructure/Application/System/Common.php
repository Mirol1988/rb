<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\System;

use Rb\Infrastructure\Application\System;

class Common implements System
{
    public function name(): string
    {
        return 'Common';
    }

    public function controllerNamespace(): string
    {
        return '\Rb\Controller\Common';
    }
}