<?php
namespace DEC\Service;

use DEC\ClassString\ClassDataStringCreator;
use DEC\ORMString\ORMStringCreator;
use DEC\MethodString\MethodStringCreator;

class EntityStringCreator
{

	protected $propertyObjects = [];
	protected $propertyExtractor;
	protected $classDataStringCreator;
	protected $ormStringCreator;
	protected $methodsStringCreator;
    protected $doctrineRelationsWithCollection = [4, 5, 8, 9, 10, 12, 14];
    protected $postData;
    protected $finalString;

    function __construct(
	    PropertyExtractor $propertyExtractor,
	    ClassDataStringCreator$classDataStringCreator,
	    ORMStringCreator $ormStringCreator,
	    MethodStringCreator $methodsStringCreator)
    {
        $this->classDataStringCreator = $classDataStringCreator;
        $this->propertyExtractor = $propertyExtractor;
        $this->ormStringCreator = $ormStringCreator;
        $this->methodsStringCreator = $methodsStringCreator;
    }

	/**
	 * @param $postData
	 */
	public function consumePostData($postData)
	{
        $this->postData = $postData;
        $this->propertyObjects = $this->propertyExtractor->convertPostToPropertyObjects($this->postData);
        $this->classDataStringCreator->consumePostData($this->postData);
	}

	/**
	 * @return string
	 */
	protected function obtainClassDataString()
	{
		return $this->classDataStringCreator->getClassDataString($this->propertyObjects, $this->doctrineRelationsWithCollection);
	}

	/**
	 * @return string
	 */
	protected function buildTheConstructor()
	{
		return $this->classDataStringCreator->createConstructorString($this->propertyObjects, $this->doctrineRelationsWithCollection);
	}

	/**
	 * @return string
	 */
	protected function obtainORMStrings()
	{
		$ormStrings = $this->ormStringCreator->getORMStringsForProperties($this->propertyObjects);
		return $ormStrings;
	}

	/**
	 * @return string
	 */
	protected function obtainMethodStrings()
	{
		$methodStrings = $this->methodsStringCreator->getMethodStringsForProperties($this->propertyObjects);
		return $methodStrings;
	}

	/**
	 * @return string
	 */
	protected function closeFinalString()
	{
		return "}\n\n";
	}

    /**
     * @return string
     */
	public function makeFinalEntityString()
	{
		$this->finalString .= $this->obtainClassDataString();
		$this->finalString .= $this->obtainORMStrings();
		$this->finalString .= $this->buildTheConstructor();
		$this->finalString .= $this->obtainMethodStrings();
		$this->finalString .= $this->closeFinalString();
		return $this->finalString;
	}

	/**
	 * @return string
	 */
	public function createJsonRepresentation()
	{
		$data = $this->getPostData();
		unset($data['entityFilesNamespace']);
		unset($data['dbname']);
		unset($data['driver']);
		unset($data['user']);
		unset($data['password']);
		return json_encode($data);
	}

	/**
	 * @return ClassDataStringCreator
	 */
	public function getClassDataStringCreator()
	{
		return $this->classDataStringCreator;
	}

	/**
	 * @return array
	 */
	public function getPostData()
	{
		return $this->postData;
	}

}