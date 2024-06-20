<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Database;

use PDO;
use Yii;

class TruncateAll
{
	public function run ()
	{
		Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=0')->execute();

		$tables = Yii::$app->db->createCommand('SHOW FULL TABLES WHERE table_type = \'BASE TABLE\'')->queryAll(PDO::FETCH_NUM);

        foreach ($tables as list($table)) {
            if (!in_array($table, $this->excludedTables())) {
                Yii::$app->db->createCommand('DELETE FROM ' . $table)->execute();
            }
        }

		Yii::$app->db->createCommand('SET FOREIGN_KEY_CHECKS=1')->execute();
	}

    private function excludedTables(): array
    {
        return ['_migration'];
    }
}