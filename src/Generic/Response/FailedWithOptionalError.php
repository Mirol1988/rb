<?php

namespace Rb\Generic\Response;

use Rb\Generic\Response;
use Rb\Generic\Response\Pagination\NoPagination;

abstract class FailedWithOptionalError implements Response
{
    protected ?array $error;
    public function __construct(array $error = null)
    {
        $this->error = $error;
    }

    abstract public function code(): int;
    abstract public function defaultErrorText(): string;

    public function isSuccessful(): bool
    {
        return false;
    }

    public function payload(): array
    {
        return $this->error ?? [$this->defaultErrorText()];
    }

    public function pagination(): Pagination
    {
        return new NoPagination();
    }
}