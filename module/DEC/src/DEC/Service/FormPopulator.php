<?php

namespace DEC\Service;

use Zend\View\Model\JsonModel;
use DEC\Common\Utils;

class FormPopulator {

    protected $jsonSaveDir;

    function __construct($jsonSaveDir)
    {
        $this->jsonSaveDir = $jsonSaveDir;
    }

    /**
     * @param array $post
     * @param array $result
     * @return JsonModel
     */
    public function populateForm($post, $result)
    {
        $classname = Utils::replaceSlashesWithSystemSeparator($post["classname"]);
        if(!$classname || $classname == "") return $result;
        $filename = $this->getJsonSaveDir() . DIRECTORY_SEPARATOR . $classname . ".json" ;
        $json = @file_get_contents($filename); //filename is made from classname and it's in turn made from reading directory content.
        if(!$json || $json == "") return $result;
        $result["status"] = "success";
        $result["json"] = $json;
        unset($result["message"]);
        return $result;
    }

    /**
     * @return string
     */
    public function getJsonSaveDir()
    {
        return $this->jsonSaveDir;
    }

}