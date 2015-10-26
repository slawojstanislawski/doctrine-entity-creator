<?php
namespace DEC\MethodString;

use DEC\Entity\Property;

class MethodString3 extends AbstractMethodString
{

	public function __construct(Property $property)
	{
		$this->property = $property;
		$this->strategy = new Strategy\Strategy2($this->property);
	}

}