<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application;

interface Language
{
	public function value(): string;
}