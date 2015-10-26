<?php
namespace DEC\MethodString\Strategy;

use DEC\Entity\Property;

class Strategy2 extends AbstractStrategy implements StrategyInterface
{

	protected $inverse = "";

	public function __construct(Property $property)
	{
		parent::__construct($property);
		$this->inverse = $property->getInverse();
	}

	public function composeString()
	{
		$methodString = '';
		$methodString .= "\tpublic function set" . ucwords($this->propertyName) . "($this->targetEntity\$" . $this->propertyName . " = null) {\n"; //I added the null, so that when no value is specified, null is the default, so that associations could be removed.
		$methodString .= "\t\tif(\${$this->propertyName} == null) {\n";
		$methodString .= "\t\t\t" . '$this->' . $this->propertyName . "->set" . ucwords($this->inverse) . "(null);\n";
		$methodString .= "\t\t\t" . '$this->' . $this->propertyName . ' = $' . $this->propertyName . ";\n";
		$methodString .= "\t\t}else {\n";
		$methodString .= "\t\t\t" . '$this->' . $this->propertyName . ' = $' . $this->propertyName . ";\n";
		$methodString .= "\t\t\t" . '$this->' . $this->propertyName . "->set" . ucwords($this->inverse) . "(\$this);\n";
		$methodString .= "\t\t}\n";
		$methodString .= "\t\t" . "return \$this;\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function get" . ucwords($this->propertyName) . "() {\n";
		$methodString .= "\t\t" . 'return $this->' . $this->propertyName . ";\n";
		$methodString .= "\t}\n\n";
		return $methodString;
	}

} 