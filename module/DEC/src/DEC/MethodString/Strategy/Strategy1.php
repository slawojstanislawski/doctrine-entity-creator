<?php
namespace DEC\MethodString\Strategy;

use DEC\Entity\Property;

class Strategy1 extends AbstractStrategy implements StrategyInterface
{

	public function __construct(Property $property)
	{
		parent::__construct($property);
	}

	public function composeString()
	{
		$methodString = '';
		$methodString .= "\tpublic function set" . ucwords($this->propertyName) . "($this->targetEntity\$" . $this->propertyName . " = null) {\n"; //I added the null, so that when no value is specified, null is the default, so that associations could be removed.
		$methodString .= "\t\t" . '$this->' . $this->propertyName . ' = $' . $this->propertyName . ";\n";
		$methodString .= "\t\t" . "return \$this;\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function get" . ucwords($this->propertyName) . "() {\n";
		$methodString .= "\t\t" . 'return $this->' . $this->propertyName . ";\n";
		$methodString .= "\t}\n\n";
		return $methodString;
	}

} 