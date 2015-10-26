<?php
namespace DEC\MethodString\Strategy;

use DEC\Entity\Property;

class AbstractStrategy {

	protected $propertyName;
	protected $targetEntity;

	public function __construct(Property $property)
	{
		$this->propertyName = $property->getPropertyName();
		$this->targetEntity = ($property->getTargetEntity()) ? "\\" . $property->getTargetEntity() . " " : "";
	}

} 