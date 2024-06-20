<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Database;

use Rb\Infrastructure\Application\Database;
use Rb\Infrastructure\Environment\Env;

class MariaDb implements Database
{
    public function value(): array
    {
        return [
            'class' => 'yii\db\Connection',
            'dsn' =>
                sprintf(
                    'mysql:host=%s;port=%s;dbname=%s',
                    (new Env('MARIADB_HOST'))->value(),
                    (new Env('MARIADB_PORT'))->value(),
                    (new Env('MARIADB_DATABASE'))->value(),
                ),
            'username' => (new Env('MARIADB_USER'))->value(),
            'password' => (new Env('MARIADB_PASSWORD'))->value(),
            'charset' => 'utf8mb4',
        ];
    }
}