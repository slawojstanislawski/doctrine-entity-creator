<?php

namespace DECtest\Service;

use DEC\Service\SchemaService;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamWrapper;

class SchemaServiceTest extends \PHPUnit_Framework_TestCase {

	protected $correctDbData = [
		'driver' => 'pdo_mysql',
		'dbname' => 'test',
		'user' => 'root',
		'password' => 'mysql',
		'entityFilesNamespace' => 'Test'
	];
	protected $invalidCredentialsDbData = [
		'driver' => 'pdo_mysql',
		'dbname' => 'test',
		'user' => 'invalid',
		'password' => 'invalid',
		'entityFilesNamespace' => 'Test'
	];
	protected $dbErrorData = [
		'driver' => 'pdo_mysql',
		'dbname' => 'invalid_nonexisting_database_98765',
		'user' => 'root',
		'password' => 'mysql',
		'entityFilesNamespace' => 'Test'
	];

	//utility function
	protected function getSaveDirectory($filesPresent = false)
	{
		vfsStreamWrapper::register();
		vfsStreamWrapper::setRoot(new vfsStreamDirectory("testSaveDir"));
		if($filesPresent) {
			$file = new vfsStreamFile('Test.php');
			$string = "<?php namespace Test;
							use Doctrine\\ORM\\Mapping as ORM;
							/**
							* @ORM\\Entity
							* @ORM\\Table(name=\"test\")
							*/
							class Test {
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
			$file->setContent($string);
			$directory = new vfsStreamDirectory('Test');
			$directory->addChild($file);
			vfsStreamWrapper::getRoot()->addChild($directory);
		}
		return vfsStream::url("testSaveDir");
	}

	//test createEm()
	public function testCreateEmReturnsDoctrineEntityManager()
	{
		$schemaService = new SchemaService();
		$params = $this->correctDbData;
		$saveDirectory = $this->getSaveDirectory(false);
		$em = $schemaService->createEM($saveDirectory, $params['driver'], $params['dbname'], $params['user'], $params['password']);
		$this->assertInstanceOf('Doctrine\ORM\EntityManager', $em);
	}

	//test createSchema()
	public function testCreateSchemaReturnsNofilesMessage()
	{
		$schemaService = new SchemaService();
		$saveDirectory = $this->getSaveDirectory(false);
		$result = $schemaService->createSchema($saveDirectory, $this->correctDbData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('nofiles', $result['message']);
	}
	public function testCreateSchemaReturnsNoAccessMessage()
	{
		$schemaService = new SchemaService();
		$saveDirectory = $this->getSaveDirectory(true);
		$result = $schemaService->createSchema($saveDirectory, $this->invalidCredentialsDbData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('noaccess', $result['message']);
	}
	public function testCreateSchemaReturnsDbErrorMessage()
	{
		$schemaService = new SchemaService();
		$saveDirectory = $this->getSaveDirectory(true);
		$result = $schemaService->createSchema($saveDirectory, $this->dbErrorData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('dberror', $result['message']);
	}
	public function testCreateSchemaCreatesSchema()
	{
		$schemaService = new SchemaService();
		$saveDirectory = $this->getSaveDirectory(true);
		$result = $schemaService->createSchema($saveDirectory, $this->correctDbData, ['status' => 'error']);
		$this->assertEquals('success', $result['status']);
	}

	//test getSchemaSql()
	public function testGetSchemaSqlReturnsNofilesMessage()
	{
		$schemaService = new SchemaService();
		$saveDirectory = $this->getSaveDirectory(false);
		$result = $schemaService->getSchemaSql($saveDirectory, $this->correctDbData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('nofiles', $result['message']);
	}
	public function testGetSchemaSqlReturnsSqlStringFailedAccessMessage()
	{
		$mockedSchemaService = $this->getMock(
			'DEC\Service\SchemaService', //original classname
			['getEntitiesMetadata'], // replaced methods
			[], //arguments
			'DummySchemaService', //classname
			true);//use original constructor
		$mockedSchemaService->expects($this->any())->method('getEntitiesMetadata')
			->will($this->returnValue(["dummyTestClassWhichIsNotPresent"]));
		$saveDirectory = $this->getSaveDirectory(true);
		$result = $mockedSchemaService->getSchemaSql($saveDirectory, $this->correctDbData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('sqlstringfailed', $result['message']);
	}

} 