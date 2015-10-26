<?php
namespace DEC\ORMString;

use DEC\Entity\Property;

class ORMStringObjectFactory
{

	public static function makeORMStringObject($ormStringObject, Property $property)
	{
		$ormStringVariablesArray = $ormStringObject->getObjectVariables();
		foreach ($ormStringVariablesArray as $ormStringVariable => $value) {
			$getterName = "get" . ucfirst($ormStringVariable);
			$setterName = "set" . ucfirst($ormStringVariable);
			if (method_exists($property, $getterName)) {
				$ormStringObject->$setterName($property->$getterName());
			}
		}
		return $ormStringObject;
	}

} 