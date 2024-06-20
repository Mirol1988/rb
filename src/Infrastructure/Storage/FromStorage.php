<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Storage;

use yii\web\NotFoundHttpException;
use yii\web\Response;

class FromStorage
{
    private string $filePath;
    private string $fileExtension;
    private array $fileStorages;

    public function __construct(string $filePath, Storage ...$fileStorages)
    {
        $this->filePath = $filePath;
        $this->fileStorages = $fileStorages;

        $this->fileExtension = pathinfo($this->filePath, PATHINFO_EXTENSION);
    }

    public function file(): Response
    {
        if ($this->fileExtension === '')
        {
            throw new NotFoundHttpException();
        }

        foreach ($this->fileStorages as $fileStorage)
        {
            if ($fileStorage->fileExists())
            {
                return $fileStorage->file();
            }
        }

        throw new NotFoundHttpException();
    }
}