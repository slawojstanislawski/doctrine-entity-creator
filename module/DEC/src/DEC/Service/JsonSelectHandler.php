<?php

namespace DEC\Service;

use Zend\View\Model\JsonModel;

class JsonSelectHandler {

    protected $jsonSaveDir;

    function __construct($jsonSaveDir)
    {
        $this->jsonSaveDir = $jsonSaveDir;
    }

    /**
     * @param array $result
     * @return JsonModel
     */
    public function populateJsonSelectMenu($result)
    {
        $classnames = $this->getClassnamesFromDirectory($this->getJsonSaveDir());
        if(!empty($classnames)) {
            usort($classnames, [get_class($this), 'sortClassnames']);
            $result["classnames"] = $classnames;
            $result["status"] = "success";
            unset($result["message"]);
        }
        return $result;
    }

    /**
     * @param string $directory
     * @return array
     */
    protected function getClassnamesFromDirectory($directory)
    {
        $files = [];
        $dir = new \RecursiveDirectoryIterator($directory, \FilesystemIterator::SKIP_DOTS);
        foreach (new \RecursiveIteratorIterator($dir) as $filename => $fileinfo) {
            if (!$fileinfo->isDir()) {
                $pathname = $fileinfo->getPathname();
                $pathname = str_replace([$directory . DIRECTORY_SEPARATOR, ".json", "\\", "/"], ["", "", "\\", "\\"], $pathname);
                $files[] = $pathname;
            }
        }
        return $files;
    }

    /**
     * @param $stringOne
     * @param $stringTwo
     * @return int
     */
    protected static function sortClassnames($stringOne , $stringTwo)
    {
        $explodedStringOne = explode("\\", $stringOne);
        $countPartsOne = count($explodedStringOne);
        $explodedStringTwo = explode("\\", $stringTwo);
        $countPartsTwo = count($explodedStringTwo);

        if($countPartsOne == $countPartsTwo) {
            return strnatcmp( $stringOne , $stringTwo );
        }else {
            return ($countPartsTwo > $countPartsOne) ? -1 : 1;
        }
    }

    /**
     * @return string
     */
    public function getJsonSaveDir()
    {
        return $this->jsonSaveDir;
    }

}