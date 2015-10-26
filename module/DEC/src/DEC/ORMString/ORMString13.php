<?php
namespace DEC\ORMString;

class ORMString13 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\Inverse;
	use \DEC\Traits\JoinColumn1;
	use \DEC\Traits\RefColumn1;

	public function buildString()
	{
		$this->startORMString();
		$this->writeManyToOne();
		$this->writeJoinColumn1(false, null); //no cascade on this side, just a join column
		$this->finishORMString();
		return $this;
	}

} 