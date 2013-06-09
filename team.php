<?php

include_once 'ork.php';

class Team {

	protected $name;
	protected $orks = array();

	public function __construct($name, $initialSize = 0) {
		$this->name = $name;
		for ($i = 0; $i < $initialSize; $i++) {
			$this->addOrk();
		}
	}

	public function __toString() {
		return $this->name;
	}

	//getters and setters

	public function getOrk($position) {
		$result = FALSE;
		if ($position < $this->size()) {
			$result = $this->orks[$position];
		}
	}

	public function size() {
		return count($this->orks);
	}

	// team management

	public function addOrk($ork = FALSE) {
		$ork = $ork ? $ork : new Ork();
		$ork->setTeam($this->name);
		$this->orks[] = $ork;
	}

}
?>