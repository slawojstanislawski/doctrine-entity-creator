<?php
namespace Application;
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'DEC\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'getEntityString' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/getEntityString',
                    'defaults' => [
                        '__NAMESPACE__'  => 'DEC\Controller',
                        'controller'                => 'Index',
                        'action'                        => 'getEntityString',
                    ],
                ],
                'may_terminate' => true,
            ],
            'saveFile' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/saveFile',
                    'defaults' => [
                        '__NAMESPACE__'  => 'DEC\Controller',
                        'controller'                => 'Index',
                        'action'                        => 'saveFile',
                    ],
                ],
                'may_terminate' => true,
            ],
            'createSchema' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/createSchema',
                    'defaults' => [
                        '__NAMESPACE__'  => 'DEC\Controller',
                        'controller'                => 'DbActions',
                        'action'                        => 'createSchema',
                    ],
                ],
                'may_terminate' => true,
            ],
            'getSchemaSql' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/getSchemaSql',
                    'defaults' => [
                        '__NAMESPACE__'  => 'DEC\Controller',
                        'controller'                => 'DbActions',
                        'action'                        => 'getSchemaSql',
                    ],
                ],
                'may_terminate' => true,
            ],
	        'populateForm' => [
		        'type'    => 'Literal',
		        'options' => [
			        'route'    => '/populateForm',
			        'defaults' => [
				        '__NAMESPACE__'  => 'DEC\Controller',
				        'controller'                => 'Index',
				        'action'                        => 'populateForm',
			        ],
		        ],
		        'may_terminate' => true,
	        ],
            'jsonSelectMenu' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/jsonSelectMenu',
                    'defaults' => [
                        '__NAMESPACE__'  => 'DEC\Controller',
                        'controller'                => 'Index',
                        'action'                        => 'jsonSelectMenu',
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.twig',
            'application/index/index' => __DIR__ . '/../view/application/index/index.twig',
            'error/404'               => __DIR__ . '/../view/error/404.html.twig',
            'error/index'             => __DIR__ . '/../view/error/index.twig',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [],
        ],
    ],
	'dec' => [
		'saveDir' => __DIR__ . '/../saved',
		'jsonSaveDir' => __DIR__ . '/../savedJson',
	],
];
