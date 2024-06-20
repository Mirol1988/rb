<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Validation;

use yii\base\Model;
use yii\helpers\Json;
use yii\validators\Validator;
use Exception;
use yii\helpers\StringHelper;

class JsonValidator extends Validator
{
    /**
     * Validates a single attribute.
     * @param Model $model the data model to be validated
     * @param string $attribute the name of the attribute to be validated.
     */
    public function validateAttribute($model, $attribute)
    {
        $result = $this->validateValue($model->$attribute);

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
        try {
            Json::decode($value);

            return null;
        } catch (Exception $e) {
            return [
                '{attribute}=`' . StringHelper::truncate($value, 45) . '` is not a valid JSON.',
                ['value' => $value]
            ];
        }
    }
}