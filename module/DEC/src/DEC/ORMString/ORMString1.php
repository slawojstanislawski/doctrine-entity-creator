<?php
namespace DEC\ORMString;

class ORMString1 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\Cascade;
	use \DEC\Traits\JoinColumn1;
	use \DEC\Traits\RefColumn1;

	public function buildString()
	{
		$cascadeVariant = (isset($this->cascade) && (strpos($this->cascade, "remove") || strpos($this->cascade, "all"))) ? "setNull" : null;
		$this->startORMString();
		$this->writeOneToOne();
		$this->writeJoinColumn1(false, $cascadeVariant);
		$this->finishORMString();
		return $this;
	}

} 