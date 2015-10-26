<?php

namespace DEC\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use DEC\Form\EntityForm;

class DbActionsControllerFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator) {
		$sm   = $serviceLocator->getServiceLocator();
		$config = $sm->get('config');
        $saveDirectory = $config['dec']['saveDir'];
        $form = new EntityForm();
		$controller = new DbActionsController( $form, $saveDirectory);
		return $controller;
	}
}