<?php

namespace DEC\Controller;

use Zend\Http\Request;
use Zend\View\Model\ViewModel;
use DEC\Form\EntityForm;
use Zend\View\Model\JsonModel;

class IndexController extends DecAbstractActionController
{

	protected $jsonSaveDir;

	/**
	 * @param EntityForm $entityForm
	 * @param string $saveDirectory
	 * @param string $jsonSaveDirectory
	 */
	function __construct(EntityForm $entityForm, $saveDirectory, $jsonSaveDirectory)
	{
        parent::__construct($entityForm, $saveDirectory);
		$this->jsonSaveDir = $jsonSaveDirectory;
	}

	/**
	 * @return ViewModel
	 */
	public function indexAction()
    {
	    $form = new EntityForm();
        return new ViewModel(['form' => $form]);
    }

	/**
	 * @return JsonModel
	 */
    public function getEntityStringAction()
    {
        $result = ["status" => "error", "action" => "getEntityString"];
        return $this->processRequestWithFormData($result, 'processGetString');
    }

	/**
	 * @return JsonModel
	 */
    public function saveFileAction()
    {
        $result = ['status' => 'error', 'action' => 'saveFile'];
        return $this->processRequestWithFormData($result, 'processSavingFile');
    }

	/**
	 * @return JsonModel
	 */
	public function populateFormAction()
	{
        $result = ["status" => "error", "action" => "populateForm", "message" => "didntPopulate"];
		return $this->processSimpleRequest($result, 'getDataToFillTheFormWith');
	}

	/**
	 * @return JsonModel
	 */
	public function jsonSelectMenuAction()
	{
		$result = ["status" => "error", "action" => "jsonSelectMenu", "message" => "noEntityFiles"];
		return $this->processSimpleRequest($result, 'getSelectMenuData');
	}

	/**
	 * @param array $filteredPost
	 * @param array $result
	 * @return JsonModel
	 */
	protected function processGetString($filteredPost, $result)
	{
		$getEntityStringService = $this->getServiceLocator()->get('DEC\Service\GetEntityStringService');
		$result = $getEntityStringService->getString($filteredPost, $result);
		return new JsonModel($result);
	}

	/**
	 * @param array $filteredPost
	 * @param array $result
	 * @return JsonModel
	 */
	protected function processSavingFile($filteredPost, $result)
	{
		$saveFilesService = $this->getServiceLocator()->get('DEC\Service\SaveFilesService');
		$result = $saveFilesService->saveFiles($filteredPost, $result);
		return new JsonModel($result);
	}

	/**
	 * @param array $result
	 * @param Request $request
	 * @return JsonModel
     */
	protected function getDataToFillTheFormWith($result, $request)
	{
		$post = $request->getPost();
		$formPopulator = $this->getServiceLocator()->get('DEC\Service\FormPopulator');
		$result = $formPopulator->populateForm($post, $result);
		return new JsonModel($result);
	}

	/**
	 * @param array $result
	 * @param Request $request
	 * @return JsonModel
     */
	protected function getSelectMenuData($result, $request)
	{
		$jsonSelectHandler = $this->getServiceLocator()->get('DEC\Service\JsonSelectHandler');
		$result = $jsonSelectHandler->populateJsonSelectMenu($result);
		return new JsonModel($result);
	}

}