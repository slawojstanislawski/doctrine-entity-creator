<?php
namespace DEC\MethodString;

use DEC\Entity\Property;

class MethodString14 extends AbstractMethodString
{

	public function __construct(Property $property)
	{
		$this->property = $property;
		$this->strategy = new Strategy\Strategy7($this->property);
	}

}