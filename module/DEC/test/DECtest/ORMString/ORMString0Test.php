<?php
namespace DECTest\ORMString;

use DEC\ORMString\ORMStringCreator;
use DEC\Service\PropertyExtractor;

class ORMString0Test extends \PHPUnit_Framework_TestCase {

	public function testBuildStringWithAllPossibleParametersProvided(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'default' => 'NULL',
					'strategy' => "AUTO",
					'nullable' => '1',
					'primary' => '1',
					'association' => 0,
					'unique' => 1,
					'unsigned' => 1,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"AUTO\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\", unique=true, nullable=true, options={\"unsigned\":true, \"default\":NULL})\n\t*/\n\tprotected \$test = NULL;\n\n", $ormStringFinalOutput);
	}

	//testing strategies
	public function testBuildStringWithPrimaryAndStrategyAuto(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'strategy' => "AUTO",
					'primary' => '1',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"AUTO\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithPrimaryAndStrategySequence(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'strategy' => "SEQUENCE",
					'primary' => '1',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"SEQUENCE\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithPrimaryAndStrategyIdentity(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'strategy' => "IDENTITY",
					'primary' => '1',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"IDENTITY\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithPrimaryAndStrategyTable(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'strategy' => "TABLE",
					'primary' => '1',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"TABLE\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithPrimaryAndStrategyNone(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'strategy' => "NONE",
					'primary' => '1',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"NONE\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	//testing available column types
	public function testBuildStringWithColumnTypeString(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "string",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"string\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeInteger(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeSmallint(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "smallint",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"smallint\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeBigint(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "bigint",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"bigint\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeBoolean(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "boolean",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"boolean\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeDecimal(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "decimal",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"decimal\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeDate(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "date",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"date\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeTime(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "time",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"time\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeDatetime(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "datetime",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"datetime\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeText(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "text",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"text\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeObject(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "object",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"object\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeArray(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "array",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"array\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithColumnTypeFloat(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "float",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"float\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	//testing unsigned
	public function testBuildStringWithUnsignedAsOnlyOption(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'unsigned' => 1,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"unsigned\":true})\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	//testing default
	public function testBuildStringWithDefaultAsNull(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'default' => "NULL",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"default\":NULL})\n\t*/\n\tprotected \$test = NULL;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithDefaultAsTrue(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'default' => "true",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"default\":true})\n\t*/\n\tprotected \$test = true;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithDefaultAsFalse(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'default' => "false",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"default\":false})\n\t*/\n\tprotected \$test = false;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithDefaultAsNumeric(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'default' => "1000",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"default\":1000})\n\t*/\n\tprotected \$test = 1000;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWithDefaultAsString(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'default' => "testString",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"default\":\"testString\"})\n\t*/\n\tprotected \$test = \"testString\";\n\n", $ormStringFinalOutput);
	}

	//testing unique
	public function testBuildStringWithUniqueAsOnlyOption(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'unique' => 1,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", unique=true)\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	//testing nullable
	public function testBuildStringWithNullable(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'nullable' => '1',
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\", nullable=true)\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	//testing primary
	public function testBuildStringWithPrimary(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
					'primary' => '1',
					'strategy' => "AUTO",
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"AUTO\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

	//no additional input
	public function testBuildStringWithJustRequiredMinimumInput(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}
	public function testBuildStringWhenColumnNameOtherThanPropertyName(){
		$propertyExtractor = new PropertyExtractor();
		$postData = [
			'entityProperties' => [
				0 => [
					'propertyName' => 'test',
					'columnType' => "integer",
					'column' => 'test_test',
					'association' => 0,
				],
			],
		];
		$propertiesArray = $propertyExtractor->convertPostToPropertyObjects($postData);
		$ormStringCreator = new ORMStringCreator();
		$ormStringFinalOutput = $ormStringCreator->getORMStringsForProperties($propertiesArray);
		$this->assertEquals("\t/** \n\t* @ORM\\Column(type=\"integer\", name=\"test_test\")\n\t*/\n\tprotected \$test;\n\n", $ormStringFinalOutput);
	}

} 