<?php

namespace Rb\Generic\Response;

use Rb\Generic\Response;

class NotFound extends FailedWithOptionalError
{
    public function code(): int
    {
        return 404;
    }

    public function defaultErrorText(): string
    {
        return 'Not Found';
    }
}