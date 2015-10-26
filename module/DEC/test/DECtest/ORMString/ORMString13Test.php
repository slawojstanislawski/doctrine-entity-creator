<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString13Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithAllRequiredParameters(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 13,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\")\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 