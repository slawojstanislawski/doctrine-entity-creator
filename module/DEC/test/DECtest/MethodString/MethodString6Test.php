<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString6;

class MethodString6Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString6getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setTargetEntity("Application\\Entity\\TestTargetEntity");
        $property->setInverse("testInversedBy");
        $property->setAssociation(6);
        $methodString6 = new MethodString6($property);
        $resultingMethodString = $methodString6->getStringFromStrategy();
        $expectedOutput = "\tpublic function setTestName(\\Application\\Entity\\TestTargetEntity \$testName = null) {\n\t\t\$this->testName = \$testName;\n\t\t(\$this->testName) ? \$this->testName->addToTestInversedBy(\$this) : \$this->testName->removeFromTestInversedBy(\$this);\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}