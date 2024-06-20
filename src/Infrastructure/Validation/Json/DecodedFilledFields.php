<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Validation\Json;

use yii\helpers\Json;

class DecodedFilledFields
{
    private ?string $json;
    private array $fields;

    public function __construct(?string $json, array $fields)
    {
        $this->json = $json;
        $this->fields = $fields;
    }

    public function value(): array
    {
        $decodedJson = Json::decode($this->json, true);

        return $this->filledFields($decodedJson, $this->fields);
    }

    private function filledFields(array $data, array $fields): array
    {
        $result = [];

        foreach ($fields as $key => $field) {
            if (is_string($key)) {
                $result[$key] = $this->filledFields($data[$key] ?? [], $field);
            } else {
                $result[$field] = $data[$field] ?? null;
            }
        }

        return $result;
    }
}