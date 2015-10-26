<?php
namespace DEC\MethodString;

use DEC\Entity\Property;

class MethodString8 extends AbstractMethodString
{

	public function __construct(Property $property)
	{
		$this->property = $property;
		$this->strategy = new Strategy\Strategy3($this->property);
	}

}