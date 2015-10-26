<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString7;

class MethodString7Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString7getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(7);
        $methodString7 = new MethodString7($property);
        $resultingMethodString = $methodString7->getStringFromStrategy();
        $expectedOutput = "\tpublic function setTestName(\$testName = null) {\n\t\t\$this->testName = \$testName;\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}