<?php

namespace DEC\Service;

use DEC\Common\Utils;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\EntityManager as EM;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Zend\Loader\StandardAutoloader;

class SchemaService {

    /**
     * @param string $directory
     * @param string $driver
     * @param string $dbName
     * @param string $dbUsername
     * @param string $dbPassword
     * @return EM
     */
    public function createEM($directory, $driver, $dbName, $dbUsername, $dbPassword)
    {
        $paths = [];
        $paths[] = $directory;
        $isDevMode = true;
        $connectionParams = [
            'driver'   => $driver,
            'user'     => $dbUsername,
            'password' => $dbPassword,
            'dbname'   => $dbName,
        ];
        $config = Setup::createConfiguration($isDevMode);
        $driver = new AnnotationDriver(new AnnotationReader(), $paths);
        AnnotationRegistry::registerLoader('class_exists');
        $config->setMetadataDriverImpl($driver);
        $entityManager = EM::create($connectionParams, $config);
        return $entityManager;
    }

    /**
     * @param array $filteredPost
     * @param array $result
     * @return array
     */
    public function createSchema($saveDirectory, $filteredPost, $result)
    {
        $entityManager = $this->createEM($saveDirectory, $filteredPost['driver'], $filteredPost['dbname'], $filteredPost['user'], $filteredPost['password']);
        $classes = $this->getEntitiesMetadata($saveDirectory, $filteredPost, $entityManager);
        if(count($classes) == 0)  {
            return Utils::returnResultWithErrorMessage($result, 'nofiles');
        }
        $schemaTool = $this->getSchemaTool($entityManager);
        $result = $this->saveSchema($classes, $schemaTool, $entityManager, $result);
        return $result;
    }

    /**
     * @param string $saveDirectory
     * @param array $filteredPost
     * @param array $result
     * @return array
     */
    public function getSchemaSql($saveDirectory, $filteredPost, $result)
    {
        $entityManager = $this->createEM($saveDirectory, $filteredPost['driver'], $filteredPost['dbname'], $filteredPost['user'], $filteredPost['password']);
        $classes = $this->getEntitiesMetadata($saveDirectory, $filteredPost, $entityManager);
        if(count($classes) == 0)  {
            return Utils::returnResultWithErrorMessage($result, 'nofiles');
        }
        $schemaTool = $this->getSchemaTool($entityManager);
        try {
            $schemaSqlArray = $this->getArrayOfSqlLines($schemaTool, $classes);
        }catch (\Exception $e) {
            return Utils::returnResultWithErrorMessage($result, 'sqlstringfailed');
        }
        $schemaSql = "";
        if($schemaSqlArray) {
            $result['status'] =  'success';
            foreach($schemaSqlArray as $sql) {
                $schemaSql .= $sql . "<br/>";
            }
            $result['schemaSQL'] = $schemaSql;
        }else {
            return Utils::returnResultWithErrorMessage($result, 'sqlstringfailed');
        }
        return $result;
    }

	protected function getArrayOfSqlLines(SchemaTool $schemaTool, $classes)
	{
		return $schemaTool->getCreateSchemaSql($classes);
	}

    /**
     * @param EntityManager $entityManager
     * @return SchemaTool
     */
    protected function getSchemaTool(EntityManager $entityManager)
    {
        $schemaTool = new SchemaTool($entityManager);
        return $schemaTool;
    }

    /**
     * @param array $classes
     * @param SchemaTool $schemaTool
     * @param EntityManager $entityManager
     * @param array $result
     * @return array
     */
    protected function saveSchema($classes, SchemaTool $schemaTool, EntityManager $entityManager, $result)
    {
        try {
            $schemaTool->dropSchema($classes); //drop tables defined only by the classes in the namespace folder
            $schemaTool->createSchema($classes);
            $tables = $entityManager->getConnection()->getSchemaManager()->listTables();
            if(count($tables) > 0) $result["status"] = "success";
        }catch (\Exception $e) {
            if($e->getCode() == 1045 || $e->getCode() == 1044) {
                $result["message"] = "noaccess";
            }else {
                $result["message"] = "dberror";
                if($e->getCode() != 0) $result["errcode"] = $e->getCode();
                $result["errmessage"] = $e->getMessage();
            }
        }
        return $result;
    }

    /**
     * @param array $filteredPost
     * @return EntityManager $entityManager
     */
    protected function getEntitiesMetadata($saveDirectory, $filteredPost, EntityManager $entityManager)
    {
        $namespace = $filteredPost['entityFilesNamespace'];
        $namespaceDirectory = $saveDirectory . DIRECTORY_SEPARATOR . $namespace;
        $this->registerEntityFilesNamespace($namespace, $namespaceDirectory);
        $classes = $this->collectMetadataFromDirectory($namespaceDirectory, $namespace, $entityManager);
        return $classes;
    }

    /**
     * @param string $namespace
     * @param string $namespaceDirectory
     */
    protected function registerEntityFilesNamespace($namespace, $namespaceDirectory) {
        $loader = new StandardAutoloader;
        $loader->registerNamespace($namespace, $namespaceDirectory);
        $loader->register();
    }

    /**
     * @param string $directory
     * @param string $namespace
     * @param EntityManager $entityManager
     * @return array
     */
    protected function collectMetadataFromDirectory($directory, $namespace, EntityManager $entityManager)
    {
        $classes = [];
        if(file_exists($directory)) {
            if ($handle = opendir($directory)) {
                while (false !== ($entry = readdir($handle))) {
                    if($entry != "." && $entry != ".." && $entry != ".gitignore") {
                        $filename = str_replace(".php", "", $entry);
                        $classname = $namespace . "\\" . $filename;
                        try {
                            $classes[] = $this->getMetadataForSingleClass($entityManager, $classname);
                        }catch (\Exception $e) {
                            //proceed with execution. User will simply receive "no entity files saved for the specified namespace" feedback
                        }
                    }
                }
                closedir($handle);
            }
        }
        return $classes;
    }

	/**
	 * @param EM $entityManager
	 * @param string $classname
	 * @return \Doctrine\ORM\Mapping\ClassMetadata
	 */
	protected function getMetadataForSingleClass(EntityManager $entityManager, $classname)
	{
		return $entityManager->getClassMetadata($classname);
	}

}