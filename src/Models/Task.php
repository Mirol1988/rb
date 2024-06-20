<?php

declare(strict_types=1);

namespace Rb\Models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $due_date
 * @property string $status
 * @property string $priority
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_deleted
 */
class Task extends ActiveRecord
{
    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return 'task';
    }
}