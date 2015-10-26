<?php

namespace DEC\Service;

use DEC\Entity\Property;
use Zend\Stdlib\Hydrator\ClassMethods;

class PropertyExtractor
{

	public function convertPostToPropertyObjects($post)
	{
		$propertyObjects = [];
		$hydrator = new ClassMethods();
		foreach ($post['entityProperties'] as $propertyArray) {
			$property = new Property();
			$hydrator->hydrate($propertyArray, $property);
            $propertyObjects[] = $property;
		}
		usort($propertyObjects, [get_class($this), 'sortByPrimaryAndPropertyNameValue']);
		return $propertyObjects;
	}

	/**
	 * Sorts first by primary field, then sorts by property name alphabetically
	 * @param Property $a
	 * @param Property $b
	 * @return int
	 */
	protected static function sortByPrimaryAndPropertyNameValue(Property $a, Property $b)
	{
		if ($a->getPrimary() == $b->getPrimary()) { //primary field  is set to 1, all not-primary property objects have primary field set to 0.
			return ($a->getPropertyName() < $b->getPropertyName()) ? -1 : 1;
		}
		return ($a->getPrimary() > $b->getPrimary()) ? -1 : 1;
	}


} 