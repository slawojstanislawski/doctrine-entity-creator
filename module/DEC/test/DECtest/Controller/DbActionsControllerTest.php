<?php
namespace DECTest\Controller;

use DEC\Form\EntityForm;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use DEC\Controller\DbActionsController;

class DbActionsControllerTest extends AbstractDecControllerTest
{

	protected $postContentWithRightDatabaseCredentialsAndCorrectNamespace = [
		"entityFilesNamespace" => "Test",
		"driver" => "pdo_mysql",
		"dbname" => "test",
		"user" => "root",
		"password" => "mysql",
	];
	protected $postContentWithNamespaceWithoutEntityFiles = [
		"entityFilesNamespace" => "Test_no_files_namespace", //namespace is correct and the driver also, yet the database access data is not.
		"driver" => "pdo_mysql",
		"dbname" => "test",
		"user" => "root",
		"password" => "mysql",
	];
	protected $postContentWithIncorrectDatabaseCredentials = [
		"entityFilesNamespace" => "Test", //namespace is correct and the driver also, yet the database access data is not.
		"driver" => "pdo_mysql",
		"dbname" => "test",
		"user" => "WRONG_USERNAME",
		"password" => "WRONG_DATABASE_PASSWORD",
	];
	protected $postContentWithNonExistingDatabase = [
		"entityFilesNamespace" => "Test",
		"driver" => "pdo_mysql",
		"dbname" => "not_existing_database_1234554321",
		"user" => "root",
		"password" => "mysql",
	];
	protected $testPost = [
		"entityFilesNamespace" => 123456789,
		"driver" => "pdo_mysql",
		"dbname" => "test",
		"user" => "root",
		"password" => "mysql",
	];


	public function testCreateSchemaActionRedirectsIfNotAjaxRequest()
	{
		$this->setUp();
		$this->dispatch('/createSchema');
		$this->assertResponseStatusCode(302);
		$this->assertModuleName('DEC');
		$this->assertControllerName('DEC\Controller\DbActions');
		$this->assertControllerClass('DbActionsController');
		$this->assertMatchedRouteName('createSchema');
		$this->assertRedirectTo('/');
	}
	public function testGetSchemaSqlActionRedirectsIfNotAjaxRequest()
	{
		$this->dispatch('/getSchemaSql');
		$this->assertResponseStatusCode(302);
		$this->assertModuleName('DEC');
		$this->assertControllerName('DEC\Controller\DbActions');
		$this->assertControllerClass('DbActionsController');
		$this->assertMatchedRouteName('getSchemaSql');
		$this->assertRedirectTo('/');
	}

