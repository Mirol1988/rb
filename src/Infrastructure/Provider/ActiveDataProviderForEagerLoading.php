<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Provider;

use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider as YiiActiveDataProvider;
use yii\db\QueryInterface;

class ActiveDataProviderForEagerLoading extends YiiActiveDataProvider
{
    public ?array $selectForTotalCount;

    /**
     * {@inheritdoc}
     */
    protected function prepareTotalCount()
    {
        if (!$this->query instanceof QueryInterface) {
            throw new InvalidConfigException('The "query" property must be an instance of a class that implements the QueryInterface e.g. yii\db\Query or its subclasses.');
        }
        $query = clone $this->query;
        $query = $query->distinct()->limit(-1)->offset(-1)->orderBy([]);
        if (!empty($this->selectForTotalCount)) {
            $query->select($this->selectForTotalCount);
        }

        return (int) $query->count('*', $this->db);
    }

    /**
     * {@inheritdoc}
     */
    protected function prepareModels()
    {
        if (!$this->query instanceof QueryInterface) {
            throw new InvalidConfigException('The "query" property must be an instance of a class that implements the QueryInterface e.g. yii\db\Query or its subclasses.');
        }
        $query = clone $this->query;
        if (($pagination = $this->getPagination()) !== false) {
            $pagination->totalCount = $this->getTotalCount();
            if ($pagination->totalCount === 0) {
                return [];
            }
            $query->distinct()->limit($pagination->getLimit())->offset($pagination->getOffset());
        }
        if (($sort = $this->getSort()) !== false) {
            $query->addOrderBy($sort->getOrders());
        }

        return $query->all($this->db);
    }
}