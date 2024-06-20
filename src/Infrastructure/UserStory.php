<?php

declare(strict_types=1);

namespace Rb\Infrastructure;

use Rb\Generic\Response;

interface UserStory
{
    public function response(): Response;
}