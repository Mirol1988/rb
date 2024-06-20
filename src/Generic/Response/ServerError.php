<?php

namespace Rb\Generic\Response;

class ServerError extends FailedWithOptionalError
{
    public function code(): int
    {
        return 500;
    }

    public function defaultErrorText(): string
    {
        return 'Internal Server Error';
    }
}