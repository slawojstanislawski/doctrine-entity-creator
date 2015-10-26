<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString7Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithNoCascadeSpecified(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\")\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	public function testBuildStringWithCascadeAll(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"all"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"all\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersist(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"persist"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"merge\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeDetach(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"detach"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"detach\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRefresh(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"refresh"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"refresh\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"persist", "merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"merge\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"persist", "remove"}',
					],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMergeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 7,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'cascade' => '{"persist", "merge", "remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"merge\", \"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 