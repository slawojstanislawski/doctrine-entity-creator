<?php
namespace DEC\ORMString;

class ORMString6 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\Inverse;

	public function buildString()
	{
		$this->startORMString();
		$this->writeManyToOne();
		$this->finishORMString();
		return $this;
	}

} 