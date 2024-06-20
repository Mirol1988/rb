<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Environment;

use Dotenv\Dotenv;

class EnvironmentDependentEnvFile
{
    private Dotenv $dotEnv;

    public function __construct(string $path, array $headers)
    {
        $this->dotEnv = $this->concrete($path, $headers);
    }

    public function load(): void
    {
        $this->dotEnv->load();
    }

    private function concrete(string $path, array $headers): Dotenv
    {
        if (
            file_exists($path . DIRECTORY_SEPARATOR . '.env.test')
            && isset($headers['X-Functional-Test'])
            && $headers['X-Functional-Test'] == 1
        ) {
            return Dotenv::createMutable($path, '.env.test');
        }

        return new NonExistentEnvFile();
    }
}