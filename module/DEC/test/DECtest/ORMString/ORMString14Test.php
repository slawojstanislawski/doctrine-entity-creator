<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString14Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithOnlyAllRequiredParameters(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\")\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithAllRequiredParametersAndIndexBy(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'indexBy' => 'testIndexBy'
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", indexBy=\"testIndexBy\")\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	public function testBuildStringWithCascadeAll(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"all"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"all\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\", onDelete=\"CASCADE\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersist(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"persist"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"merge\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeDetach(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"detach"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"detach\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRefresh(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"refresh"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"refresh\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"remove\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\", onDelete=\"CASCADE\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMerge(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"persist", "merge"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"merge\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"persist", "remove"}',
					],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"remove\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\", onDelete=\"CASCADE\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithCascadePersistMergeRemove(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'association' => 14,
					'targetEntity' => 'Application\Entity\TestTargetEntity',
					'joinTable' => 'testJoinTable',
					'joinColumn1' => "testJoinColumn1",
					'refColumn1' => 'testRefColumn1',
					'joinColumn2' => "testJoinColumn2",
					'refColumn2' => 'testRefColumn2',
					'cascade' => '{"persist", "merge", "remove"}',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\ManyToMany(targetEntity=\"Application\\Entity\\TestTargetEntity\", cascade={\"persist\", \"merge\", \"remove\"})\n\t* @ORM\\JoinTable(name=\"testJoinTable\",\n\t*\tjoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn1\", referencedColumnName=\"testRefColumn1\")},\n\t*\tinverseJoinColumns={@ORM\\JoinColumn(name=\"testJoinColumn2\", referencedColumnName=\"testRefColumn2\", onDelete=\"CASCADE\")}\n\t* )\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 