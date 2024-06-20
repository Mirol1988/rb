<?php

declare(strict_types=1);

namespace Rb\Infrastructure;

use yii\base\Application as YiiApplication;

interface Application
{
	public function application(): YiiApplication;
}