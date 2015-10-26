<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString1;

class MethodString1Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString1getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(1);
        $methodString1 = new MethodString1($property);
        $resultingMethodString = $methodString1->getStringFromStrategy();
        $expectedOutput = "\tpublic function setTestName(\$testName = null) {\n\t\t\$this->testName = \$testName;\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}