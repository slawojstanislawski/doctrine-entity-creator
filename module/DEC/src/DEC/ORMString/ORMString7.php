<?php
namespace DEC\ORMString;

class ORMString7 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\JoinColumn1;
	use \DEC\Traits\RefColumn1;
	use \DEC\Traits\Cascade;

	public function buildString()
	{
		$cascadeVariant = (isset($this->cascade) && (strpos($this->cascade, "remove") || strpos($this->cascade, "all"))) ? "setNull" : null;
		$this->startORMString();
		$this->writeManyToOne();
		$this->writeJoinColumn1(false, $cascadeVariant);
		$this->finishORMString();
		return $this;
	}

} 