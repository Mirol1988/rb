<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application;

interface Database
{
	public function value(): array;
}