<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Validation;

use Rb\Generic\Result;

interface Validatable
{
    public function result(): Result;
}