<?php
namespace DEC\Traits;

trait ColumnType
{

	protected $columnType;

	/**
	 * @param mixed $columnType
	 */
	public function setColumnType($columnType)
	{
		$this->columnType = $columnType;
	}

	/**
	 * @return mixed
	 */
	public function getColumnType()
	{
		return $this->columnType;
	}

} 