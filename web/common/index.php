<?php

declare(strict_types=1);

use Rb\Infrastructure\Application\Database\MariaDb;
use Rb\Infrastructure\Application\Language\Russian;
use Rb\Infrastructure\Application\Web;
use Rb\Infrastructure\Application\Config\Html;
use Rb\Infrastructure\Application\System\Common;
use Rb\Routes\Common as CommonRoutes;

require_once __DIR__ . '/../bootstrap.php';

(new Web(
    new Html(
        new Common(),
        new MariaDb(),
        new Russian(),
        new CommonRoutes()
    )
))
    ->application()
    ->run();
