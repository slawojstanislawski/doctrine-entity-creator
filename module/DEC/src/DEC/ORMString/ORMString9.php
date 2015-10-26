<?php
namespace DEC\ORMString;

class ORMString9 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\IndexBy;
	use \DEC\Traits\Map;

	public function buildString()
	{
		$this->startORMString();
		$this->writeManyToMany();
		$this->finishORMString();
		return $this;
	}

} 