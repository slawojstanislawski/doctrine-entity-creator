<?php
namespace DEC\ORMString;

class ORMString2 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\Map;

	public function buildString()
	{
		$this->startORMString();
		$this->writeOneToOne();
		$this->finishORMString();
		return $this;
	}

}