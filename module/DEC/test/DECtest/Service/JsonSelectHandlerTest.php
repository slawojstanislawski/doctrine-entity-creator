<?php
namespace DECTest\Service;

use DEC\Service\JsonSelectHandler;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamWrapper;

class JsonSelectHandlerTest extends \PHPUnit_Framework_TestCase {

    protected function makeJsonSelectHandler ($filesPresent = false) {
	    vfsStreamWrapper::register();
	    vfsStreamWrapper::setRoot(new vfsStreamDirectory("testSaveDir"));
	    if($filesPresent) {
		    $directory = new vfsStreamDirectory('Test');
		    $directory->addChild(new vfsStreamFile('Test.json'));
		    vfsStreamWrapper::getRoot()->addChild($directory);
	    }
	    $jsonSelectHandler = new JsonSelectHandler(vfsStream::url("testSaveDir"));
	    return $jsonSelectHandler;
    }

	public function testPopulateJsonSelectMenuOnFilesPresent()
	{
		$jsonSelectHandler = $this->makeJsonSelectHandler(true);
		$resultArray = $jsonSelectHandler->populateJsonSelectMenu(['status' => 'error']);
		$this->assertContains("Test\\Test", $resultArray['classnames']);
		$this->assertEquals("success", $resultArray['status']);
	}

	public function testPopulateJsonSelectMenuOnFilesNotPresent()
	{
		$jsonSelectHandler = $this->makeJsonSelectHandler(false);
		$resultArray = $jsonSelectHandler->populateJsonSelectMenu(['status' => 'error']);
		$this->assertEquals("error", $resultArray['status']);
	}

}