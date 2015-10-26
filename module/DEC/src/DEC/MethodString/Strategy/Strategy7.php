<?php
namespace DEC\MethodString\Strategy;

use DEC\Entity\Property;

class Strategy7 extends AbstractStrategy implements StrategyInterface
{

	public function __construct(Property $property)
	{
		parent::__construct($property);
	}

	public function composeString()
	{
		$methodString = '';
		$methodString .= "\tpublic function addTo" . ucwords($this->propertyName) . "($this->targetEntity\$singleEntity) {\n";
		$methodString .= "\t\tif(!\$this->" . $this->propertyName . "->contains(\$singleEntity)) {\n";
		$methodString .= "\t\t\t\$this->" . $this->propertyName . "->add(\$singleEntity);\n";
		$methodString .= "\t\t\t\$singleEntity->addTo" . ucwords($this->propertyName) . "(\$this);\n";
		$methodString .= "\t\t}\n";
		$methodString .= "\t\treturn \$this;\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function add" . ucwords($this->propertyName) . "(Collection \${$this->propertyName}) {\n";
		$methodString .= "\t\tforeach(\${$this->propertyName} as \$singleEntity) {\n";
		$methodString .= "\t\t\t\$this->addTo" . ucwords($this->propertyName) . "(\$singleEntity);\n";
		$methodString .= "\t\t}\n";
		$methodString .= "\t\treturn \$this;\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function removeFrom" . ucwords($this->propertyName) . "($this->targetEntity\$singleEntity) {\n";
		$methodString .= "\t\tif(\$this->" . $this->propertyName . "->contains(\$singleEntity)) {\n";
		$methodString .= "\t\t\t\$this->" . $this->propertyName . "->removeElement(\$singleEntity);\n";
		$methodString .= "\t\t\t\$singleEntity->removeFrom" . ucwords($this->propertyName) . "(\$this);\n";
		$methodString .= "\t\t}\n";
		$methodString .= "\t\treturn \$this;\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function remove" . ucwords($this->propertyName) . "(Collection \${$this->propertyName}) {\n";
		$methodString .= "\t\tforeach(\${$this->propertyName} as \$singleEntity) {\n";
		$methodString .= "\t\t\t\$this->removeFrom" . ucwords($this->propertyName) . "(\$singleEntity);\n";
		$methodString .= "\t\t}\n";
		$methodString .= "\t\treturn \$this;\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function clear" . ucwords($this->propertyName) . "() {\n";
		$methodString .= "\t\tforeach(\$this->{$this->propertyName} as \$singleEntity) {\n";
		$methodString .= "\t\t\t\$this->removeFrom" . ucwords($this->propertyName) . "(\$singleEntity);\n";
		$methodString .= "\t\t}\n";
		$methodString .= "\t\treturn \$this;\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function get" . ucwords($this->propertyName) . "() {\n";
		$methodString .= "\t\treturn \$this->" . $this->propertyName . ";\n";
		$methodString .= "\t}\n\n";
		$methodString .= "\tpublic function set" . ucwords($this->propertyName) . "(\${$this->propertyName}) {\n";
		$methodString .= "\t\t\$this->clear" . ucwords($this->propertyName) . "();\n";
		$methodString .= "\t\tforeach(\${$this->propertyName} as \$singleEntity) {\n";
		$methodString .= "\t\t\t\$this->addTo" . ucwords($this->propertyName) . "(\$singleEntity);\n";
		$methodString .= "\t\t}\n";
		$methodString .= "\t\treturn \$this;\n";
		$methodString .= "\t}\n\n";
		return $methodString;
	}

} 