<?php

namespace DEC\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class JsonSelectHandlerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return EntityStringCreator
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');
        $jsonSaveDirectory = $config['dec']['jsonSaveDir'];
        $jsonSelectHandler = new JsonSelectHandler($jsonSaveDirectory);
        return $jsonSelectHandler;
    }
}