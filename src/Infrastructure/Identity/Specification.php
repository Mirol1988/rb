<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Identity;

interface Specification
{
    public function isSatisfied(): bool;
}