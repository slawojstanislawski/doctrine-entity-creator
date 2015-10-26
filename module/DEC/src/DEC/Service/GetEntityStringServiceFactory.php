<?php

namespace DEC\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GetEntityStringServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return EntityStringCreator
     */
    public function createService(ServiceLocatorInterface $services)
    {
	    $entityStringCreator = $services->get('DEC\Service\EntityStringCreator');
        $getEntityStringService = new GetEntityStringService($entityStringCreator);
        return $getEntityStringService;
    }
}