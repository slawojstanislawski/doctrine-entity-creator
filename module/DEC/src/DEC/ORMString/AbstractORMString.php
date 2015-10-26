<?php
namespace DEC\ORMString;

abstract class AbstractORMString
{

	protected $ormString = "";

	/**
	 * @return string
	 */
	public function getOrmString()
	{
		return $this->ormString;
	}

	/**
	 * @return array
	 */
	public function getObjectVariables()
	{
		return get_object_vars($this);
	}

	protected function closeBracket()
	{
		$this->ormString .= ")\n";
	}

	protected function writeTargetEntity()
	{
		$this->ormString .= (isset($this->targetEntity) && !empty($this->targetEntity)) ? "targetEntity=\"$this->targetEntity\"" : "";
	}

	protected function writeInversedBy()
	{
		$this->ormString .= (isset($this->inverse) && !empty($this->inverse)) ? ", inversedBy=\"$this->inverse\"" : "";
	}

	protected function writeMappedBy()
	{
		$this->ormString .= (isset($this->map) && !empty($this->map)) ? ", mappedBy=\"$this->map\"" : "";
	}

	protected function writeIndexBy()
	{
		$this->ormString .= (isset($this->indexBy) && !empty($this->indexBy)) ? ", indexBy=\"$this->indexBy\"" : "";
	}

	protected function writeCascade()
	{
		$this->ormString .= (isset($this->cascade) && !empty($this->cascade)) ? ", cascade=$this->cascade" : "";
	}

	protected function writeJoinTable($unique, $cascadeVariant)
	{
		$this->ormString .= "\t* @ORM\\JoinTable(name=\"" . (isset($this->joinTable) && !empty($this->joinTable) ? "$this->joinTable\"" : "") . ",\n";
		$this->ormString .= "\t*\tjoinColumns={";
		$this->writeJoinColumn1(true, false);  //no cascade parameter on joinTable. JoinColumn1 gets cascade parameter on other ocasions.
		$this->ormString .= "\t*\tinverseJoinColumns={";
		$this->writeJoinColumn2($unique, $cascadeVariant);
		$this->ormString .= "\t* )\n";
	}

	protected function writeJoinColumn1($close = false, $cascadeVariant = null)
	{
		$this->ormString .= ($close) ?  "" : "\t* ";
		$this->ormString .= "@ORM\\JoinColumn(";
		$this->ormString .= (isset($this->joinColumn1) && !empty($this->joinColumn1) ? "name=\"$this->joinColumn1\"" : "");
		$this->ormString .= (isset($this->refColumn1) && !empty($this->refColumn1) ? ", referencedColumnName=\"$this->refColumn1\"" : "");
		$this->writeAppropriateOnDeleteIfCascadeRequiresSo($cascadeVariant);
		$this->ormString .= ")";
		$this->ormString .= ($close) ?  "},\n" : "\n";
	}

	protected function writeJoinColumn2($unique = false, $cascadeVariant = null)
	{
		$this->ormString .= "@ORM\\JoinColumn(";
		$this->ormString .= (isset($this->joinColumn2) && !empty($this->joinColumn2) ? "name=\"$this->joinColumn2\"" : "");
		$this->ormString .= (isset($this->refColumn2) && !empty($this->refColumn2) ? ", referencedColumnName=\"$this->refColumn2\"" : "");
		$this->ormString .= ($unique) ? ", unique=true" : "";
		$this->writeAppropriateOnDeleteIfCascadeRequiresSo($cascadeVariant);
		$this->ormString .= ")}\n";
	}

	protected function writeAppropriateOnDeleteIfCascadeRequiresSo($cascadeVariant)
	{
		switch($cascadeVariant) {
			case "cascade" :
				$this->ormString .= ', onDelete="CASCADE"';
				break;
			case "setNull" :
				$this->ormString .= ', nullable=true, onDelete="SET NULL"';
				break;
			default :
				break;
		}
	}

	protected function startORMString()
	{
		$this->ormString .= "\t/** \n";
	}

	protected function finishORMString()
	{
		$this->ormString .= "\t*/\n";
		$this->ormString .= "\tprotected $";
		$this->ormString .= (isset($this->propertyName) && !empty($this->propertyName)) ? $this->propertyName : "";
		if(isset($this->default) && $this->default != "") {
			$array = ["true", "false", "null"];
			if(is_numeric($this->default)) $this->ormString .= " = " . $this->default;
			elseif(in_array(strtolower($this->default), $array)) $this->ormString .= " = " . $this->default;
			else $this->ormString .= " = \"" . $this->default . "\"";
		}
		$this->ormString .= ";\n\n";
	}

	protected function writeOneToOne()
	{
		$this->ormString .= "\t* @ORM\\OneToOne(";
		$this->writeTargetEntity();
		$this->writeInversedBy();
		$this->writeMappedBy();
		$this->writeCascade();
		$this->closeBracket();
	}

	protected function writeOneToMany()
	{
		$this->ormString .= "\t* @ORM\\OneToMany(";
		$this->writeTargetEntity();
		$this->writeInversedBy();
		$this->writeMappedBy();
		$this->writeIndexBy();
		$this->writeCascade();
		$this->closeBracket();
	}

	protected function writeManyToOne()
	{
		$this->ormString .= "\t* @ORM\\ManyToOne(";
		$this->writeTargetEntity();
		$this->writeInversedBy();
		$this->writeMappedBy();
		$this->writeCascade();
		$this->closeBracket();
	}

	protected function writeManyToMany()
	{
		$this->ormString .= "\t* @ORM\\ManyToMany(";
		$this->writeTargetEntity();
		$this->writeInversedBy();
		$this->writeMappedBy();
		$this->writeIndexBy();
		$this->writeCascade();
		$this->closeBracket();
	}

} 