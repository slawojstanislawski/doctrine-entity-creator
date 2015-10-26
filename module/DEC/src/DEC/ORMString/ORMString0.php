<?php
namespace DEC\ORMString;

class ORMString0 extends AbstractORMString
{

	use \DEC\Traits\PropertyName;
	use \DEC\Traits\Strategy;
	use \DEC\Traits\Primary;
	use \DEC\Traits\ColumnType;
	use \DEC\Traits\Column;
	use \DEC\Traits\Nullable;
	use \DEC\Traits\Defaults;
	use \DEC\Traits\Unique;
	use \DEC\Traits\Unsigned;

	public function buildString()
	{
		$this->startORMString();
		$this->checkForPrimary();
		$this->processColumnName();
		$this->checkForUnique();
		$this->checkForNullable();
		$this->checkForOptions();
		$this->closeColumnAnnotation();
		$this->finishORMString();
		return $this;
	}

	protected function checkForPrimary()
	{
		if (isset($this->primary) && $this->primary == 1) {
			$this->ormString .= "\t* @ORM\\Id\n";
			$this->ormString .= "\t* @ORM\\GeneratedValue(strategy=\"{$this->strategy}\")\n";
		}
	}

	protected function processColumnName()
	{
		if (empty($this->columnType)) {
			$this->columnType = 'string';
		}
		$this->ormString .= "\t* @ORM\\Column(type=\"" . $this->columnType . '"';
		if(isset($this->column) && isset($this->propertyName) && !empty($this->propertyName)) {
			if ($this->column != $this->propertyName && $this->column != "") {
				$this->ormString .= ', name="' . $this->column . '"';
			} else {
				$this->ormString .= ', name="' . $this->propertyName . '"';
			}
		}
	}

	protected function checkForUnique()
	{
		if(isset($this->unique) && ($this->unique != 0)) {
			$this->ormString .= ', unique=true';
		}
	}

	protected function checkForNullable()
	{
		if (isset($this->nullable) && $this->nullable == 1) {
			$this->ormString .= ", nullable=true";
		}
	}

	protected function checkForOptions()
	{
		$options = [];
		if($this->checkForUnsigned()) $options[] = $this->checkForUnsigned();
		if($this->checkForDefault()) $options[] = $this->checkForDefault();
		$this->ormString .= (count($options) > 0) ? ", options={" . implode(", " , $options) . "}" : "";
	}

	protected function checkForUnsigned()
	{
		if(isset($this->unsigned) && ($this->unsigned != 0)) {
			return '"unsigned":true';
		}
		return false;
	}

	protected function checkForDefault()
	{
		if(isset($this->default) && $this->default != "") {
			if(strtolower($this->default) == "true") return '"default":true';
			if(strtolower($this->default) == "false") return '"default":false';
			if(strtolower($this->default) == "null") return '"default":NULL';
			if(is_numeric($this->default)) return '"default":' . $this->default;
			return '"default":"' . $this->default . '"';
		}
		return false;
	}

	protected function closeColumnAnnotation()
	{
		$this->ormString .= ")\n";
	}

} 