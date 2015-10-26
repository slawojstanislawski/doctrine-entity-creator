<?php
namespace DEC\Traits;

trait Map
{

	protected $map;

	/**
	 * @param mixed $map
	 */
	public function setMap($map)
	{
		$this->map = $map;
	}

	/**
	 * @return mixed
	 */
	public function getMap()
	{
		return $this->map;
	}

} 