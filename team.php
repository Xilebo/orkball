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

	public function addOrk($ork = FALSE) {
		if ($ork) {
			$this->orks[] = $ork;
		} else {
			$this->orks[] = new Ork($this->name);
		}
	}

}
?>