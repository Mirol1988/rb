<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage\S3;

use Rb\Infrastructure\Environment\Env;

class PublicS3 extends S3
{
    protected function S3Url(): string
    {
        return (new Env('S3_PUBLIC_URL'))
            ->value();
    }

    protected function S3Bucket(): string
    {
        return (new Env('S3_PUBLIC_BUCKET'))
            ->value();
    }

    protected function S3AccessKey(): string
    {
        return (new Env('S3_PUBLIC_ACCESS_KEY'))
            ->value();
    }

    protected function S3SecretKey(): string
    {
        return (new Env('S3_PUBLIC_SECRET_KEY'))
            ->value();
    }
}