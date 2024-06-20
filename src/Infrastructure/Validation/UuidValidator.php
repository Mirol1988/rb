<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Validation;

use yii\base\Model;
use yii\validators\Validator;

class UuidValidator extends Validator
{
    private string $pattern = "/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i";

    public function init()
    {
        parent::init();

        if ($this->message === null) {
            $this->message = '{attribute}=`{value}` is not a valid UUID.';
        }
    }

    /**
     * Validates a single attribute.
     * @param Model $model the data model to be validated
     * @param string $attribute the name of the attribute to be validated.
     */
    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;
        $result = $this->validateValue($value);

        if (!empty($result)) {
            $this->addError($model, $attribute, $result[0], $result[1]);
        }
    }

    /**
     * Validates a value.
     * @param mixed $value the data value to be validated.
     * @return array|null the error message and the parameters to be inserted into the error message.
     */
    protected function validateValue($value)
    {
        if (preg_match($this->pattern, $value)) {
            return null;
        }

        return [$this->message, ['value' => $value]];
    }
}