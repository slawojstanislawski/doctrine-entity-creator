<?php

namespace DECTest\Service;

use DEC\Service\PropertyExtractor;

class PropertyExtractorTest extends \PHPUnit_Framework_TestCase {

    public function testConvertPostToPropertyObjects()
    {
        $postData = [
            'entityProperties' => [
                0 => [
                    'propertyName' => '001_test',
                    'columnType' => "integer",
                    'column' => '001_test',
                    'association' => 0,
                    'primary' => 0,
                ],
                1 => [
                    'propertyName' => '002_test',
                    'columnType' => "integer",
                    'column' => '002_test',
                    'default' => 'NULL',
                    'strategy' => "AUTO",
                    'primary' => 1,
                    'association' => 0,
                ],
            ],
        ];

        $propertyExtractor = new PropertyExtractor();
        $propertyObjects = $propertyExtractor->convertPostToPropertyObjects($postData);
        $this->assertEquals(1, $propertyObjects[0]->getPrimary());
        $this->assertEquals(0, $propertyObjects[1]->getPrimary());
    }

}