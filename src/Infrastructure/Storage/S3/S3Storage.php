<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage\S3;

use Rb\Infrastructure\Storage\Storage;
use Yii;
use yii\web\Response;

abstract class S3Storage implements Storage
{
    private S3Interface $s3;
    private string $filePath;

    public function __construct(S3Interface $s3, string $filePath)
    {
        $this->s3 = $s3;
        $this->filePath = $filePath;
    }

    public function fileExists(): bool
    {
        return
            $this->s3->client()->doesObjectExist(
                $this->s3->bucket(),
                $this->filePath
            );
    }

    public function file(): Response
    {
        $result =
            $this->s3->client()->getObject([
                'Bucket' => $this->s3->bucket(),
                'Key' => $this->filePath,
            ]);

        return
            Yii::$app->response->sendContentAsFile(
                $result->get('Body'),
                basename($this->filePath)
            );
    }
}