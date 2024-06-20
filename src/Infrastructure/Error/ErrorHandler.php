<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Error;

use Exception;

class ErrorHandler
{
    public function set(): void
    {
        set_error_handler(
            function ($errno, $errstr) {
                throw new Exception($errstr, 0);
            },
            E_ALL
        );
    }
}