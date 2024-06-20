<?php

declare(strict_types=1);

namespace Rb\Tests\Infrastructure\Seeder;

use yii\db\ActiveRecord;

class Seeder
{
    private array $rows;
    private ActiveRecord $activeRecord;

    public function __construct(ActiveRecord $activeRecord, array $rows)
    {
        $this->rows = $rows;
        $this->activeRecord = $activeRecord;
    }

    public function seed(): void
    {
        foreach ($this->rows as $row) {
            $record = clone $this->activeRecord;
            foreach ($row as $name => $value) {
                $record->$name = $value;
            }

            $record->save();
        }
    }
}