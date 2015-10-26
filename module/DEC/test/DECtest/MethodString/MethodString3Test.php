<?php
namespace DECTest\MethodString;

use DEC\Entity\Property;
use DEC\MethodString\MethodString3;

class MethodString3Test extends \PHPUnit_Framework_TestCase {

    public function testMethodString3getStringFromStrategyOutput()
    {
        $property = new Property();
        $property->setPropertyName("testName");
        $property->setTargetEntity("Application\\Entity\\TestTargetEntity");
        $property->setAssociation(3);
        $methodString3 = new MethodString3($property);
        $resultingMethodString = $methodString3->getStringFromStrategy();
        $expectedOutput = "\tpublic function setTestName(\\Application\\Entity\\TestTargetEntity \$testName = null) {\n\t\tif(\$testName == null) {\n\t\t\t\$this->testName->set(null);\n\t\t\t\$this->testName = \$testName;\n\t\t}else {\n\t\t\t\$this->testName = \$testName;\n\t\t\t\$this->testName->set(\$this);\n\t\t}\n\t\treturn \$this;\n\t}\n\n\tpublic function getTestName() {\n\t\treturn \$this->testName;\n\t}\n\n";
        $this->assertEquals($expectedOutput, $resultingMethodString);
    }

}