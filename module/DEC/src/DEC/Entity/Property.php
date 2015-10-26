<?php
namespace DEC\Entity;

class Property
{
	use \DEC\Traits\PropertyName;
	use \DEC\Traits\Column;
	use \DEC\Traits\JoinTable;
	use \DEC\Traits\Nullable;
	use \DEC\Traits\Strategy;
	use \DEC\Traits\Primary;
	use \DEC\Traits\JoinColumn1;
	use \DEC\Traits\JoinColumn2;
	use \DEC\Traits\RefColumn1;
	use \DEC\Traits\RefColumn2;
	use \DEC\Traits\TargetEntity;
	use \DEC\Traits\IndexBy;
	use \DEC\Traits\Inverse;
	use \DEC\Traits\Map;
	use \DEC\Traits\ColumnType;
	use \DEC\Traits\Unique;
	use \DEC\Traits\Defaults;
	use \DEC\Traits\Unsigned;
	use \DEC\Traits\Cascade;

	protected $association;

	/**
	 * @param string $association
	 */
	public function setAssociation($association)
	{
		$this->association = $association;
	}

	/**
	 * @return string
	 */
	public function getAssociation()
	{
		return $this->association;
	}

}