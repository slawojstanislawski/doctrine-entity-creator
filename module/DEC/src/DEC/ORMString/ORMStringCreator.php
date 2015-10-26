<?php
namespace DEC\ORMString;

use DEC\Entity\Property;

class ORMStringCreator
{

	protected $ormStrings = [];

	/**
	 * @param array $propertyObjects
	 * @return array
	 */
	public function getORMStringsForProperties(array $propertyObjects)
	{
		foreach ($propertyObjects as $propertyObject) {
			if ($propertyObject->getPropertyName() != "") {
				$this->ormStrings[] = $this->makeORMStringForSingleProperty($propertyObject);
			}
		}
		return implode("", $this->ormStrings);
	}

	/**
	 * @param Property $property
	 * @return string
	 */
	protected function makeORMStringForSingleProperty(Property $property)
	{
		$association = $property->getAssociation();
		if(!$association) $association = 0;
		$ormStringObjectName = __NAMESPACE__ . "\\ORMString" . $association;
		$ormStringObject = ORMStringObjectFactory::makeORMStringObject(new $ormStringObjectName, $property);
		return $ormStringObject->buildString()->getORMString();
	}

}