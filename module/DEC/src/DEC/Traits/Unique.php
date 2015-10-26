<?php
namespace DEC\Traits;

trait Unique {

	protected $unique;

	/**
	 * @param mixed $unique
	 */
	public function setUnique($unique)
	{
		$this->unique = $unique;
	}

	/**
	 * @return mixed
	 */
	public function getUnique()
	{
		return $this->unique;
	}

} 