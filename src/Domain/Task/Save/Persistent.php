<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Save;

use Rb\Domain\Task\Task;
use Rb\Generic\Result;
use Rb\Generic\Result\Successful;
use Rb\Models\Task as TaskModel;

class Persistent implements Task
{
    public function __construct(
        private TaskModel $taskModel,
        private array $validateValue
    )
    {
    }

    public function result(): Result
    {
        if(array_key_exists('title', $this->validateValue)) {
            $this->taskModel->title = $this->validateValue['title'];
        }

        if(array_key_exists('description', $this->validateValue)) {
            $this->taskModel->description = $this->validateValue['description'];
        }

        if(array_key_exists('due_date', $this->validateValue)) {
            $this->taskModel->due_date = $this->validateValue['due_date'];
        }

        if(array_key_exists('status', $this->validateValue)) {
            $this->taskModel->status = $this->validateValue['status'];
        }

        if(array_key_exists('priority', $this->validateValue)) {
            $this->taskModel->priority = $this->validateValue['priority'];
        }

        if(array_key_exists('is_deleted', $this->validateValue)) {
            $this->taskModel->is_deleted = $this->validateValue['is_deleted'];
        }

        return new Successful([$this->taskModel]);
    }

}