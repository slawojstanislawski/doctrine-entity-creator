<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString10Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithOnlyAllRequiredParameters(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithAllRequiredParametersAndIndexBy(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'indexBy' => 'testIndexBy',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", indexBy=\"testIndexBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	public function testBuildStringWithCascadeAll(){
			$propertyExtractor = new PropertyExtractor();
			$postData = [
				'entityProperties' => [
					0 => [
						'propertyName' => 'test',
						'association' => 10,
						'targetEntity' => 'Application\Entity\TestTargetEntity',
						'inverse' => 'testInversedBy',
						'cascade' => '{"all"}',
					],
				],
			];
			$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
			$ormStringCreator = new ORMStringCreator();
			$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
			$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"all\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
		}
	public function testBuildStringWithCascadePersist(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"persist"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"merge\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeDetach(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"detach"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"detach\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRefresh(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"refresh"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"refresh\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"remove\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"persist", "merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\", \"merge\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"persist", "remove"}',
					],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\", \"remove\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMergeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 10,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => 'testInversedBy',
					'cascade' => '{"persist", "merge", "remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\", \"merge\", \"remove\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 