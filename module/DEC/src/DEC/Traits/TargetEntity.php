<?php
namespace DEC\Traits;

trait TargetEntity
{

	protected $targetEntity;

	/**
	 * @param mixed $targetEntity
	 */
	public function setTargetEntity($targetEntity)
	{
		$this->targetEntity = $targetEntity;
	}

	/**
	 * @return mixed
	 */
	public function getTargetEntity()
	{
		return $this->targetEntity;
	}

}