<?php

namespace DEC\Service;

use DEC\Common\Utils;

class SaveFilesService {

	protected $saveDir;
	protected $jsonSaveDir;
	protected $entityStringCreator;

	function __construct($saveDir, $jsonSaveDir, EntityStringCreator $entityStringCreator)
	{
		$this->entityStringCreator = $entityStringCreator;
		$this->jsonSaveDir = $jsonSaveDir;
		$this->saveDir = $saveDir;
	}

	/**
	 * @param array $post
	 * @param array $result
	 * @return array
	 */
	public function saveFiles($post, $result){
		if(Utils::areThereDuplicatePropertyNames($post)) {
			return Utils::returnResultWithErrorMessage($result, "duplicatePropertyNames");
		}
		$this->getEntityStringCreator()->consumePostData($post);
		$namespace = $this->getEntityStringCreator()->getClassDataStringCreator()->getNamespace();
		$namespace = Utils::replaceSlashesWithSystemSeparator($namespace);
		$classname = $this->getEntityStringCreator()->getClassDataStringCreator()->getClassname();

		$targetPhpFilePath = $this->buildTargetFilePath($namespace, $classname, $this->getSaveDir(), false);
		$jsonTargetFilePath = $this->buildTargetFilePath($namespace, $classname, $this->getJsonSaveDir(), true);
		if(!$targetPhpFilePath || ! $jsonTargetFilePath) {
			return Utils::returnResultWithErrorMessage($result, "didntcreatefolder");
		}

		$outputString = $this->getEntityStringCreator()->makeFinalEntityString();
		$jsonRepresentation = $this->getEntityStringCreator()->createJsonRepresentation();
		if (!$outputString || !$jsonRepresentation ) {
			return Utils::returnResultWithErrorMessage($result, "stringnotcreated");
		}

		$finalPhpString = "<?php\n\n" . $outputString;
		file_put_contents($targetPhpFilePath, $finalPhpString);
		file_put_contents($jsonTargetFilePath, $jsonRepresentation);

		if($this->checkIfContentsMatchTheInput($targetPhpFilePath, $finalPhpString, $jsonTargetFilePath, $jsonRepresentation)) {
			$result["status"] = "success";
			$result["entityString"] = $finalPhpString;
			$result["jsonEntityRepresentation"] = $jsonRepresentation;
		}else {
			$result["message"] = "notsaved";
		}
		return $result;
	}

	/**
	 * @param string $targetPhpFilePath
	 * @param string $finalPhpString
	 * @param string $jsonTargetFilePath
	 * @param string $jsonRepresentation
	 * @return bool
     */
	protected function checkIfContentsMatchTheInput($targetPhpFilePath, $finalPhpString, $jsonTargetFilePath, $jsonRepresentation)
	{
		return (file_get_contents($targetPhpFilePath) == $finalPhpString && file_get_contents($jsonTargetFilePath) == $jsonRepresentation) ?  true : false;
	}

	/**
	 * @param string $namespace
	 * @param string $classname
	 * @param string $saveDirectory
	 * @param bool $saveJson
	 * @return bool|string
	 */
	protected function buildTargetFilePath($namespace, $classname, $saveDirectory, $saveJson = false)
	{
		$targetFolderName = $saveDirectory . DIRECTORY_SEPARATOR . $namespace;
		if(!$this->ensureDirExists($targetFolderName)) return false;
		$fileExtension =  ($saveJson) ? '.json' : '.php';
		$targetFileName = ucfirst($classname) . $fileExtension;
		$targetFilePath = $targetFolderName . DIRECTORY_SEPARATOR . $targetFileName;
		return $targetFilePath;
	}

	/**
	 * @param string $directory
	 * @return bool
	 */
	protected function ensureDirExists($directory)
	{
		if (!file_exists($directory)) {
			if (!mkdir($directory, 0777, true)) { //if proceeds from here, dir is writable, no need for checks.
				return false;
			}else {
				return true;
			}
		}
		return true;
	}

	/**
	 * @return EntityStringCreator
	 */
	public function getEntityStringCreator()
	{
		return $this->entityStringCreator;
	}

	/**
	 * @param EntityStringCreator $entityStringCreator
	 */
	public function setEntityStringCreator($entityStringCreator)
	{
		$this->entityStringCreator = $entityStringCreator;
	}

	/**
	 * @return string
	 */
	public function getJsonSaveDir()
	{
		return $this->jsonSaveDir;
	}

	/**
	 * @param string $jsonSaveDir
	 */
	public function setJsonSaveDir($jsonSaveDir)
	{
		$this->jsonSaveDir = $jsonSaveDir;
	}

	/**
	 * @return string
	 */
	public function getSaveDir()
	{
		return $this->saveDir;
	}

	/**
	 * @param string $saveDir
	 */
	public function setSaveDir($saveDir)
	{
		$this->saveDir = $saveDir;
	}

} 