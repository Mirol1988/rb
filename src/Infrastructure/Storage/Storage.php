<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage;

use yii\web\Response;

interface Storage
{
    public function fileExists(): bool;
    public function file(): Response;
}