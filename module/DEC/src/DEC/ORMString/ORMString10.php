<?php
namespace DEC\ORMString;

class ORMString10 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\IndexBy;
	use \DEC\Traits\Inverse;
	use \DEC\Traits\Cascade;

	public function buildString()
	{
		$this->startORMString();
		$this->writeManyToMany();
		$this->finishORMString();
		return $this;
	}

} 