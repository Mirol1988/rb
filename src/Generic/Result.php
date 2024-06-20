<?php

declare(strict_types=1);

namespace Rb\Generic;

interface Result
{
	public function isSuccessful(): bool;
	public function value(): array;
	public function error(): array;
}