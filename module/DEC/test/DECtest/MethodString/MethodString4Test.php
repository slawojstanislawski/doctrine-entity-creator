<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString4;

class MethodString4Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString4getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setTargetEntity("Application\\Entity\\TestTargetEntity");
        $property->setAssociation(4);
        $methodString4 = new MethodString4($property);
        $resultingMethodString = $methodString4->getStringFromStrategy();
        $expectedOutput = "\tpublic function addToTestName(\\Application\\Entity\\TestTargetEntity \$singleEntity) {\n\t\t\$this->testName->add(\$singleEntity);\n\t\treturn \$this;\n\t}\n\n\tpublic function addTestName(Collection \$testName) {\n\t\tforeach(\$testName as \$singleEntity) {\n\t\t\t\$this->testName->add(\$singleEntity);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function removeFromTestName(\\Application\\Entity\\TestTargetEntity \$singleEntity) {\n\t\t\$this->testName->removeElement(\$singleEntity);\n\t\treturn \$this;\n\t}\n\n\tpublic function removeTestName(Collection \$testName) {\n\t\tforeach(\$testName as \$singleEntity) {\n\t\t\t\$this->testName->removeElement(\$singleEntity);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function clearTestName() {\n\t\t\$this->testName->clear();\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n\tpublic function setTestName(\$testName) {\n\t\t\$this->clearTestName();\n\t\tforeach(\$testName as \$singleEntity) {\n\t\t\t\$this->addToTestName(\$singleEntity);\n\t\t}\n\t\treturn \$this;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}