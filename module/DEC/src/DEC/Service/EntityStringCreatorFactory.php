<?php

namespace DEC\Service;

use DEC\MethodString\MethodStringCreator;
use DEC\ORMString\ORMStringCreator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DEC\ClassString\ClassDataStringCreator;

class EntityStringCreatorFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return EntityStringCreator
     */
    public function createService(ServiceLocatorInterface $services)
    {
	    $propertyExtractor = new PropertyExtractor();
        $classDataStringCreator = new ClassDataStringCreator();
        $ormStringCreator = new ORMStringCreator();
        $methodStringCreator = new MethodStringCreator();
        $entityStringCreator = new EntityStringCreator($propertyExtractor, $classDataStringCreator, $ormStringCreator, $methodStringCreator);
        return $entityStringCreator;
    }
}