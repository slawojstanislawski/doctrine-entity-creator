<?php
namespace DECTest\Controller;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Http\Request;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\SimpleRouteStack;

abstract class AbstractDecControllerTest extends AbstractHttpControllerTestCase{

	protected $traceError = true;
	protected 	$saveDirectory ; //virtual directory path to test saving files with
	protected $serviceLocator;

	protected static function findParentPath($path)
	{
		$dir = __DIR__;
		$previousDir = '.';
		while (!is_dir($dir . '/' . $path)) {
			$dir = dirname($dir);
			if ($previousDir === $dir) {
				return false;
			}
			$previousDir = $dir;
		}
		return $dir . '/' . $path;
	}
	public function setUp()
	{
		$modulePath = static::findParentPath("module");
		$this->setApplicationConfig(
			include $modulePath . '/../config/application.config.php'
		);
		$serviceLocator = $this->getApplicationServiceLocator();
		$config = $serviceLocator->get('config');
		vfsStreamWrapper::register();
		vfsStreamWrapper::setRoot(new vfsStreamDirectory("testSaveDir"));
		$this->saveDirectory = vfsStream::url("testSaveDir"); //so that each test making use of VFS used this saveDirectory to construct paths.
		$config['dec']['jsonSaveDir'] = vfsStream::url("testSaveDir");//so that everything using serviceLocator, used it with VFS path in config.
		$serviceLocator->setAllowOverride(true);
		$serviceLocator->setService('config', $config);

		$saveFilesService = $serviceLocator->get('DEC\Service\SaveFilesService');
		$saveFilesService->setJsonSaveDir($this->saveDirectory);
		$saveFilesService->setSaveDir($this->saveDirectory);

		$this->iniSet('memory_limit', '512M'); //automatically resets to original ini value after the test is run.
		$this->serviceLocator = $serviceLocator;
		parent::setUp();
	}

	public function createAjaxRequestWithSpecificPostData($postData) {
		$request = new Request();
		$request->getHeaders()->addHeaders([
			'X_REQUESTED_WITH' => 'XMLHttpRequest'
		]);
		$parameters = new \Zend\Stdlib\Parameters;
		$parameters->fromArray($postData);
		$request->setPost($parameters);
		return $request;
	}
	public function configureControllerForAGivenRoute($controller, $routeName) {
		//CONFIGURE ROUTING
		$event = new MvcEvent();
		//build the router and set it as event's router.
		$routeStack = new SimpleRouteStack;
		$route = new Literal('/' . $routeName);
		$routeStack->addRoute($routeName, $route);
		//so that "route >home< not found" error did not show up - add home route.
		$routeHome = new Literal('/');
		$routeStack->addRoute('home', $routeHome);
		$event->setRouter($routeStack);
		//set route match for the event
		$routeMatch = new RouteMatch(['controller' => 'Index', 'action' => $routeName]);
		$routeMatch->setMatchedRouteName($routeName);
		$event->setRouteMatch($routeMatch);
		//finish configuring controller
		$controller->setEvent($event);
		return $controller;
	}

} 