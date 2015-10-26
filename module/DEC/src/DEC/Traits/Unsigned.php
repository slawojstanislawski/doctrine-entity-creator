<?php
namespace DEC\Traits;

trait Unsigned {

	protected $unsigned;

	/**
	 * @param mixed $unsigned
	 */
	public function setUnsigned($unsigned)
	{
		$this->unsigned = $unsigned;
	}

	/**
	 * @return mixed
	 */
	public function getUnsigned()
	{
		return $this->unsigned;
	}

} 