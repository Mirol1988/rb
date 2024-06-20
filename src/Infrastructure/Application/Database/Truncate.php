<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Database;

use Yii;

class Truncate
{
    private array $tables;

    public function __construct(string ...$tables)
    {
        $this->tables = $tables;
    }

    public function run ()
	{
		Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();

        foreach ($this->tables as $table) {
            Yii::$app->db->createCommand('DELETE FROM ' . $table)->execute();
        }

		Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();
	}
}