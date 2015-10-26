<?php
namespace DEC\MethodString;

abstract class AbstractMethodString
{

	protected $property;
	protected $strategy;

	/**
	 * @return string
	 */
	public function getStringFromStrategy()
	{
		return $this->strategy->composeString();
	}

}