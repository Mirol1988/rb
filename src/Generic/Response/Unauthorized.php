<?php

namespace Rb\Generic\Response;

class Unauthorized extends FailedWithOptionalError
{
    public function code(): int
    {
        return 401;
    }

    public function defaultErrorText(): string
    {
        return 'Unauthorized';
    }
}