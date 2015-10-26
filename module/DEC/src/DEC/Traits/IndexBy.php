<?php
namespace DEC\Traits;

trait IndexBy
{

	protected $indexBy;

	/**
	 * @param mixed $indexBy
	 */
	public function setIndexBy($indexBy)
	{
		$this->indexBy = $indexBy;
	}

	/**
	 * @return mixed
	 */
	public function getIndexBy()
	{
		return $this->indexBy;
	}

} 