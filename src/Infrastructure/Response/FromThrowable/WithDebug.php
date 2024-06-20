<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Response\FromThrowable;

use Rb\Infrastructure\Response\FromThrowable;

class WithDebug extends FromThrowable
{
    public function payload(): array
    {
        return
            [
                'message' => $this->throwable->getMessage(),
                'file' => $this->throwable->getFile(),
                'line' => $this->throwable->getLine(),
                'trace' => $this->throwable->gettrace(),
            ];
    }
}