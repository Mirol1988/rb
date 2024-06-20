<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\CreateTask\Validation;

use Rb\Domain\Task\Priority\PriorityHigh;
use Rb\Domain\Task\Priority\PriorityLow;
use Rb\Domain\Task\Priority\PriorityMedium;
use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Infrastructure\Validation\JsonValidator;
use Rb\Infrastructure\Validation\Validatable;
use Rb\Infrastructure\Validation\Verifica\Verifica;
use yii\base\DynamicModel;
use yii\helpers\Json;

class ValidatedCreateTaskCommand implements Validatable
{
    public function __construct(
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

        $validator = new Verifica($values);

        $validator
            ->rule('required', ['title', 'description', 'due_date', 'priority'])
            ->rule('string', ['title', 'description', 'due_date'])
            ->rule('in', 'priority',
                [(new PriorityLow())->id(), (new PriorityMedium())->id(), (new PriorityHigh())->id()]);

        $validator->stopOnFirstFail();

        return $validator->result();
    }
}