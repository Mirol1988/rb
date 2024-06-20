<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Save;

use Rb\Domain\Task\Task;
use Rb\Generic\Result;
use Rb\Generic\Result\Successful;
use Rb\Models\Task as TaskModel;
use Yii;

class WithCache implements Task
{
    public function __construct(
        private Task $task,
    ) {
    }

    public function result(): Result
    {
        $taskResult = $this->task->result();

        if (!$taskResult->isSuccessful()) {
            Yii::warning($taskResult->error());
            return $taskResult;
        }

        /* @var $taskValue TaskModel */
        $taskValue = $taskResult->value()[0];

        $data = Yii::$app->cache->set(
            $taskValue->id,
            [
                'title' => $taskValue->title,
                'description' => $taskValue->description,
                'due_date' => $taskValue->due_date,
                'status' => $taskValue->status,
                'priority' => $taskValue->priority,
                'is_deleted' => $taskValue->is_deleted,
            ]
        );

        return new Successful([$data]);
    }

}