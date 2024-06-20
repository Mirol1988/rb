<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\ViewVersion;

use Rb\Generic\Response;
use Rb\Generic\Response\Ok;
use Rb\Infrastructure\UserStory;
use Rb\Infrastructure\Version\CurrentVersion;
use Throwable;
use Yii;

class ViewVersion implements UserStory
{
    public function response(): Response
    {
        Yii::info('View version');

        return
            new Ok(
                array_merge(
                    ['version' => (new CurrentVersion())->value()],
                    $this->deployInfo()
                )
            );
    }

    private function deployInfo(): array
    {
        if (!file_exists($this->deployFile())) {
            return [];
        }

        try {
            $info = json_decode(file_get_contents($this->deployFile()), true);
        } catch (Throwable $exception) {
            Yii::error('File `deploy.json` has bad format');

            $info = ['Deploy file has bad format'];
        }

        return ['deploy' => $info];
    }

    private function deployFile(): string
    {
        return dirname(dirname(dirname(dirname(__DIR__)))) . '/runtime/deploy.json';
    }
}