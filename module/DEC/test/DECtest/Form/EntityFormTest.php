<?php

namespace DECTest\Form;

use DEC\Form\EntityForm;

class EntityFormTest extends \PHPUnit_Framework_TestCase {

	//testing form behavior for getEntityString and saveFile actions
	public function testFormIsValidOnAllRequiredFieldsSupplied()
	{
		$entityForm = new EntityForm();
		$postData = [
			"classname" => "test",
			"tablename" => "test",
			"namespace" => "test",
			"entityProperties" => [
				0 => [
					"propertyName" => "test"
				],
			],
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			true, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfNamespaceNotSupplied()
	{
		$entityForm = new EntityForm();
		$postData = [
			"namespace" => "",
			"classname" => "test",
			"tablename" => "test",
			"entityProperties" => [
				0 => [
					"propertyName" => "test"
				],
			],
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfClassnameNotSupplied()
	{
		$entityForm = new EntityForm();
		$postData = [
			"namespace" => "test",
			"classname" => "",
			"tablename" => "test",
			"entityProperties" => [
				0 => [
					"propertyName" => "test"
				],
			],
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfTablenameNotSupplied()
	{
		$entityForm = new EntityForm();
		$postData = [
			"namespace" => "test",
			"classname" => "test",
			"tablename" => "",
			"entityProperties" => [
				0 => [
					"propertyName" => "test"
				],
			],
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfOnePropertyNameNotSupplied()
	{
		$entityForm = new EntityForm();
		$postData = [
			"classname" => "test",
			"tablename" => "test",
			"namespace" => "test",
			"entityProperties" => [
				0 => [
					"propertyName" => ""
				],
			],
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}

	//testing form behavior for createSchema and getSchemaSql actions
	public function testFormIsValidOnAllRequiredFieldsSuppliedForDbActions()
	{
		$entityForm = new EntityForm();
		$entityForm->setInputFilter($entityForm->getFilterForDbFields());
		$postData = [
			"dbname" => "test",
			"driver" => "test",
			"entityFilesNamespace" => "test",
			"user" => "test",
			"password" => "test",
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			true, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfDbNameNotSupplied()
	{
		$entityForm = new EntityForm();
		$entityForm->setInputFilter($entityForm->getFilterForDbFields());
		$postData = [
			"dbname" => "",
			"driver" => "test",
			"entityFilesNamespace" => "test",
			"user" => "test",
			"password" => "test",
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfDriverNotSupplied()
	{
		$entityForm = new EntityForm();
		$entityForm->setInputFilter($entityForm->getFilterForDbFields());
		$postData = [
			"dbname" => "test",
			"driver" => "",
			"entityFilesNamespace" => "test",
			"user" => "test",
			"password" => "test",
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfEntityFilesNamespaceNotSupplied()
	{
		$entityForm = new EntityForm();
		$entityForm->setInputFilter($entityForm->getFilterForDbFields());
		$postData = [
			"dbname" => "test",
			"driver" => "test",
			"entityFilesNamespace" => "",
			"user" => "test",
			"password" => "test",
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfUserNotSupplied()
	{
		$entityForm = new EntityForm();
		$entityForm->setInputFilter($entityForm->getFilterForDbFields());
		$postData = [
			"dbname" => "test",
			"driver" => "test",
			"entityFilesNamespace" => "test",
			"user" => "",
			"password" => "test",
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}
	public function testFormIsInvalidIfPasswordNotSupplied()
	{
		$entityForm = new EntityForm();
		$entityForm->setInputFilter($entityForm->getFilterForDbFields());
		$postData = [
			"dbname" => "test",
			"driver" => "test",
			"entityFilesNamespace" => "test",
			"user" => "test",
			"password" => "",
		];
		$entityForm->setData($postData);
		$this->assertEquals(
			false, $entityForm->isValid()
		);
	}

} 