<?php

namespace DEC\Service;

use DEC\Common\Utils;

class GetEntityStringService {

	protected $entityStringCreator;

	function __construct(EntityStringCreator $entityStringCreator)
	{
		$this->entityStringCreator = $entityStringCreator;
	}

	/**
	 * @param array $post
	 * @param array $result
	 * @return array
	 */
	public function getString($post, $result)
	{
		if(Utils::areThereDuplicatePropertyNames($post)) {
			return Utils::returnResultWithErrorMessage($result, "duplicatePropertyNames");
		}
		$this->getEntityStringCreator()->consumePostData($post);
		if (!@$finalString = $this->getEntityStringCreator()->makeFinalEntityString()) {
			return Utils::returnResultWithErrorMessage($result, "stringnotcreated");
		}
		$result["entityString"] ="<pre>$finalString</pre>";
		$result["status"] = "success";
		return $result;
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


} 