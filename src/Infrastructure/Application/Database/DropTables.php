<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Database;

use yii\db\Connection;
use yii\db\Exception;
use yii\db\mssql\PDO;

class DropTables
{
    private Connection $connection;

    public function __construct (Connection $connection)
    {
        $this->connection = $connection;
    }

    public function run ()
    {
        $this->connection->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();

        $tablesAndViews = $this->connection->createCommand('SHOW FULL TABLES')->queryAll(PDO::FETCH_NUM);

        foreach ($tablesAndViews as list($name, $type))
        {
            switch ($type) {
                case 'VIEW':
                    $this->connection->createCommand()->dropView($name)->execute();
                    break;

                case 'BASE TABLE':
                    $this->connection->createCommand()->dropTable($name)->execute();
                    break;

                default:
                    throw new Exception('Undefined type was appeared in tables list');
            }
        }

        $this->connection->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();
    }
}