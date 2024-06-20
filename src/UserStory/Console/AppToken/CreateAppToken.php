<?php

declare(strict_types=1);

namespace Rb\UserStory\Console\AppToken;

use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Generic\Result\Successful;
use Rb\Infrastructure\Console\Command;
use Rb\Models\Ubet\AppToken;

class CreateAppToken implements Command
{
    private string $application;
    private string $token;

    public function __construct(string $application, string $token)
    {
        $this->application = $application;
        $this->token = $token;
    }

    public function run(): Result
    {
        $appToken = new AppToken();
        $appToken->token = $this->token;
        $appToken->application = $this->application;

        $result = $appToken->save();

        if (!$result) {
            return new Failed($appToken->getErrorSummary(true));
        }

        return new Successful([sprintf('Token for `%s` created.', $this->application)]);
    }

}