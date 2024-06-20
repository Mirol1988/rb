<?php

declare(strict_types=1);

namespace Rb\Infrastructure\UserStory;

use Rb\Generic\Response;
use Rb\Generic\Response\Forbidden;
use Rb\Infrastructure\UserStory;

class AccessForbidden implements UserStory
{
    public function response(): Response
    {
        return new Forbidden();
    }
}