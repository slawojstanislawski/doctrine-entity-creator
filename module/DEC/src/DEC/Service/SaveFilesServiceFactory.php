<?php

namespace DEC\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SaveFilesServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return EntityStringCreator
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');
        $saveDirectory = $config['dec']['saveDir'];
        $jsonSaveDirectory = $config['dec']['jsonSaveDir'];
	    $entityStringCreator = $services->get('DEC\Service\EntityStringCreator');
        $saveFilesService = new SaveFilesService($saveDirectory, $jsonSaveDirectory, $entityStringCreator);
        return $saveFilesService;
    }
}