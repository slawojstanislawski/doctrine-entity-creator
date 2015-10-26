<?php
namespace DEC\Traits;

trait Column
{

	protected $column;

	/**
	 * @param mixed $column
	 */
	public function setColumn($column)
	{
		$this->column = $column;
	}

	/**
	 * @return mixed
	 */
	public function getColumn()
	{
		return $this->column;
	}

} 