<?php
namespace DEC\Traits;

trait JoinColumn1
{

	protected $joinColumn1;

	/**
	 * @param mixed $joinColumn1
	 */
	public function setJoinColumn1($joinColumn1)
	{
		$this->joinColumn1 = $joinColumn1;
	}

	/**
	 * @return mixed
	 */
	public function getJoinColumn1()
	{
		return $this->joinColumn1;
	}

} 