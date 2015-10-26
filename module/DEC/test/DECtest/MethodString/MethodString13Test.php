<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString13;

class MethodString13Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString13getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(13);
        $methodString13 = new MethodString13($property);
        $resultingMethodString = $methodString13->getStringFromStrategy();
        $expectedOutput = "\tpublic function setTestName(\$testName = null) {\n\t\t\$this->testName = \$testName;\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}