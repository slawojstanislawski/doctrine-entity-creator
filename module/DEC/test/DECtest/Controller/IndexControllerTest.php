<?php
namespace DECTest\Controller;

use DEC\Form\EntityForm;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use DEC\Controller\IndexController;

class IndexControllerTest extends AbstractDecControllerTest
{
	//test the only non-ajax request
	public function testIndexActionCanBeAccessed()
	{
		$this->dispatch('/');
		$this->assertResponseStatusCode(200);
		$this->assertModuleName('DEC');
		$this->assertControllerName('DEC\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('home');
	}

	//test redirection and test for right module,controller and action.
	public function testGetEntityStringActionRedirectsIfNotAjaxRequest()
	{
		$this->dispatch('/getEntityString');
		$this->assertResponseStatusCode(302);
		$this->assertModuleName('DEC');
		$this->assertControllerName('DEC\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('getEntityString');
		$this->assertRedirectTo('/');
	}
	public function testSaveFileActionRedirectsIfNotAjaxRequest()
	{
		$this->dispatch('/saveFile');
		$this->assertResponseStatusCode(302);
		$this->assertModuleName('DEC');
		$this->assertControllerName('DEC\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('saveFile');
		$this->assertRedirectTo('/');
	}
	public function testPopulateFormActionRedirectsIfNotAjaxRequest()
	{
		$this->dispatch('/populateForm');
		$this->assertResponseStatusCode(302);
		$this->assertModuleName('DEC');
		$this->assertControllerName('DEC\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('populateForm');
		$this->assertRedirectTo('/');
	}
	public function testJsonSelectMenuActionRedirectsIfNotAjaxRequest()
	{
		$this->dispatch('/jsonSelectMenu');
		$this->assertResponseStatusCode(302);
		$this->assertModuleName('DEC');
		$this->assertControllerName('DEC\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('jsonSelectMenu');
		$this->assertRedirectTo('/');
	}

//	//testing for invalid form data response if not all required fields provided
	public function testGetEntityStringActionReturnsInvalidOnClassnameNotSupplied()
	{
		$this->dispatch("/getEntityString", "POST",
			[
				"classname" => "",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}
	public function testGetEntityStringActionReturnsInvalidOnTablenameNotSupplied()
	{
		$this->dispatch("/getEntityString", "POST",
			[
				"classname" => "test",
				"tablename" => "",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}
	public function testGetEntityStringActionReturnsInvalidOnNamespaceNotSupplied()
	{
		$this->dispatch("/getEntityString", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}
	public function testGetEntityStringActionReturnsInvalidOnPropertyNameNotSupplied()
	{
		$this->dispatch("/getEntityString", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => ""
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}
	public function testSaveFileActionReturnsInvalidOnClassnameNotSupplied()
	{
		$this->dispatch("/saveFile", "POST",
			[
				"classname" => "",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}
	public function testSaveFileActionReturnsInvalidOnTablenameNotSupplied()
	{
		$this->dispatch("/saveFile", "POST",
			[
				"classname" => "test",
				"tablename" => "",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}
	public function testSaveFileActionReturnsInvalidOnNamespaceNotSupplied()
	{
		$this->dispatch("/saveFile", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}
	public function testSaveFileActionReturnsInvalidOnPropertyNameNotSupplied()
	{
		$this->dispatch("/saveFile", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => ""
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"invalidform", $responseContent["message"]
		);
	}

	//test getEntityString action
	public function testGetEntityStringActionReturnsString()
	{
		$this->dispatch("/getEntityString", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test",
						"primary" => 1
					],
					1 => [
						"propertyName" => "test2",
						"primary" => 0
					],
					2 => [
						"propertyName" => "test3",
						"primary" => 0
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertStringStartsWith("<pre>", $responseContent["entityString"]);
		$this->assertStringEndsWith("</pre>", $responseContent["entityString"]);
	}
	public function testGetEntityStringActionWhenStringDoesNotGetCreated()
	{
		$mockedEntityStringCreator = $this->getMock(
			'DEC\Service\EntityStringCreator', //original classname
			['getClassDataStringCreator', 'consumePostData', 'getNamespace', 'getClassname', 'makeFinalEntityString'], //methods
			[], //arguments
			'EntityStringCreator', //classname
			false);//use original constructor

		$mockedEntityStringCreator->expects($this->any())->method('getClassDataStringCreator')
			->will($this->returnSelf());
		$mockedEntityStringCreator->expects($this->any())->method('consumePostData')
			->will($this->returnValue(true));
		$mockedEntityStringCreator->expects($this->any())->method('makeFinalEntityString')
			->will($this->returnValue(""));

		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('DEC\Service\EntityStringCreator', $mockedEntityStringCreator);

		$this->dispatch("/getEntityString", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"stringnotcreated", $responseContent["message"]
		);
	}
	public function testGetEntityStringActionOnDuplicatePropertyNames()
	{
		$mockedEntityStringCreator = $this->getMock(
			'DEC\Service\EntityStringCreator', //original classname
			['getClassDataStringCreator', 'consumePostData', 'getNamespace', 'getClassname', 'makeFinalEntityString'], //methods
			[], //arguments
			'EntityStringCreator', //classname
			false);//use original constructor

		$mockedEntityStringCreator->expects($this->any())->method('getClassDataStringCreator')
			->will($this->returnSelf());
		$mockedEntityStringCreator->expects($this->any())->method('consumePostData')
			->will($this->returnValue(true));
		$mockedEntityStringCreator->expects($this->any())->method('makeFinalEntityString')
			->will($this->returnValue(""));

		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('DEC\Service\EntityStringCreator', $mockedEntityStringCreator);

		$this->dispatch("/getEntityString", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
					1 => [
						"propertyName" => "test"
					],
				],
			], true);
		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(
			"error", $responseContent["status"]
		);
		$this->assertEquals(
			"duplicatePropertyNames", $responseContent["message"]
		);
	}

	//utility functions
	public function createAjaxRequestWithDataForFileSaving ($saveModifiedEntity = false)
	{
		$postData = [
			"classname" => "Test",
			"tablename" => "test",
			"namespace" => "Test",
			"entityProperties" => [
				0 => [
					"propertyName" => "id",
					"primary" => 1,
					'strategy' => "AUTO",
					"column" => "id",
					"columnType" => "integer"
				],
			],
		];
		if($saveModifiedEntity) {
			$postData['classname'] = 'Test2';
			$postData['namespace'] = 'Test2\\Test2';
		}
		$request = $this->createAjaxRequestWithSpecificPostData($postData);
		return $request;
	}
	public function createAjaxRequestWithDuplicatePropertyNamesDataForFileSaving ()
	{
		$postData = [
			"classname" => "Test",
			"tablename" => "test",
			"namespace" => "Test",
			"entityProperties" => [
				0 => [
					"propertyName" => "id",
					"primary" => 1,
					'strategy' => "AUTO",
					"column" => "id",
					"columnType" => "integer"
				],
				1 => [
					"propertyName" => "id",
					"primary" => 0,
					"column" => "id",
					"columnType" => "integer"
				],
			],
		];
		$request = $this->createAjaxRequestWithSpecificPostData($postData);
		return $request;
	}
	public function createAjaxRequestWithDataForFormPopulation()
	{
		$postData = [
			"classname" => "Test\\Test",
		];
		$request = $this->createAjaxRequestWithSpecificPostData($postData);
		return $request;
	}
	public function getIndexControllerWithVirtualPaths($saveDirectory)
	{
		$form = new EntityForm();
		$controller = new IndexController($form, $saveDirectory, $saveDirectory);
		$controller->setServiceLocator($this->serviceLocator);
		return $controller;
	}
	public function getIndexControllerReadyToExecuteFileSavingRequest($saveDirectory)
	{
		$controller = $this->getIndexControllerWithVirtualPaths($saveDirectory); //creates controller with virtual save path.
		$controller = $this->configureControllerForAGivenRoute($controller, 'saveFile');
		return $controller;
	}
	public function executeFileSavingOperationAndReturnController($saveModifiedEntity = false)
	{
		$controller = $this->getIndexControllerReadyToExecuteFileSavingRequest($this->saveDirectory);
		$saveFileRequest = $this->createAjaxRequestWithDataForFileSaving($saveModifiedEntity);
		$controller->dispatch($saveFileRequest);
		return $controller;
	}

	//test saveFile action
	public function testSaveFileActionWhenEntityStringDoesNotGetCreated()
	{
		$mockedEntityStringCreator = $this->getMock(
			'DEC\Service\EntityStringCreator', //original classname
			['getClassDataStringCreator', 'consumePostData', 'getNamespace', 'getClassname', 'makeFinalEntityString'], //methods
			[], //arguments
			'EntityStringCreatorForEntityString', //classname
			false);//use original constructor

		$mockedEntityStringCreator->expects($this->any())->method('getClassDataStringCreator')
			->will($this->returnSelf());
		$mockedEntityStringCreator->expects($this->any())->method('consumePostData')
			->will($this->returnValue(true));
		$mockedEntityStringCreator->expects($this->any())->method('getNamespace')
			->will($this->returnValue(""));
		$mockedEntityStringCreator->expects($this->any())->method('getClassname')
			->will($this->returnValue(""));
		$mockedEntityStringCreator->expects($this->any())->method('makeFinalEntityString')
			->will($this->returnValue(""));

		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('DEC\Service\EntityStringCreator', $mockedEntityStringCreator);

		$this->dispatch("/saveFile", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(	"error", $responseContent["status"]);
		$this->assertEquals(	"stringnotcreated", $responseContent["message"]);
	}
	public function testSaveFileActionWhenJsonStringDoesNotGetCreated()
	{
		$mockedEntityStringCreator = $this->getMock(
			'DEC\Service\EntityStringCreator', //original classname
			['getClassDataStringCreator', 'consumePostData', 'getNamespace', 'getClassname', 'makeFinalEntityString','createJsonRepresentation'], //methods
			[], //arguments
			'EntityStringCreatorForJson', //classname
			false);//use original constructor

		$mockedEntityStringCreator->expects($this->any())->method('getClassDataStringCreator')
			->will($this->returnSelf());
		$mockedEntityStringCreator->expects($this->any())->method('consumePostData')
			->will($this->returnValue(true));
		$mockedEntityStringCreator->expects($this->any())->method('getNamespace')
			->will($this->returnValue(""));
		$mockedEntityStringCreator->expects($this->any())->method('getClassname')
			->will($this->returnValue(""));
		$mockedEntityStringCreator->expects($this->any())->method('makeFinalEntityString')
			->will($this->returnValue("testResultEntityString"));
		$mockedEntityStringCreator->expects($this->any())->method('createJsonRepresentation')
			->will($this->returnValue(""));

		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('DEC\Service\EntityStringCreator', $mockedEntityStringCreator);

		$this->dispatch("/saveFile", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(	"error", $responseContent["status"]);
		$this->assertEquals(	"stringnotcreated", $responseContent["message"]);
	}

	public function testSaveFileActionWhenTargetFileContentDoesNotMatchOutputContent()
	{
		$originalEntityStringCreator = $this->serviceLocator->get('DEC\Service\EntityStringCreator');
		$mockedSaveFileService = $this->getMock(
			'DEC\Service\SaveFilesService', //original classname
			['checkIfContentsMatchTheInput'], //methods
			[$this->saveDirectory, $this->saveDirectory, $originalEntityStringCreator], //arguments
			'SaveFilesService', //classname
			true);//use original constructor

		$mockedSaveFileService->expects($this->any())->method('checkIfContentsMatchTheInput')
			->will($this->returnValue(false));

		$serviceManager = $this->getApplicationServiceLocator();
		$serviceManager->setAllowOverride(true);
		$serviceManager->setService('DEC\Service\SaveFilesService', $mockedSaveFileService);

		$this->dispatch("/saveFile", "POST",
			[
				"classname" => "test",
				"tablename" => "test",
				"namespace" => "test",
				"entityProperties" => [
					0 => [
						"propertyName" => "test"
					],
				],
			], true);
//		$this->assertResponseStatusCode(200);
		$responseContent = json_decode($this->getResponse()->getContent(), true);
		$this->assertEquals(	"error", $responseContent["status"]);
		$this->assertEquals(	"notsaved", $responseContent["message"]);
	}
	public function testSaveFileActionOnDirectoryWithNoPermissions()
	{
		//set saveDirectory to a directory with no write and no read permissions
		vfsStreamWrapper::setRoot(new vfsStreamDirectory("testSaveDir", 000));

		$controller = $this->getIndexControllerReadyToExecuteFileSavingRequest($this->saveDirectory);
		$saveFileRequest = $this->createAjaxRequestWithDataForFileSaving();
		$result = $controller->dispatch($saveFileRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $result->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("didntcreatefolder", $responseContent['message']);
	}
	public function testSaveFileActionWithDuplicatePropertyNames()
	{
		$controller = $this->getIndexControllerReadyToExecuteFileSavingRequest($this->saveDirectory);
		$saveFileRequest = $this->createAjaxRequestWithDuplicatePropertyNamesDataForFileSaving();
		$result = $controller->dispatch($saveFileRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $result->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("duplicatePropertyNames", $responseContent['message']);
	}
	public function testSaveFileActionSavesFilesAsIntended()
	{
		$controller = $this->getIndexControllerReadyToExecuteFileSavingRequest($this->saveDirectory);
		$saveFileRequest = $this->createAjaxRequestWithDataForFileSaving();
		$result = $controller->dispatch($saveFileRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $result->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("success", $responseContent['status']);

		$wasPhpFileSaved = vfsStreamWrapper::getRoot()->hasChild("Test/Test.php");
		$this->assertTrue($wasPhpFileSaved);
		$wasJsonFileSaved = vfsStreamWrapper::getRoot()->hasChild("Test/Test.json");
		$this->assertTrue($wasJsonFileSaved);
		$this->assertStringEqualsFile($this->saveDirectory . "/Test/Test.php", $responseContent['entityString']);
		$this->assertStringEqualsFile($this->saveDirectory . "/Test/Test.json", $responseContent['jsonEntityRepresentation']);
	}

	//test populateForm action
	public function testPopulateFormActionWithClassnameProvided()
	{
		//execute file saving
		$controller = $this->executeFileSavingOperationAndReturnController();

		//now the populateForm request
		$controller = $this->configureControllerForAGivenRoute($controller, 'populateForm');
		$populateFormRequest = $this->createAjaxRequestWithDataForFormPopulation();
		$populateFormResult = $controller->dispatch($populateFormRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $populateFormResult->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("success", $responseContent['status']);
		$expectedJsonString = '{"namespace":"Test","classname":"Test","tablename":"test","repositoryclass":null,"entityProperties":[{"propertyName":"id","primary":"1","strategy":"AUTO","column":"id","columnType":"integer","nullable":null,"default":null,"unique":null,"unsigned":null,"association":null,"targetEntity":null,"cascade":null,"map":null,"inverse":null,"indexBy":null,"joinColumn1":null,"refColumn1":null,"joinColumn2":null,"refColumn2":null,"joinTable":null}],"indexes":[]}';
		$this->assertEquals($expectedJsonString, $responseContent['json']);
	}
	public function testPopulateFormActionOnNoClassnameProvided()
	{
		//execute file saving
		$controller = $this->executeFileSavingOperationAndReturnController();

		//now the populateForm request
		$controller = $this->configureControllerForAGivenRoute($controller, 'populateForm');
		$populateFormRequest = $this->createAjaxRequestWithSpecificPostData([]);
		$populateFormResult = $controller->dispatch($populateFormRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $populateFormResult->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("didntPopulate", $responseContent['message']);
	}

	//test jsonSelectMenu action
	public function testJsonSelectMenuActionWithJsonFilesPresent()
	{
		//execute file saving
		$controller = $this->executeFileSavingOperationAndReturnController();

		//now the jsonSelectMenu  request
		$controller = $this->configureControllerForAGivenRoute($controller, 'jsonSelectMenu');
		$jsonSelectMenuRequest = $this->createAjaxRequestWithSpecificPostData([]);
		$jsonSelectMenuResults = $controller->dispatch($jsonSelectMenuRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $jsonSelectMenuResults->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("success", $responseContent['status']);
		$this->assertContains('Test\Test.php', $responseContent['classnames']);
	}
	public function testJsonSelectMenuActionWithSorting()
	{
		//execute file saving
		$controller = $this->executeFileSavingOperationAndReturnController();
		$controller = $this->executeFileSavingOperationAndReturnController(true);

		//now the jsonSelectMenu  request
		$controller = $this->configureControllerForAGivenRoute($controller, 'jsonSelectMenu');
		$jsonSelectMenuRequest = $this->createAjaxRequestWithSpecificPostData([]);
		$jsonSelectMenuResults = $controller->dispatch($jsonSelectMenuRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $jsonSelectMenuResults->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("success", $responseContent['status']);
		$this->assertContains('Test\Test.php', $responseContent['classnames']);
		$this->assertContains('Test2\Test2\Test2.php', $responseContent['classnames']);
		$predictedSmallerIndex = array_search('Test\Test.php', $responseContent['classnames']);
		$this->assertNotFalse($predictedSmallerIndex);
		$predictedBiggerIndex = array_search('Test2\Test2\Test2.php', $responseContent['classnames']);
		$this->assertNotFalse($predictedBiggerIndex);
		$this->assertTrue($predictedBiggerIndex > $predictedSmallerIndex);
	}


	public function testJsonSelectMenuActionWithNoJsonFilesPresent()
	{
		$controller = $this->getIndexControllerWithVirtualPaths($this->saveDirectory); //creates controller with virtual save path.

		//now the jsonSelectMenu  request
		$controller = $this->configureControllerForAGivenRoute($controller, 'jsonSelectMenu');
		$jsonSelectMenuRequest = $this->createAjaxRequestWithSpecificPostData([]);
		$jsonSelectMenuResults = $controller->dispatch($jsonSelectMenuRequest);

		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());

		$responseContent = $jsonSelectMenuResults->getVariables(); //because result is an instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("noEntityFiles", $responseContent['message']);
	}

}