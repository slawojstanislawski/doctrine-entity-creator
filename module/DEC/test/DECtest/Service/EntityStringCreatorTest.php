<?php
namespace DECTest\Service;

use DEC\ClassString\ClassDataStringCreator;
use DEC\MethodString\MethodStringCreator;
use DEC\ORMString\ORMStringCreator;
use DEC\Service\EntityStringCreator;
use DEC\Service\PropertyExtractor;

class EntityStringCreatorTest extends \PHPUnit_Framework_TestCase {

    protected $postData = [
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

    protected function makeEntityStringCreator () {
        $propertyExtractor = new PropertyExtractor();
        $classDataStringCreator = new ClassDataStringCreator();
        $ormStringCreator = new ORMStringCreator();
        $methodsStringCreator = new MethodStringCreator();
        $entityStringCreator = new EntityStringCreator($propertyExtractor, $classDataStringCreator, $ormStringCreator, $methodsStringCreator);
        return $entityStringCreator;
    }

    public function testMakeFinalEntityString()
    {
        $entityStringCreator = $this->makeEntityStringCreator();
        $entityStringCreator->consumePostData($this->postData);
        $string = $entityStringCreator->makeFinalEntityString();
        $this->assertEquals("namespace Test;\n\nuse Doctrine\\ORM\\Mapping as ORM;\n\n/** \n* @ORM\\Entity\n* @ORM\\Table(name=\"tests\")\n*/\n\nclass Test {\n\n\t/** \n\t* @ORM\\Id\n\t* @ORM\\GeneratedValue(strategy=\"AUTO\")\n\t* @ORM\\Column(type=\"integer\", name=\"test\", options={\"default\":NULL})\n\t*/\n\tprotected \$test = NULL;\n\n\tpublic function setTest(\$test = null) {\n\t\t\$this->test = \$test;\n\t\treturn \$this;\n\t}\n\n\tpublic function getTest() {\n\t\treturn \$this->test;\n\t}\n\n}\n\n", $string);
    }

    public function testCreateJsonRepresentation()
    {
        $entityStringCreator = $this->makeEntityStringCreator();
        $entityStringCreator->consumePostData($this->postData);
        $jsonString = $entityStringCreator->createJsonRepresentation();
        $this->assertEquals('{"namespace":"Test","classname":"Test","tablename":"tests","repositoryclass":"","indexes":[],"entityProperties":[{"propertyName":"test","columnType":"integer","column":"test","default":"NULL","strategy":"AUTO","primary":"1","association":0}]}', $jsonString);
    }

}