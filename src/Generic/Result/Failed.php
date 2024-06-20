<?php

declare(strict_types=1);

namespace Rb\Generic\Result;

use Exception;
use Rb\Generic\Result;

class Failed implements Result
{
	private array $error;

	public function __construct (array $error)
	{
		$this->error = $error;
	}

	public function isSuccessful () : bool
	{
		return false;
	}

	public function value () : array
	{
		throw new Exception('Cannot get value of failed result');
	}

	public function error () : array
	{
		return $this->error;
	}
}