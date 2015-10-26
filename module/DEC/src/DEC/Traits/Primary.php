<?php
namespace DEC\Traits;

trait Primary
{

	protected $primary;

	/**
	 * @param mixed $primary
	 */
	public function setPrimary($primary)
	{
		$this->primary = $primary;
	}

	/**
	 * @return mixed
	 */
	public function getPrimary()
	{
		return $this->primary;
	}

} 