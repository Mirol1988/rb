<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage\S3;

use Aws\S3\MultipartUploader;
use Exception;
use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Generic\Result\Successful;
use Yii;

class S3MultipartUploadedFile
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
        $uploader =
            new MultipartUploader(
                $this->s3->client(),
                $this->sourcePath,
                [
                    'Bucket' => $this->s3->bucket(),
                    'Key' => $this->targetPath,
                ]
            );

        try {
            $uploader->upload();
        } catch (Exception $exception) {
            Yii::error('S3: ' . $exception->getMessage());

            return new Failed(['File upload error to S3']);
        }

        return new Successful([]);
    }
}