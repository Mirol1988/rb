<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage\S3;

use Aws\S3\S3Client;
use Aws\S3\S3ClientInterface;

abstract class S3 implements S3Interface
{
    private ?S3ClientInterface $s3Client = null;

    public function client(): S3ClientInterface
    {
        if (is_null($this->s3Client)) {
            $this->s3Client =
                new S3Client([
                    'version' => 'latest',
                    'region' => 'us-east-1',
                    'signatureVersion' => 'v2',
                    'credentials' => [
                        'key' => $this->S3AccessKey(),
                        'secret' => $this->S3SecretKey(),
                    ],
                    'endpoint' => $this->S3Url()
                ]);
        }

        return $this->s3Client;
    }

    public function bucket(): string
    {
        return $this->S3Bucket();
    }

    abstract protected function S3Url(): string;
    abstract protected function S3Bucket(): string;
    abstract protected function S3AccessKey(): string;
    abstract protected function S3SecretKey(): string;
}