	//testing for invalid form data response if not all required fields provided
	public function testCreateSchemaActionReturnsInvalidOnDbNameNotSupplied()
	{
		$this->dispatch("/createSchema", "POST",
			[
				"dbname" => "",
				"driver" => "test",
				"entityFilesNamespace" => "test",
				"user" => "test",
				"password" => "test",
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
	public function testCreateSchemaActionReturnsInvalidOnDriverNotSupplied()
	{
		$this->dispatch("/createSchema", "POST",
			[
				"dbname" => "test",
				"driver" => "",
				"entityFilesNamespace" => "test",
				"user" => "test",
				"password" => "test",
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
	public function testCreateSchemaActionReturnsInvalidOnEntityFilesNamespaceNotSupplied()
	{
		$this->dispatch("/createSchema", "POST",
			[
				"dbname" => "test",
				"driver" => "test",
				"entityFilesNamespace" => "",
				"user" => "test",
				"password" => "test",
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
	public function testCreateSchemaActionReturnsInvalidOnUserNotSupplied()
	{
		$this->dispatch("/createSchema", "POST",
			[
				"dbname" => "test",
				"driver" => "test",
				"entityFilesNamespace" => "test",
				"user" => "",
				"password" => "test",
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
	public function testCreateSchemaActionReturnsInvalidOnPasswordNotSupplied()
	{
		$this->dispatch("/createSchema", "POST",
			[
				"dbname" => "test",
				"driver" => "test",
				"entityFilesNamespace" => "test",
				"user" => "test",
				"password" => "",
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
	public function testGetSchemaSqlActionReturnsInvalidOnDbNameNotSupplied()
	{
		$this->dispatch("/getSchemaSql", "POST",
			[
				"dbname" => "",
				"driver" => "test",
				"entityFilesNamespace" => "test",
				"user" => "test",
				"password" => "test",
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
	public function testGetSchemaSqlActionReturnsInvalidOnDriverNotSupplied()
	{
		$this->dispatch("/getSchemaSql", "POST",
			[
				"dbname" => "test",
				"driver" => "",
				"entityFilesNamespace" => "test",
				"user" => "test",
				"password" => "test",
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
	public function testGetSchemaSqlActionReturnsInvalidOnEntityFilesNamespaceNotSupplied()
	{
		$this->dispatch("/getSchemaSql", "POST",
			[
				"dbname" => "test",
				"driver" => "test",
				"entityFilesNamespace" => "",
				"user" => "test",
				"password" => "test",
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
	public function testGetSchemaSqlActionReturnsInvalidOnUserNotSupplied()
	{
		$this->dispatch("/getSchemaSql", "POST",
			[
				"dbname" => "test",
				"driver" => "test",
				"entityFilesNamespace" => "test",
				"user" => "",
				"password" => "test",
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
	public function testGetSchemaSqlActionReturnsInvalidOnPasswordNotSupplied()
	{
		$this->dispatch("/getSchemaSql", "POST",
			[
				"dbname" => "test",
				"driver" => "test",
				"entityFilesNamespace" => "test",
				"user" => "test",
				"password" => "",
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

	//utility functions
	public function getDbActionsControllerWithVirtualPaths()
	{
		$directory = new vfsStreamDirectory('Test');
		vfsStreamWrapper::getRoot()->addChild($directory);
		$string = "<?php namespace Test;
							use Doctrine\\ORM\\Mapping as ORM;
							/**
							* @ORM\\Entity
							* @ORM\\Table(name=\"testsxyzabc123\")
							*/
							class Testsxyzabc123 {
								/**
								* @ORM\\Id
								* @ORM\\GeneratedValue(strategy=\"AUTO\")
								* @ORM\\Column(type=\"string\", name=\"id\")
								*/
								protected \$id;
								public function setId(\$id = null) {
									\$this->id = \$id;
									return \$this;
								}
								public function getId() {
									return \$this->id;
								}
							}";
		file_put_contents($this->saveDirectory . "/Test/Testsxyzabc123.php", $string);
		$form = new EntityForm();
		$controller = new DbActionsController( $form, $this->saveDirectory);
		$controller->setServiceLocator($this->serviceLocator);
		return $controller;
	}

	//test getSchemaSql action
	public function testGetSchemaSqlActionReturnsStringInResponse()
	{
		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'getSchemaSql');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithRightDatabaseCredentialsAndCorrectNamespace);

		//dispatch request and make assertions
		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("success", $responseContent['status']);
		$this->assertNotNull($responseContent['schemaSQL']);
		$this->assertStringStartsWith("CREATE TABLE", $responseContent['schemaSQL']);
	}
	public function testGetSchemaSqlActionOnWrongNamespaceSpecified()
	{
		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'getSchemaSql');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithNamespaceWithoutEntityFiles);

		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("nofiles", $responseContent['message']);
	}
	public function testGetSchemaSqlActionWhenSqlStringNotCreated()
	{
		$mockedSchemaService = $this->getMock(
			'DEC\Service\SchemaService', //original classname
			['getEntitiesMetadata'], // replaced methods
			[], //arguments
			'SchemaService', //classname
			true);//use original constructor
		$mockedSchemaService->expects($this->any())->method('getEntitiesMetadata')
			->will($this->returnValue(["dummyTestClassWhichIsNotPresent"]));
		$this->serviceLocator->setAllowOverride(true);
		$this->serviceLocator->setService('DEC\Service\SchemaService', $mockedSchemaService);

		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'getSchemaSql');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithRightDatabaseCredentialsAndCorrectNamespace);

		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("sqlstringfailed", $responseContent['message']);
	}
	public function testGetSchemaSqlActionWhenSqlArrayIsNotCreated()
	{
		//test for adding coverage for the line with exception on incorrect files - thrown in SchemaService by getMetadataForSingleClass()
		$mockedSchemaService = $this->getMock(
			'DEC\Service\SchemaService', //original classname
			['getArrayOfSqlLines'], //methods
			[], //arguments
			'SchemaService2', //classname
			false);//use original constructor

		$mockedSchemaService->expects($this->any())->method('getArrayOfSqlLines')
			->will($this->returnValue(false));

		$this->serviceLocator->setAllowOverride(true);
		$this->serviceLocator->setService('DEC\Service\SchemaService', $mockedSchemaService);

		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'getSchemaSql');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithRightDatabaseCredentialsAndCorrectNamespace);

		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("sqlstringfailed", $responseContent['message']);
	}

//	test createSchema action
	public function testCreateSchemaActionCreatesSchema()
	{
		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'createSchema');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithRightDatabaseCredentialsAndCorrectNamespace);

		//dispatch request and make assertions
		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("success", $responseContent['status']);
		$schemaService = $this->serviceLocator->get('DEC\Service\SchemaService');
		$postData = $this->postContentWithRightDatabaseCredentialsAndCorrectNamespace;
		$entityManager = $schemaService->createEM($this->saveDirectory, $postData['driver'], $postData['dbname'], $postData['user'], $postData['password']);
		$tables = $entityManager->getConnection()->getSchemaManager()->listTables();
		$tableNames = [];
		foreach($tables as $table) {
			$tableNames[] = $table->getName();
		}
		$this->assertContains("testsxyzabc123", $tableNames);

		//cleanup - remove the dummy table
		$entityManager->getConnection()->getSchemaManager()->dropTable("testsxyzabc123");
		$tables = $entityManager->getConnection()->getSchemaManager()->listTables();
		$tableNames = [];
		foreach($tables as $table) {
			$tableNames[] = $table->getName();
		}
		$this->assertNotContains("testsxyzabc123", $tableNames);
	}
	public function testCreateSchemaActionOnWrongNamespaceSpecified()
	{
		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'createSchema');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithNamespaceWithoutEntityFiles);

		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("nofiles", $responseContent['message']);
	}
	public function testCreateSchemaActionOnIncorrectDatabaseAccessCredentials()
	{
		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'createSchema');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithIncorrectDatabaseCredentials);

		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("noaccess", $responseContent['message']);
	}
	public function testCreateSchemaActionOnDatabaseError()
	{
		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'createSchema');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithNonExistingDatabase);

		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("dberror", $responseContent['message']);
	}
	public function testCreateSchemaActionOnIncorrectFilesInSaveDirectory()
	{
		//test for adding coverage for the line with exception on incorrect files - thrown in SchemaService by getMetadataForSingleClass()
		$mockedSchemaService = $this->getMock(
			'DEC\Service\SchemaService', //original classname
			['getMetadataForSingleClass'], //methods
			[], //arguments
			'SchemaService', //classname
			false);//use original constructor

		$mockedSchemaService->expects($this->any())->method('getMetadataForSingleClass')
			->will($this->throwException(new \Exception("test", 999)));

		$this->serviceLocator->setAllowOverride(true);
		$this->serviceLocator->setService('DEC\Service\SchemaService', $mockedSchemaService);

		$controller = $this->getDbActionsControllerWithVirtualPaths();
		$controller = $this->configureControllerForAGivenRoute($controller, 'createSchema');
		$request = $this->createAjaxRequestWithSpecificPostData($this->postContentWithRightDatabaseCredentialsAndCorrectNamespace);

		$result = $controller->dispatch($request);
		$response = $controller->getResponse();
		$this->assertEquals(200, $response->getStatusCode());
		$responseContent = $result->getVariables(); //because result is instance of Json view model
		$this->assertEquals("error", $responseContent['status']);
		$this->assertEquals("nofiles", $responseContent['message']);
	}

}