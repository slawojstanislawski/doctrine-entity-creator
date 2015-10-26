<?php

namespace DECtest\Common;

use DEC\Common\Utils;

class UtilsTest extends \PHPUnit_Framework_TestCase {

	const DS = DIRECTORY_SEPARATOR;

	public function testReplaceSlashesWithSystemSeparator()
	{
		$testString = "Test\\Test\\Test";
		$result = Utils::replaceSlashesWithSystemSeparator($testString);
		$this->assertEquals("Test" . self::DS . "Test" . self::DS ."Test", $result);
	}
	public function testAreThereDuplicatePropertyNamesReturnsTrue()
	{
		$testPostData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
				],
				1 => [
					'propertyName' => 'test',
				],
			]
		];
		$result = Utils::areThereDuplicatePropertyNames($testPostData);
		$this->assertEquals(true, $result);
	}
	public function testAreThereDuplicatePropertyNamesReturnsFalse()
	{
		$testPostData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
				],
				1 => [
					'propertyName' => 'test2',
				],
			]
		];
		$result = Utils::areThereDuplicatePropertyNames($testPostData);
		$this->assertEquals(false, $result);
	}
	public function testReturnResultWithErrorMessage()
	{
		$test = [];
		$result = Utils::returnResultWithErrorMessage($test, "testMessage");
		$this->assertArrayHasKey('message', $result);
		$this->assertEquals('testMessage', $result['message']);
	}

} 