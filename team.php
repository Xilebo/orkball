<?php

include_once 'ork.php';

class Team {

	protected $name;
	protected $orks = array();
	protected $meat = 0;

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
		return $result;
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

	public function cleanUp() {
		$meatGain = 0;
		foreach ($this->orks as $ork) {
			if ($ork->isDead()) {
				$meatGain += $ork->getMeat();
			}
		}
		return $meatGain;
	}

	public function giveMeat($meat) {
		$leftovers = 0;
		$this->meat += $meat;
		if ($this->meat < 0) {
			$leftovers = $this->meat;
			$this->meat = 0;
		}
		return $leftovers;
	}

	public function getHunger() {
		$hunger = 0;
		foreach ($this->orks as $ork) {
			$hunger += $ork->getHunger();
		}
		return $hunger;
	}

	/**
	 * Feed the team some meat. The orks will eat according to their hunger and
	 * give the rest back.
	 *
	 * @param int $meat
	 * @return int the rest of the meat (may be negative, if the meat wasn't enough)
	 */
	public function feed($meat) {
		return ($meat - $this->getHunger());
	}

}
?>