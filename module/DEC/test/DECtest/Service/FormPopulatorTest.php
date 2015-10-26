<?php
namespace DECTest\Service;

use DEC\Service\FormPopulator;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamWrapper;

class FormPopulatorTest extends \PHPUnit_Framework_TestCase {

    protected function makeFormPopulator ($filesPresent = false) {
	    vfsStreamWrapper::register();
	    vfsStreamWrapper::setRoot(new vfsStreamDirectory("testSaveDir"));
	    if($filesPresent) {
		    $file = new vfsStreamFile('Test.json');
		    $file->setContent("{\"just test json\" : \"just test json\"}");
		    $directory = new vfsStreamDirectory('Test');
		    $directory->addChild($file);
		    vfsStreamWrapper::getRoot()->addChild($directory);
	    }
	    $formPopulator = new FormPopulator(vfsStream::url("testSaveDir"));
	    return $formPopulator;
    }

	public function testpopulateFormOnFilesPresent()
	{
		$formPopulator = $this->makeFormPopulator(true);
		$resultArray = $formPopulator->populateForm(['classname' => 'Test\Test'], ['status' => 'error']);
		$this->assertEquals("success", $resultArray['status']);
		$this->assertEquals("{\"just test json\" : \"just test json\"}", $resultArray['json']);
	}

	public function testpopulateFormOnFilesNotPresent()
	{
		$formPopulator = $this->makeFormPopulator(false);
		$resultArray = $formPopulator->populateForm(['classname' => 'Test\Test'], ['status' => 'error']);
		$this->assertEquals("error", $resultArray['status']);
	}

}