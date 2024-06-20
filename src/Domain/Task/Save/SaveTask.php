<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Save;

use Rb\Domain\Task\Task;
use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Generic\Result\Successful;
use Yii;
use Rb\Models\Task as TaskModel;

class SaveTask implements Task
{
    public function __construct(
        private Task $task,
    )
    {
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

        if(!$taskValue->save()) {
            Yii::warning($taskValue->getErrorSummary(true));
            return new Failed($taskValue->getErrorSummary(true));
        }

        $taskValue->refresh();

        return new Successful([$taskValue]);
    }

}