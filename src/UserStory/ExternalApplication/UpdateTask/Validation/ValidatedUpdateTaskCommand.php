<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\UpdateTask\Validation;

use Rb\Domain\Task\Priority\PriorityHigh;
use Rb\Domain\Task\Priority\PriorityLow;
use Rb\Domain\Task\Priority\PriorityMedium;
use Rb\Domain\Task\Status\TaskCancel;
use Rb\Domain\Task\Status\TaskFinish;
use Rb\Domain\Task\Status\TaskInProgress;
use Rb\Domain\Task\Status\TaskNew;
use Rb\Domain\Task\Status\TaskReturn;
use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Infrastructure\Validation\JsonValidator;
use Rb\Infrastructure\Validation\Validatable;
use Rb\Infrastructure\Validation\Verifica\ExistsValidator;
use Rb\Infrastructure\Validation\Verifica\Verifica;
use Rb\Models\Task;
use yii\base\DynamicModel;
use yii\helpers\Json;

class ValidatedUpdateTaskCommand implements Validatable
{
    public function __construct(
        private string $id,
        private ?string $json,
    ) {
    }

    public function result(): Result
    {
        $bodyValidation = new DynamicModel(['body' => $this->json]);
        $bodyValidation
            ->addRule(['body'], JsonValidator::class)
            ->validate();

        if ($bodyValidation->hasErrors()) {
            return new Failed($bodyValidation->getErrors());
        }

        $values = Json::decode($this->json);
        $values['id'] = $this->id;

        $validator = new Verifica($values);

        $validator
            ->rule('required', ['id', 'title', 'description', 'due_date', 'priority', 'status'])
            ->rule('string', ['id', 'title', 'description', 'due_date', 'status'])
            ->rule('uuid', 'id')
            ->rule(new ExistsValidator(Task::class), 'id')
            ->rule('in', 'priority',
                [(new PriorityLow())->id(), (new PriorityMedium())->id(), (new PriorityHigh())->id()])
            ->rule('in', 'status',
                [
                    (new TaskNew())->id(),
                    (new TaskInProgress())->id(),
                    (new TaskFinish())->id(),
                    (new TaskCancel())->id(),
                    (new TaskReturn())->id()
                ]);

        $validator->stopOnFirstFail();

        return $validator->result();
    }
}