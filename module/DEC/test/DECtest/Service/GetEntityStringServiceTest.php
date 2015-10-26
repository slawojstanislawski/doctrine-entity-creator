<?php
namespace DECTest\Service;

use DEC\ClassString\ClassDataStringCreator;
use DEC\MethodString\MethodStringCreator;
use DEC\ORMString\ORMStringCreator;
use DEC\Service\EntityStringCreator;
use DEC\Service\GetEntityStringService;
use DEC\Service\PropertyExtractor;

class GetEntityStringServiceTest extends \PHPUnit_Framework_TestCase {

    protected $properPostData = [
        'namespace' => 'Test',
        'classname' => 'Test',
        'tablename' => 'tests',
        'repositoryclass' => '',
        'indexes' => [],
        'entityProperties' => [
            0 => [
                'propertyName' => 'test',
                'columnType' => "integer",
                'column' => 'test',
                'default' => 'NULL',
                'strategy' => "AUTO",
                'primary' => '1',
                'association' => 0,
            ],
        ],
    ];
	protected $postDataWithDuplicatePropertyNames = [
		'namespace' => 'Test',
		'classname' => 'Test',
		'tablename' => 'tests',
		'repositoryclass' => '',
		'indexes' => [],
		'entityProperties' => [
			0 => [
				'propertyName' => 'test',
			],
			1 => [
				'propertyName' => 'test',
			],
		],
	];

    protected function makeGetEntityStringService () {
        $propertyExtractor = new PropertyExtractor();
        $classDataStringCreator = new ClassDataStringCreator();
        $ormStringCreator = new ORMStringCreator();
        $methodsStringCreator = new MethodStringCreator();
        $entityStringCreator = new EntityStringCreator($propertyExtractor, $classDataStringCreator, $ormStringCreator, $methodsStringCreator);
	    $getEntityStringService = new GetEntityStringService($entityStringCreator);
        return $getEntityStringService;
    }

    public function testGetStringReturnsEntityString()
    {
	    $getEntityStringService = $this->makeGetEntityStringService();
	    $result = $getEntityStringService->getString($this->properPostData, ['status' => 'error']);
        $this->assertEquals("<pre>namespace Test;\n\nuse Doctrine\\ORM\\Mapping as ORM;\n\n/** \n* @ORM\\Entity\n* @ORM\\Table(name=\"tests\")\n*/\n\nclass Test {\n\n\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"AUTO\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"default\":NULL})\n\t*/\n\tprotected \$test = NULL;\n\n\tpublic function setTest(\$test = null) {\n\t\t\$this->test = \$test;\n\t\treturn \$this;\n\t}\n\n\tpublic function getTest() {\n\t\treturn \$this->test;\n\t}\n\n}\n\n</pre>", $result['entityString']);
    }

	public function testGetStringReturnsDuplicatePropertyMessage()
	{
		$getEntityStringService = $this->makeGetEntityStringService();
		$result = $getEntityStringService->getString($this->postDataWithDuplicatePropertyNames, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('duplicatePropertyNames', $result['message']);
	}

	public function testGetStringReturnsStringNotCreatedMessage()
	{
		$getEntityStringService = $this->makeGetEntityStringService();
		$mockedEntityStringCreator = $this->getMock('DEC\Service\EntityStringCreator',
			['consumePostData', 'makeFinalEntityString'],
			[],
			'MockedEntityStringCreator',
			false);
		$mockedEntityStringCreator->expects($this->any())->method('consumePostData')
			->will($this->returnSelf());
		$mockedEntityStringCreator->expects($this->any())->method('makeFinalEntityString')
			->will($this->returnValue(''));
		$getEntityStringService->setEntityStringCreator($mockedEntityStringCreator);

		$result = $getEntityStringService->getString($this->properPostData, ['status' => 'error']);
		$this->assertEquals('error', $result['status']);
		$this->assertEquals('stringnotcreated', $result['message']);
	}

}