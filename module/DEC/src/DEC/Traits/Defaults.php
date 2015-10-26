<?php
namespace DEC\Traits;

trait Defaults {

	protected $default;

	/**
	 * @param mixed $default
	 */
	public function setDefault($default)
	{
		$this->default = $default;
	}

	/**
	 * @return mixed
	 */
	public function getDefault()
	{
		return $this->default;
	}

} 