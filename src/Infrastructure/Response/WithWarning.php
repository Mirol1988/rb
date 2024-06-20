<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Response;

use Rb\Generic\Response;
use Rb\Generic\Response\Pagination;
use Yii;

class WithWarning implements Response
{
    private Response $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function code(): int
    {
        return $this->response->code();
    }

    public function isSuccessful(): bool
    {
        return $this->response->isSuccessful();
    }

    public function payload(): array
    {
        if (!$this->response->isSuccessful()) {
            Yii::warning($this->response->payload());
        }

        return $this->response->payload();
    }

    public function pagination(): Pagination
    {
        return $this->response->pagination();
    }
}