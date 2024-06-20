<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\ViewTask\Validation;

use Rb\Generic\Result;
use Rb\Infrastructure\Validation\Validatable;
use Rb\Infrastructure\Validation\Verifica\ExistsValidator;
use Rb\Infrastructure\Validation\Verifica\Verifica;
use Rb\Models\Task;

class ValidatedViewTaskCommand implements Validatable
{
    public function __construct(private string $id)
    {
    }

    public function result(): Result
    {
        $validator = new Verifica(['id' => $this->id]);

        $validator
            ->rule('required', 'id')
            ->rule('uuid', 'id')
            ->rule('string', 'id')
            ->rule(new ExistsValidator(Task::class), 'id');

        $validator->stopOnFirstFail();

        return $validator->result();
    }
}
