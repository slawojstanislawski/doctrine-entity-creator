<?php
namespace DECTest\Service;

use DEC\ClassString\ClassDataStringCreator;
use DEC\MethodString\MethodStringCreator;
use DEC\ORMString\ORMStringCreator;
use DEC\Service\EntityStringCreator;
use DEC\Service\PropertyExtractor;
use DEC\Service\SaveFilesService;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamWrapper;

class SaveFilesServiceTest extends \PHPUnit_Framework_TestCase {

    protected $properPostData = [
        'namespace' => 'Test',
        'classname' => 'Test',
        'tablename' => 'tests',
        'repositoryclass' => '',
        'indexes' => [],
        'entityProperties' => [
            0 => [
                'propertyName' => 'test',
                'columnType' => "integer",
                'column' => 'test',
                'default' => 'NULL',
                'strategy' => "AUTO",
                'primary' => '1',
                'association' => 0,
            ],
        ],
    ];
	protected $postDataWithDuplicatePropertyNames = [
		'namespace' => 'Test',
		'classname' => 'Test',
		'tablename' => 'tests',
		'repositoryclass' => '',
		'indexes' => [],
		'entityProperties' => [
			0 => [
				'propertyName' => 'test',
			],
			1 => [
				'propertyName' => 'test',
			],
		],
	];

    protected function makeSaveFilesService () {
        $propertyExtractor = new PropertyExtractor();
        $classDataStringCreator = new ClassDataStringCreator();
        $ormStringCreator = new ORMStringCreator();
        $methodsStringCreator = new MethodStringCreator();
        $entityStringCreator = new EntityStringCreator($propertyExtractor, $classDataStringCreator, $ormStringCreator, $methodsStringCreator);

	    vfsStreamWrapper::register();
	    vfsStreamWrapper::setRoot(new vfsStreamDirectory("testSaveDir"));
	    $saveDirectory = vfsStream::url("testSaveDir");
	    $saveFilesService = new SaveFilesService($saveDirectory, $saveDirectory, $entityStringCreator);
        return $saveFilesService;
    }

	protected function makeSaveFilesServiceWithNoPermissionsFolder(){
		$saveFilesService = $this->makeSaveFilesService();
		vfsStreamWrapper::setRoot(new vfsStreamDirectory("testSaveDir", 000));
		return $saveFilesService;
	}

	protected function makeEntityStringCreatorWithNoStringCreation($jsonFailure = false)
	{
		$phpResultingString = ($jsonFailure) ? "" : "<pre>test entity string</pre>";
		$jsonResultingString = ($jsonFailure) ? "{\"testJsonSting\":\"testJsonString\"}" : "";

		$mockedEntityStringCreator = $this->getMock(
			'DEC\Service\EntityStringCreator', //original classname
			['getClassDataStringCreator', 'consumePostData', 'getNamespace', 'getClassname', 'makeFinalEntityString','createJsonRepresentation'], //methods
			[], //arguments
			'EntityStringCreatorForPhp', //classname
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
			->will($this->returnValue($phpResultingString));
		$mockedEntityStringCreator->expects($this->any())->method('createJsonRepresentation')
			->will($this->returnValue($jsonResultingString));
		return $mockedEntityStringCreator;
	}

	public function testSaveFileReturnsDuplicatePropertyMessage()
	{
		$saveFilesService = $this->makeSaveFilesService();
		$result = $saveFilesService->saveFiles($this->postDataWithDuplicatePropertyNames, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('duplicatePropertyNames', $result['message']);
	}

	public function testSaveFileReturnsDidntCreateFolderMessage()
	{
		$saveFilesService = $this->makeSaveFilesServiceWithNoPermissionsFolder();
		$result = $saveFilesService->saveFiles($this->properPostData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('didntcreatefolder', $result['message']);
	}

	public function testSaveFileReturnsStringNotCreatedMessageOnEntityStringNotCreated()
	{
		$saveFilesService = $this->makeSaveFilesService();
		$mockedEntityStringCreator = $this->makeEntityStringCreatorWithNoStringCreation(false);
		$saveFilesService->setEntityStringCreator($mockedEntityStringCreator);

		$result = $saveFilesService->saveFiles($this->properPostData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('stringnotcreated', $result['message']);
	}
	public function testSaveFileReturnsStringNotCreatedMessageOnJsonStringNotCreated()
	{
		$saveFilesService = $this->makeSaveFilesService();
		$mockedEntityStringCreator = $this->makeEntityStringCreatorWithNoStringCreation(true);
		$saveFilesService->setEntityStringCreator($mockedEntityStringCreator);

		$result = $saveFilesService->saveFiles($this->properPostData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('stringnotcreated', $result['message']);
	}

	public function testSaveFileSavesFilesAsIntended()
	{
		$saveFilesService = $this->makeSaveFilesService();
		$result = $saveFilesService->saveFiles($this->properPostData, ['status' => 'error']);
		$this->assertEquals('success', $result['status']);
	}

}