<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Language;

use Rb\Infrastructure\Application\Language;

class English implements Language
{
	public function value(): string
	{
		return 'en';
	}
}