<?php
namespace DEC\Traits;

trait PropertyName
{

	protected $propertyName;

	/**
	 * @param mixed $property
	 */
	public function setPropertyName($propertyName)
	{
		$this->propertyName = $propertyName;
	}

	/**
	 * @return mixed
	 */
	public function getPropertyName()
	{
		return $this->propertyName;
	}

} 