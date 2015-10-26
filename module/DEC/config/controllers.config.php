<?php

return [
	'controllers' => [
        'invokables' => [],
		'factories' => [
			'DEC\Controller\Index' => 'DEC\Controller\IndexControllerFactory',
			'DEC\Controller\DbActions' => 'DEC\Controller\DbActionsControllerFactory'
		],
	],
];