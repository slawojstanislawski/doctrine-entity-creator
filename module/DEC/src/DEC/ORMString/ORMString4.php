<?php
namespace DEC\ORMString;

class ORMString4 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\JoinTable;
	use \DEC\Traits\IndexBy;
	use \DEC\Traits\JoinColumn1;
	use \DEC\Traits\RefColumn1;
	use \DEC\Traits\JoinColumn2;
	use \DEC\Traits\RefColumn2;
	use \DEC\Traits\Cascade;

	public function buildString()
	{
		$cascadeVariant = (isset($this->cascade) && (strpos($this->cascade, "remove") || strpos($this->cascade, "all"))) ? "cascade" : null;
		$this->startORMString();
		$this->writeManyToMany();
		$this->writeJoinTable(true, $cascadeVariant); //include unique note; also, if cascade options contain remove, join table will contain onDelete="CASCADE" in JoinColumn2
		$this->finishORMString();
		return $this;
	}

}