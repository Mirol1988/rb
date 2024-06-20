<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Url;

use yii\helpers\Inflector;

class CreateUrlPart
{
    public function __construct(
        private int $id,
        private ?string $name,
    ) {
    }

    public function value(): string
    {
        if (empty($this->name)) {
            return (string)$this->id;
        }

        return
            substr(
                Inflector::slug($this->name),
                0,
                500
            );
    }
}