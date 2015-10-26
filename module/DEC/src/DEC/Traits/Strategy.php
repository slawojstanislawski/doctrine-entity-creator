<?php
namespace DEC\Traits;

trait Strategy
{

	protected $strategy;

	/**
	 * @param mixed $strategy
	 */
	public function setStrategy($strategy)
	{
		$this->strategy = $strategy;
	}

	/**
	 * @return mixed
	 */
	public function getStrategy()
	{
		return $this->strategy;
	}

} 