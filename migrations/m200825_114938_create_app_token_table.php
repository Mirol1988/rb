<?php

use Rb\Infrastructure\Application\Database\MigrationUbetDb;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%app_token}}`.
 */
class m200825_114938_create_app_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
        $this->createTable('{{%app_token}}', [
            'token' => $this->string(255),
            'application' => $this->string(255),
            'created_at' => $this->dateTime(3),
            'PRIMARY KEY (token)',
        ],
            'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );

        $this->insert('{{%app_token}}', [
            'token' => 'GZWWFFDw',
            'application' => 'frontend',
        ]);
        } catch (Throwable $exception) {}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%app_token}}');
    }
}
