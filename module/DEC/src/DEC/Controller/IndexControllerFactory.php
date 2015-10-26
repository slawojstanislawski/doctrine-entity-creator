<?php

namespace DEC\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DEC\Form\EntityForm;

class IndexControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator) {
		/* @var $serviceLocator \Zend\Mvc\Controller\ControllerManager */
		$sm   = $serviceLocator->getServiceLocator();
		$config = $sm->get('config');
        $saveDirectory = $config['dec']['saveDir'];
        $jsonSaveDirectory = $config['dec']['jsonSaveDir'];
        $form = new EntityForm();
		$controller = new IndexController($form, $saveDirectory, $jsonSaveDirectory);
		return $controller;
	}
}