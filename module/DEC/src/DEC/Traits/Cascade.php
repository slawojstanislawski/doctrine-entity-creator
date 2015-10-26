<?php
namespace DEC\Traits;

trait Cascade {

	protected $cascade;

	/**
	 * @param mixed $cascade
	 */
	public function setCascade($cascade)
	{
		$this->cascade = $cascade;
	}

	/**
	 * @return mixed
	 */
	public function getCascade()
	{
		return $this->cascade;
	}

} 