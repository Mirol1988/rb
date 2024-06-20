<?php

namespace Rb\Generic\Response;

class Forbidden extends FailedWithOptionalError
{
    public function code(): int
    {
        return 403;
    }

    public function defaultErrorText(): string
    {
        return 'Forbidden';
    }
}