<?php

namespace DEC\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormPopulatorFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return EntityStringCreator
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');
        $jsonSaveDirectory = $config['dec']['jsonSaveDir'];
        $formPopulator = new FormPopulator($jsonSaveDirectory);
        return $formPopulator;
    }
}