<?php
namespace DEC\MethodString;

use DEC\Entity\Property;

class MethodStringCreator
{

	protected $methodStrings = [];

	/**
	 * @param array $propertyObjects
	 * @return array
	 */
	public function getMethodStringsForProperties(array $propertyObjects)
	{
		foreach ($propertyObjects as $propertyObject) {
			if ($propertyObject->getPropertyName() != "") {
				$this->methodStrings[] = $this->makeMethodStringForSingleProperty($propertyObject);
			}
		}
		return implode("", $this->methodStrings);
	}

	/**
	 * @param Property $property
	 * @return string
	 */
	protected function makeMethodStringForSingleProperty(Property $property)
	{
		$association = $property->getAssociation();
		if(!$association) $association = 0;
		$objectName = __NAMESPACE__ . "\\MethodString" . $association;
		$methodStringObject = new $objectName($property);
		return $methodStringObject->getStringFromStrategy();
	}

}