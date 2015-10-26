<?php
namespace DEC\Traits;

trait Inverse
{

	protected $inverse;

	/**
	 * @param mixed $inverse
	 */
	public function setInverse($inverse)
	{
		$this->inverse = $inverse;
	}

	/**
	 * @return mixed
	 */
	public function getInverse()
	{
		return $this->inverse;
	}

} 