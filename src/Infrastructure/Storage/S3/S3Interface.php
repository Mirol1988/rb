<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage\S3;

use Aws\S3\S3ClientInterface;

interface S3Interface
{
    public function client(): S3ClientInterface;
    public function bucket(): string;
}