<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\ViewTaskList;

use Rb\Generic\Response;
use Rb\Generic\Response\Ok;
use Rb\Infrastructure\Response\Pagination\FromDataProvider;
use Rb\Infrastructure\UserStory;
use Rb\Models\Task;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class ViewTaskList implements UserStory
{
    public function response(): Response
    {
        $provider = $this->provider(Task::find());

        return
            new Ok($provider->models, new FromDataProvider($provider));
    }

    private function provider($query): ActiveDataProvider
    {
        return
            new ActiveDataProvider([
                'query' => $query,
                'pagination' => new Pagination([
                    'defaultPageSize' => 20,
                    'pageSizeParam' => 'per_page'
                ]),
                'sort' => [
                    'defaultOrder' => [
                        'title' => SORT_ASC,
                    ],
                    'attributes' => [
                        'title',
                    ],
                ]
            ]);
    }
}