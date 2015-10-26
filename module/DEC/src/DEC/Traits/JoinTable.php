<?php
namespace DEC\Traits;

trait JoinTable
{

	protected $joinTable;

	/**
	 * @param mixed $joinTable
	 */
	public function setJoinTable($joinTable)
	{
		$this->joinTable = $joinTable;
	}

	/**
	 * @return mixed
	 */
	public function getJoinTable()
	{
		return $this->joinTable;
	}

} 