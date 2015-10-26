<?php

namespace DEC\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use DEC\Form\EntityForm;
use Zend\View\Model\JsonModel;

class DecAbstractActionController extends AbstractActionController {

    protected $entityForm;
    protected $saveDir;

	/**
	 * @param EntityForm $entityForm
	 * @param string $saveDir
	 */
    function __construct(EntityForm $entityForm, $saveDir)
    {
        $this->entityForm = $entityForm;
        $this->saveDir = $saveDir;
    }

	/**
	 * @param string $result
	 * @param string $callbackName
	 * @param boolean $schemaRelated
	 * @return JsonModel
	 */
    protected function processRequestWithFormData($result, $callbackName, $schemaRelated = false)
    {
	    /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        if($request->isXmlHttpRequest()){
            $form = $this->getEntityForm();
            if($schemaRelated) $form->setInputFilter($form->getFilterForDbFields());
            $form->setData($request->getPost());
	        if ($form->isValid()) {
                return $this->$callbackName($form->getData(), $result);
            }else { //form invalid
                return $this->invalidFormData($result);
            }
        }else {//not an ajax request
            return $this->redirect()->toRoute('home');
        }
    }

    protected function processSimpleRequest($result, $callbackName)
    {
        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        if($request->isXmlHttpRequest()){
            return $this->$callbackName($result, $request);
        }else {//not an ajax request
            return $this->redirect()->toRoute('home');
        }
    }

	/**
	 * @param array $result
	 * @return JsonModel
	 */
    protected function invalidFormData($result)
    {
        $result["status"] = "error";
        $result["message"] = 'invalidform';
        return new JsonModel($result);
    }

    /**
     * @return EntityForm
     */
    public function getEntityForm()
    {
        return $this->entityForm;
    }

	/**
	 * @return string
	 */
	public function getSaveDir()
	{
		return $this->saveDir;
	}

} 