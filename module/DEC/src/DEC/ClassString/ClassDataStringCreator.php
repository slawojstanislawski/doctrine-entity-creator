<?php
namespace DEC\ClassString;

use DEC\Entity\Property;

class ClassDataStringCreator
{

    protected $namespace ="";
    protected $className ="";
    protected $tableName ="";
    protected $repositoryClass ="";
    protected $indexes = [];

	/**
	 * @param array $postData
	 */
    public function consumePostData($postData) {
        $this->namespace = $postData['namespace'];
        $this->className = $postData['classname'];
        $this->tableName = $postData['tablename'];
        $this->repositoryClass = $postData['repositoryclass'];
        $this->indexes = $postData['indexes'];
    }

	/**
	 * @param array $singleIndexData
	 * @return string
	 */
	private function createSingleIndexString($singleIndexData) {
		if(empty($singleIndexData['columns']) || empty($singleIndexData['index'])) return "";
		$columnNames = explode(',', $singleIndexData['columns']);
		$columnNames = array_map('trim', $columnNames);
		$notEmptyColumnNames = array_filter($columnNames);
		$singleIndexString = "*\t@ORM\\Index(name=\"" . $singleIndexData['index'] . "\", columns={\"";
		$singleIndexString .= implode("\", \"", $notEmptyColumnNames);
		$singleIndexString .= "\"})";
		return $singleIndexString;
	}

	/**
	 * @return string
	 */
	private function createIndexesString()
	{
		$indexes = $this->getIndexes();
		if(empty($indexes)) return "";
		$singleIndexStrings = [];
		foreach($this->getIndexes() as $indexData) {
			$singleIndexStrings[] = $this->createSingleIndexString($indexData);
		}
		if((array_filter($singleIndexStrings)) == []) return "";
		$combinedIndexesString = ", indexes={\n";
		$combinedIndexesString .= implode(",\n", $singleIndexStrings);
		$combinedIndexesString .= "\n* })\n";
		return $combinedIndexesString;
	}

	/**
	 * @return string
	 */
	private function createNamespaceString() {
		return 'namespace ' . ucwords($this->getNamespace()) . ";\n\n";
	}

	/**
	 * @param Property[] $propertyObjects
	 * @param array $doctrineRelationsWithCollection
	 * @return string
	 */
	private function creteImportsString($propertyObjects, $doctrineRelationsWithCollection)
	{
		foreach($propertyObjects as $propertyObject) {
			if(in_array($propertyObject->getAssociation(), $doctrineRelationsWithCollection)) {
				return "use Doctrine\\Common\\Collections\\ArrayCollection;\nuse Doctrine\\Common\\Collections\\Collection;\n";
			}
		}
		return "";
	}

	/**
	 * @return string
	 */
	private function createEntityAndTableAnnotations()
	{
		$string ="";
		$string .= "use Doctrine\\ORM\\Mapping as ORM;\n\n";
		$string .= "/** \n";
		$string .= "* @ORM\\Entity";
		$repositoryClass = $this->getRepositoryClass();
		if (!empty($repositoryClass)) {
			$string .= "(repositoryClass=\"" . $repositoryClass . "\")\n";
		} else {
			$string .= "\n";
		}
		$string .= "* @ORM\\Table(name=\"" . $this->getTableName() . "\"";
		$string .= ($this->createIndexesString() != "") ? $this->createIndexesString() : ")\n";
		$string .= "*/\n\n";
		return $string;
	}

	/**
	 * @return string
	 */
	private function createClassDeclarationString()
	{
		$string = "class " . ucfirst($this->getClassName()) . " {\n\n";
		return $string;
	}

	/**
	 * @param Property[] $propertyObjects
	 * @param array $doctrineRelationsWithCollection
	 * @return string
	 */
	public function getClassDataString($propertyObjects, $doctrineRelationsWithCollection)
	{
		$classTopString = '';
		$classTopString .= $this->createNamespaceString();
		$classTopString .= $this->creteImportsString($propertyObjects, $doctrineRelationsWithCollection);
		$classTopString .= $this->createEntityAndTableAnnotations();
		$classTopString .= $this->createClassDeclarationString();
		return $classTopString;
	}

	/**
	 * @param Property[] $propertyObjects
	 * @param array $doctrineRelationsWithCollection
	 * @return string
	 */
	private function createCollectionStrings($propertyObjects, $doctrineRelationsWithCollection)
	{
		$arrayCollectionsString = "";
		foreach ($propertyObjects as $propertyObject) {
			if ($propertyObject->getPropertyName() != "" && in_array($propertyObject->getAssociation(), $doctrineRelationsWithCollection)) {
				$arrayCollectionsString .= "\t\t\$this->" . $propertyObject->getPropertyName() . " = new ArrayCollection();\n";
			}
		}
		return $arrayCollectionsString;
	}

	/**
	 * @param Property[] $propertyObjects
	 * @param array $doctrineRelationsWithCollection
	 * @return string
	 */
	public function createConstructorString(array $propertyObjects, array $doctrineRelationsWithCollection)
	{
		$constructorString = "";
		$arrayCollectionsString = $this->createCollectionStrings($propertyObjects, $doctrineRelationsWithCollection);
		if (strlen($arrayCollectionsString) != 0) {
			$constructorString .= "\tpublic function __construct() {\n";
			$constructorString .= $arrayCollectionsString;
			$constructorString .= "\t}\n\n";
		}
		return $constructorString;
	}

	/**
	 * @return string
	 */
	public function getClassName()
	{
		return $this->className;
	}

	/**
	 * @return array
	 */
	public function getIndexes()
	{
		return $this->indexes;
	}

	/**
	 * @return string
	 */
	public function getNamespace()
	{
		return $this->namespace;
	}

	/**
	 * @return string
	 */
	public function getRepositoryClass()
	{
		return $this->repositoryClass;
	}

	/**
	 * @return string
	 */
	public function getTableName()
	{
		return $this->tableName;
	}

} 