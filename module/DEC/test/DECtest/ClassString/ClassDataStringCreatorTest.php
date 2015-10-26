<?php
namespace DECTest\ClassString;

use DEC\ClassString\ClassDataStringCreator;
use DEC\Entity\Property;

class ClassDataStringCreatorTest extends \PHPUnit_Framework_TestCase {

    public function testConsumePostData()
    {
        $classDataStringCreator = new ClassDataStringCreator();
        $postData = [
           'namespace' => 'Application\Entity',
            'classname' => 'Test',
            'tablename' => 'tests',
            'repositoryclass' => 'Application\Repositories\TestRepository',
            'indexes' => [
                0 => [
                    'index' => 'indexName',
                    'columns' => 'col1, col2, col3'
                ],
            ],
        ];
        $classDataStringCreator->consumePostData($postData);
        $this->assertEquals('Application\Entity', $classDataStringCreator->getNamespace());
        $this->assertEquals('Test', $classDataStringCreator->getClassName());
        $this->assertEquals('tests', $classDataStringCreator->getTableName());
        $this->assertEquals('Application\Repositories\TestRepository', $classDataStringCreator->getRepositoryClass());
        $this->assertEquals([
            0 => [
                'index' => 'indexName',
                'columns' => 'col1, col2, col3'
            ],
        ], $classDataStringCreator->getIndexes());
    }
    public function testCreateConstructorStringIfPropertyArrayHasAtLeastOnePropertyBeingACollection()
    {
        $classDataStringCreator = new ClassDataStringCreator();
        $propertyOne = new Property();
        $propertyOne->setPropertyName("testNameOne");
        $propertyOne->setAssociation(4);
        $propertyTwo = new Property();
        $propertyTwo->setPropertyName("testNameTwo");
        $propertyTwo->setAssociation(8);
        $propertyObjects = [0 => $propertyOne, 1 => $propertyTwo];
        $doctrineRelationsWithCollection = [4, 5, 8, 9, 10, 12, 14];
        $constructorString = $classDataStringCreator->createConstructorString($propertyObjects,$doctrineRelationsWithCollection);
        $this->assertEquals("\tpublic function __construct() {\n\t\t\$this->testNameOne = new ArrayCollection();\n\t\t\$this->testNameTwo = new ArrayCollection();\n\t}\n\n", $constructorString);
    }
    public function testCreateConstructorStringIfPropertyArrayDoesNotHaveOnePropertyBeingACollection()
    {
        $classDataStringCreator = new ClassDataStringCreator();
        $propertyOne = new Property();
        $propertyOne->setPropertyName("testNameOne");
        $propertyOne->setAssociation(1);
        $propertyTwo = new Property();
        $propertyTwo->setPropertyName("testNameTwo");
        $propertyTwo->setAssociation(2);
        $propertyObjects = [0 => $propertyOne, 1 => $propertyTwo];
        $doctrineRelationsWithCollection = [4, 5, 8, 9, 10, 12, 14];
        $constructorString = $classDataStringCreator->createConstructorString($propertyObjects,$doctrineRelationsWithCollection);
        $this->assertEquals("", $constructorString);
    }
    public function testGetClassDataStringWithAllPossibleInputs()
    {
        $classDataStringCreator = new ClassDataStringCreator();
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(4);
        $postData = [
            'namespace' => 'Application\Entity',
            'classname' => 'Test',
            'tablename' => 'tests',
            'repositoryclass' => 'Application\Repositories\TestRepository',
            'indexes' => [
                0 => [
                    'index' => 'indexName',
                    'columns' => 'col1, col2, col3'
                ],
            ],
        ];
        $doctrineRelationsWithCollection = [4, 5, 8, 9, 10, 12, 14];
        $classDataStringCreator->consumePostData($postData);
        $classDataString = $classDataStringCreator->getClassDataString([0 => $property], $doctrineRelationsWithCollection);
        $expectedOutpuString = "namespace Application\\Entity;\n\nuse Doctrine\\Common\\Collections\\ArrayCollection;\nuse Doctrine\\Common\\Collections\\Collection;\nuse Doctrine\\ORM\\Mapping as ORM;\n\n/** \n* @ORM\\Entity(repositoryClass=\"Application\\Repositories\\TestRepository\")\n* @ORM\\Table(name=\"tests\", indexes={\n*\t@ORM\\Index(name=\"indexName\", columns={\"col1\", \"col2\", \"col3\"})\n* })\n*/\n\nclass Test {\n\n";
        $this->assertEquals($expectedOutpuString, $classDataString);
    }
    public function testGetClassDataStringWithoutProvidingIndexes()
    {
        $classDataStringCreator = new ClassDataStringCreator();
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(4);
        $postData = [
            'namespace' => 'Application\Entity',
            'classname' => 'Test',
            'tablename' => 'tests',
            'repositoryclass' => 'Application\Repositories\TestRepository',
            'indexes' => [],
        ];
        $doctrineRelationsWithCollection = [4, 5, 8, 9, 10, 12, 14];
        $classDataStringCreator->consumePostData($postData);
        $classDataString = $classDataStringCreator->getClassDataString([0 => $property], $doctrineRelationsWithCollection);
        $expectedOutpuString = "namespace Application\\Entity;\n\nuse Doctrine\\Common\\Collections\\ArrayCollection;\nuse Doctrine\\Common\\Collections\\Collection;\nuse Doctrine\\ORM\\Mapping as ORM;\n\n/** \n* @ORM\\Entity(repositoryClass=\"Application\\Repositories\\TestRepository\")\n* @ORM\\Table(name=\"tests\")\n*/\n\nclass Test {\n\n";
        $this->assertEquals($expectedOutpuString, $classDataString);
    }
    public function testGetClassDataStringWithoutRepositoryClass()
    {
        $classDataStringCreator = new ClassDataStringCreator();
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(4);
        $postData = [
            'namespace' => 'Application\Entity',
            'classname' => 'Test',
            'tablename' => 'tests',
            'repositoryclass' => '',
            'indexes' => [
                0 => [
                    'index' => 'indexName',
                    'columns' => 'col1, col2, col3'
                ],
            ],
        ];
        $doctrineRelationsWithCollection = [4, 5, 8, 9, 10, 12, 14];
        $classDataStringCreator->consumePostData($postData);
        $classDataString = $classDataStringCreator->getClassDataString([0 => $property], $doctrineRelationsWithCollection);
        $expectedOutpuString = "namespace Application\\Entity;\n\nuse Doctrine\\Common\\Collections\\ArrayCollection;\nuse Doctrine\\Common\\Collections\\Collection;\nuse Doctrine\\ORM\\Mapping as ORM;\n\n/** \n* @ORM\\Entity\n* @ORM\\Table(name=\"tests\", indexes={\n*\t@ORM\\Index(name=\"indexName\", columns={\"col1\", \"col2\", \"col3\"})\n* })\n*/\n\nclass Test {\n\n";
        $this->assertEquals($expectedOutpuString, $classDataString);
    }
    public function testGetClassDataStringWithPropertyNotBeingACollection()
    {
        $classDataStringCreator = new ClassDataStringCreator();
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(6);
        $postData = [
            'namespace' => 'Application\Entity',
            'classname' => 'Test',
            'tablename' => 'tests',
            'repositoryclass' => 'Application\Repositories\TestRepository',
            'indexes' => [
                0 => [
                    'index' => 'indexName',
                    'columns' => 'col1, col2, col3'
                ],
            ],
        ];
        $doctrineRelationsWithCollection = [4, 5, 8, 9, 10, 12, 14];
        $classDataStringCreator->consumePostData($postData);
        $classDataString = $classDataStringCreator->getClassDataString([0 => $property], $doctrineRelationsWithCollection);
        $expectedOutpuString = "namespace Application\\Entity;\n\nuse Doctrine\\ORM\\Mapping as ORM;\n\n/** \n* @ORM\\Entity(repositoryClass=\"Application\\Repositories\\TestRepository\")\n* @ORM\\Table(name=\"tests\", indexes={\n*\t@ORM\\Index(name=\"indexName\", columns={\"col1\", \"col2\", \"col3\"})\n* })\n*/\n\nclass Test {\n\n";
        $this->assertEquals($expectedOutpuString, $classDataString);
    }
}