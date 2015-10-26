<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString12Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithOnlyAllRequiredParameters(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithAllRequiredParametersAndIndexBy(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'indexBy' => 'testIndexBy'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", indexBy=\"testIndexBy\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	public function testBuildStringWithCascadeAll(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"all"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"all\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersist(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"persist"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"persist\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"merge\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeDetach(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"detach"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"detach\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRefresh(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"refresh"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"refresh\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"remove\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"persist", "merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"persist\", \"merge\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"persist", "remove"}',
					],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"persist\", \"remove\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMergeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 12,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'map' => 'testMappedBy',
					'cascade' => '{"persist", "merge", "remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", mappedBy=\"testMappedBy\", cascade={\"persist\", \"merge\", \"remove\"})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 