<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Database;

use Rb\Infrastructure\Application\Database;
use Rb\Infrastructure\Environment\Env;

class Mysql implements Database
{
    public function value(): array
    {
        return [
            'class' => 'yii\db\Connection',
            'dsn' =>
                sprintf(
                    'mysql:host=%s;port=%s;dbname=%s',
                    (new Env('MYSQL_HOST'))->value(),
                    (new Env('MYSQL_PORT'))->value(),
                    (new Env('MTSQL_DATABASE'))->value(),
                ),
            'username' => (new Env('MYSQL_USER'))->value(),
            'password' => (new Env('MYSQL_PASSWORD'))->value(),
            'charset' => 'utf8mb4',
        ];
    }
}