<?php

use Rb\Infrastructure\Application\Database\MigrationUbetDb;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%app_token}}`.
 */
class m240620_161138_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function safeUp()
    {
        $this->createTable(
            '{{%task}}',
            [
                'id' => $this->string(36),
                'title' => $this->string(255),
                'description' => $this->text()->defaultValue(null),
                'due_date' => $this->dateTime(3),
                'status' => $this->tinyInteger(1),
                'priority' => $this->tinyInteger(1),
                'created_at' => $this->dateTime(3),
                'updated_at' => $this->dateTime(3),
                'is_deleted' => $this->tinyInteger()->defaultValue(0),
                'PRIMARY KEY (id)',
            ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

        $this->alterColumn(
            'task',
            'status',
            "ENUM('new', 'in_progress', 'return', 'finish', 'cancel') DEFAULT 'new'"
        );

        $this->alterColumn(
            'task',
            'priority',
            "ENUM('low', 'medium', 'high') DEFAULT 'low'"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%app_token}}');
    }
}
