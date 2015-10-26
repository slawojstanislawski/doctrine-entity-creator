<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString0;

class MethodString0Test extends \PHPUnit_Framework_TestCase {

    public function testMethodStringOgetStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setAssociation(0);
        $methodString0 = new MethodString0($property);
        $resultingMethodString = $methodString0->getStringFromStrategy();
        $expectedOutput = "\tpublic function setTestName(\$testName = null) {\n\t\t\$this->testName = \$testName;\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}