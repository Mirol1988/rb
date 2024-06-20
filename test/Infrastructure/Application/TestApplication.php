<?php

declare(strict_types=1);

namespace Rb\Tests\Infrastructure\Application;

use Rb\Infrastructure\Application;
use Rb\Infrastructure\Application\Database\MariaDb;
use Rb\Infrastructure\Application\Language\English;
use Rb\Tests\Infrastructure\Application\Config\TestConfig;
use Rb\Tests\Infrastructure\Transport\FakeTransport;
use Yii;
use yii\base\Application as BaseApplication;
use yii\web\Application as WebApplication;

class TestApplication implements Application
{
	public function application(): BaseApplication
	{
        $application =
            new WebApplication(
              (new TestConfig(
                  new MariaDb(),
                  new English()
              ))
                  ->value()
            );


        /*Yii::$container->setSingleton(
            'transport',
            new FakeTransport()
        );

        Yii::$container->setSingleton(
            'cachedTransport',
            new FakeTransport()
        );*/

        return $application;
	}
}