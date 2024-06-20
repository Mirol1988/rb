<?php

namespace Rb\Generic\Response;

use Rb\Generic\Response;
use Rb\Generic\Response\Pagination\NoPagination;

abstract class Successful implements Response
{
    private ?array $payload;
    private Pagination $pagination;

    public function __construct(array $payload = null, Pagination $pagination = null,)
    {
        $this->payload = $payload;
        $this->pagination = $pagination ?? new NoPagination();
    }

    abstract public function code(): int;
    abstract public function defaultText(): string;

    public function isSuccessful(): bool
    {
        return true;
    }

    public function payload(): array
    {
        return $this->payload ?? [$this->defaultText()];
    }

    public function pagination(): Pagination
    {
        return $this->pagination;
    }
}