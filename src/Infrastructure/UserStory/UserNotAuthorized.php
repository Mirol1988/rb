<?php

declare(strict_types=1);

namespace Rb\Infrastructure\UserStory;

use Rb\Generic\Response;
use Rb\Generic\Response\Unauthorized;
use Rb\Infrastructure\UserStory;

class UserNotAuthorized implements UserStory
{
    public function response(): Response
    {
        return new Unauthorized();
    }
}