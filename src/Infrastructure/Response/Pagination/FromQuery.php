<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Response\Pagination;

use Rb\Generic\Response\Pagination;
use Rb\Infrastructure\Response\Pagination\PageSize\DefaultApiPageSize;
use Yii;
use yii\db\QueryInterface;

class FromQuery implements Pagination
{
    private int $total;
    private int $perPage;
    private int $page;

    public function __construct(QueryInterface $query)
    {
        $this->total = (int)$query->count();

        $this->perPage =
            Yii::$app->request->get('per-page')
                ? (int)Yii::$app->request->get('per-page')
                :  (new DefaultApiPageSize())->value();

        $this->page =
            Yii::$app->request->get('page')
                ? (int)Yii::$app->request->get('page')
                : 1;
    }

    public function isUsed(): bool
    {
        return true;
    }

    public function total(): int
    {
        return $this->total;
    }

    public function perPage(): int
    {
        return $this->perPage;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function pages(): int
    {
        return (int)ceil($this->total / $this->perPage);
    }
}