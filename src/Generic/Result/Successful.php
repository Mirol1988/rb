<?php

declare(strict_types=1);

namespace Rb\Generic\Result;

use Exception;
use Rb\Generic\Result;

class Successful implements Result
{
	private array $value;

	public function __construct (array $value)
	{
		$this->value = $value;
	}

	public function isSuccessful () : bool
	{
		return true;
	}

	public function value () : array
	{
		return $this->value;
	}

	public function error () : array
	{
		throw new Exception('Successful result does not have an error');
	}
}