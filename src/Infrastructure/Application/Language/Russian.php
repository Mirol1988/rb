<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Language;

use Rb\Infrastructure\Application\Language;

class Russian implements Language
{
	public function value(): string
	{
		return 'ru';
	}
}