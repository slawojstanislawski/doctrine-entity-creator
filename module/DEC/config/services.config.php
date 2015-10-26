<?php

return [
	'service_manager' => [
		'abstract_factories' => [
			'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
			'Zend\Log\LoggerAbstractServiceFactory',
		],
		'aliases' => [
			'translator' => 'MvcTranslator',
		],
		'factories' => [
            'DEC\Service\EntityStringCreator' => 'DEC\Service\EntityStringCreatorFactory',
			'DEC\Service\JsonSelectHandler' =>'DEC\Service\JsonSelectHandlerFactory',
			'DEC\Service\FormPopulator' =>'DEC\Service\FormPopulatorFactory',
			'DEC\Service\SaveFilesService' =>'DEC\Service\SaveFilesServiceFactory',
			'DEC\Service\GetEntityStringService' =>'DEC\Service\GetEntityStringServiceFactory',
		],
		'invokables' => [
			'DEC\Service\SchemaService' =>'DEC\Service\SchemaService'
	],
		'services' => [],
		'shared' => [],
	],
];