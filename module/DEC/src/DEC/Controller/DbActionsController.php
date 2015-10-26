<?php
namespace DEC\Controller;

use DEC\Form\EntityForm;
use Zend\View\Model\JsonModel;

class DbActionsController extends DecAbstractActionController
{

	/**
	 * @param EntityForm $entityForm
	 * @param string $saveDirectory
	 */
    function __construct(EntityForm $entityForm, $saveDirectory)
    {
        parent::__construct($entityForm, $saveDirectory);
    }

	/**
	 * @return JsonModel
	 */
    public function createSchemaAction()
    {
        $result = ["status" => "error", "action" => "createSchema"];
        return $this->processRequestWithFormData($result, 'processCreateSchema', true);
    }

	/**
	 * @return JsonModel
	 */
    public function getSchemaSqlAction()
    {
        $result = ["status" => "error", "action" => "getSchemaSql"];
        return $this->processRequestWithFormData($result, 'processGetSqlSchema', true);
    }

	/**
	 * @param array $filteredPost
	 * @param array $result
	 * @return JsonModel
	 */
    protected function processCreateSchema($filteredPost, $result)
    {
        $schemaService = $this->getServiceLocator()->get('DEC\Service\SchemaService');
        $result = $schemaService->createSchema($this->getSaveDir(), $filteredPost, $result);
        return new JsonModel($result);
    }

	/**
	 * @param array $filteredPost
	 * @param array $result
	 * @return JsonModel
	 */
    protected function processGetSqlSchema($filteredPost, $result)
    {
        $schemaService = $this->getServiceLocator()->get('DEC\Service\SchemaService');
        $result = $schemaService->getSchemaSql($this->getSaveDir(), $filteredPost, $result);
        return new JsonModel($result);
    }

} 