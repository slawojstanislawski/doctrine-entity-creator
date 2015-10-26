<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString2Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithAllRequiredOptionsProvided(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 2,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => "testMappedBy",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 