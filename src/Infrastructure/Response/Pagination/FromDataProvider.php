<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Response\Pagination;

use Rb\Generic\Response\Pagination;
use yii\data\DataProviderInterface;

class FromDataProvider implements Pagination
{
    private DataProviderInterface $provider;

    public function __construct(DataProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function isUsed(): bool
    {
        return true;
    }

    public function total(): int
    {
        return $this->provider->totalCount;
    }

    public function perPage(): int
    {
        return $this->provider->getPagination()->pageSize;
    }

    public function page(): int
    {
        return $this->provider->getPagination()->page + 1;
    }

    public function pages(): int
    {
        return $this->provider->getPagination()->pageCount;
    }
}