<?php

namespace Application\DEC;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/** 
* @ORM\Entity
* @ORM\Table(name="users")
*/

class User {

	/** 
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer", name="id")
	*/
	protected $id;

	/** 
	* @ORM\ManyToMany(targetEntity="DEC\Entity\Email", cascade={"persist", "merge"})
	* @ORM\JoinTable(name="user_emails",
	*	joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
	*	inverseJoinColumns={@ORM\JoinColumn(name="email_id", referencedColumnName="id", unique=true)}
	* )
	*/
	protected $emails;

	public function __construct() {
		$this->emails = new ArrayCollection();
	}

	public function setId($id = null) {
		$this->id = $id;
		return $this;
	}

	public function getId() {
		return $this->id;
	}

	public function addToEmails(\DEC\Entity\Email $singleEntity) {
		$this->emails->add($singleEntity);
		return $this;
	}

	public function addEmails(Collection \DEC\Entity\Email $emails) {
		foreach($emails as $singleEntity) {
			$this->emails->add($singleEntity);
		}
		return $this;
	}

	public function removeFromEmails(\DEC\Entity\Email $singleEntity) {
		$this->emails->removeElement($singleEntity);
		return $this;
	}

	public function removeEmails(Collection \DEC\Entity\Email $emails) {
		foreach($emails as $singleEntity) {
			$this->emails->removeElement($singleEntity);
		}
		return $this;
	}

	public function clearEmails() {
		$this->emails->clear();
		return $this;
	}

	public function getEmails() {
		return $this->emails;
	}

	public function setEmails($emails) {
		$this->clearEmails();
		foreach($emails as $singleEntity) {
			$this->addToEmails($singleEntity);
		}
		return $this;
	}

}

