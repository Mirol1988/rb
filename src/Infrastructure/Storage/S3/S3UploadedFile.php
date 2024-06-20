<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage\S3;

use Exception;
use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Generic\Result\Successful;
use Yii;

class S3UploadedFile
{
    private S3Interface $s3;
    private string $sourcePath;
    private string $targetPath;

    public function __construct(S3Interface $s3, string $sourcePath, string $targetPath)
    {
        $this->s3 = $s3;
        $this->sourcePath = $sourcePath;
        $this->targetPath = $targetPath;
    }

    public function result(): Result
    {
        try {
            $this->s3->client()->putObject(
                [
                    'Bucket' => $this->s3->bucket(),
                    'Key' => $this->targetPath,
                    'SourceFile' => $this->sourcePath,
                    'StorageClass' => 'REDUCED_REDUNDANCY',
                ]
            );
        } catch (Exception $exception) {
            Yii::error('S3: ' . $exception->getMessage());
            return new Failed([/*'File upload error to S3'*/ $exception->getMessage()]);
        }

        return new Successful([]);
    }
}