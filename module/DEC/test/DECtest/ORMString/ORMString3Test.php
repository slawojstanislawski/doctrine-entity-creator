<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString3Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithNoCascadeSpecified(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\")\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	public function testBuildStringWithCascadeAll(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"all"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"all\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersist(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"persist"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"merge"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"merge\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeDetach(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"detach"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"detach\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRefresh(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"refresh"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"refresh\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"remove"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"persist", "merge"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\", \"merge\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"persist", "remove"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\", \"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMergeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 3,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'inverse' => "testInversedBy",
					'cascade' => '{"persist", "merge", "remove"}',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\OneToOne(targetEntity=\"Application\\Entity\\TestTargetEntity\", inversedBy=\"testInversedBy\", cascade={\"persist\", \"merge\", \"remove\"})\n\t* @ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\", nullable=true, onDelete=\"SET NULL\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 