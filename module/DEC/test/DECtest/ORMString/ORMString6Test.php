<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString6Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithAllTheParametersProvided(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 6,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 