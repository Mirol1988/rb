<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Response\FromThrowable;

use Rb\Infrastructure\Response\FromThrowable;

class WithEmptyPayload extends FromThrowable
{
    public function payload(): array
    {
        return [];
    }
}