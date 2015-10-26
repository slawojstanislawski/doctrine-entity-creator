<?php
namespace DEC\ORMString;

class ORMString11 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\Cascade;
	use \DEC\Traits\JoinColumn1;
	use \DEC\Traits\RefColumn1;

	public function buildString()
	{
		$cascadeVariant = (isset($this->cascade) && (strpos($this->cascade, "remove") || strpos($this->cascade, "all"))) ? "cascade" : null;
		$this->startORMString();
		$this->writeOneToOne();
		$this->writeJoinColumn1(false, $cascadeVariant); //if cascade options contain remove, join table will contain onDelete="CASCADE" in JoinColumn1
		$this->finishORMString();
		return $this;
	}

} 