<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString14;

class MethodString14Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString14getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setTargetEntity("Application\\Entity\\TestTargetEntity");
        $property->setAssociation(14);
        $methodString14 = new MethodString14($property);
        $resultingMethodString = $methodString14->getStringFromStrategy();
        $expectedOutput = "\tpublic function addToTestName(\\Application\\Entity\\TestTargetEntity \$singleEntity) {\n\t\tif(!\$this->testName->contains(\$singleEntity)) {\n\t\t\t\$this->testName->add(\$singleEntity);\n\t\t\t\$singleEntity->addToTestName(\$this);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function addTestName(Collection \$testName) {\n\t\tforeach(\$testName as \$singleEntity) {\n\t\t\t\$this->addToTestName(\$singleEntity);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function removeFromTestName(\\Application\\Entity\\TestTargetEntity \$singleEntity) {\n\t\tif(\$this->testName->contains(\$singleEntity)) {\n\t\t\t\$this->testName->removeElement(\$singleEntity);\n\t\t\t\$singleEntity->removeFromTestName(\$this);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function removeTestName(Collection \$testName) {\n\t\tforeach(\$testName as \$singleEntity) {\n\t\t\t\$this->removeFromTestName(\$singleEntity);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function clearTestName() {\n\t\tforeach(\$this->testName as \$singleEntity) {\n\t\t\t\$this->removeFromTestName(\$singleEntity);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n\tpublic function setTestName(\$testName) {\n\t\t\$this->clearTestName();\n\t\tforeach(\$testName as \$singleEntity) {\n\t\t\t\$this->addToTestName(\$singleEntity);\n\t\t}\n\t\treturn \$this;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}