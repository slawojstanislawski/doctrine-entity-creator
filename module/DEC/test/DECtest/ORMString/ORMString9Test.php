<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString9Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithOnlyAllRequiredParameters(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 9,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithAllRequiredParametersAndIndexBy(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 9,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'indexBy' => 'testIndexBy'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", indexBy=\"testIndexBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 