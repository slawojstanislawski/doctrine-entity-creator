<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString11;

class MethodString11Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString11getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(11);
        $methodString11 = new MethodString11($property);
        $resultingMethodString = $methodString11->getStringFromStrategy();
        $expectedOutput = "\tpublic function setTestName(\$testName = null) {\n\t\t\$this->testName = \$testName;\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}