<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString1Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithNoCascadeSpecified(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\")\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	public function testBuildStringWithCascadeAll(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"all"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"all\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersist(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"persist"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"merge"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"merge\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeDetach(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"detach"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"detach\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRefresh(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"refresh"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"refresh\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"remove"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"persist", "merge"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"merge\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"persist", "remove"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMergeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 1,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'cascade' => '{"persist", "merge", "remove"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"merge\", \"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 