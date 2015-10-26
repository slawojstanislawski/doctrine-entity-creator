<?php
namespace DEC\ORMString;

class ORMString5 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\IndexBy;
	use \DEC\Traits\Map;
	use \DEC\Traits\Cascade;

	public function buildString()
	{
		$this->startORMString();
		$this->writeOneToMany();
		$this->finishORMString();
		return $this;
	}

} 