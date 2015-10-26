<?php

namespace DEC\Common;

class Utils {

	/**
	 * @param string $string
	 * @return string
     */
	public static function replaceSlashesWithSystemSeparator($string)
    {
        $string = str_replace(["\\", "/"], DIRECTORY_SEPARATOR, $string);
        return $string;
    }

	/**
	 * @param array $postData
	 * @return boolean
	 */
	public static function areThereDuplicatePropertyNames($postData)
	{
		$propertyNames = [];
		$duplicateDetected = false;
		foreach ($postData['entityProperties'] as $propertyArray) {
			$isDuplicate = (in_array($propertyArray['propertyName'], $propertyNames));
			if($isDuplicate) {
				$duplicateDetected = true;
				break;
			}
			$propertyNames[] = $propertyArray['propertyName'];
		}
		return $duplicateDetected;
	}

	/**
	 * @param array $result
	 * @param string $message
	 * @return array
     */
	public static function returnResultWithErrorMessage($result, $message)
	{
		$result['message'] = $message;
		return $result;
	}

}