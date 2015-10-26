<?php
namespace DEC\Traits;

trait Nullable
{

	protected $nullable;

	/**
	 * @param mixed $nullable
	 */
	public function setNullable($nullable)
	{
		$this->nullable = $nullable;
	}

	/**
	 * @return mixed
	 */
	public function getNullable()
	{
		return $this->nullable;
	}

} 