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

	/**
	 * Returns the Ork at a specified position.
	 * @param int $position the position in the teams list
	 * @return Ork The Ork at the given position or FALSE if ork doesn't exist
	 */
	public function getOrk($position) {
		$result = FALSE;
		if ($position < $this->size()) {
			$result = $this->orks[$position];
		}
		return $result;
	}

	/**
	 * @return string the name of the team
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return int the size of the team
	 */
	public function size() {
		return count($this->orks);
	}

	// team management

	public function addOrk($ork = FALSE) {
		$ork = $ork ? $ork : new Ork();
		$ork->setTeam($this->name);
		$this->orks[] = $ork;
	}

	/**
	 * @return int the meat gained from dead orks
	 */
	public function cleanUp() {
		$meatGain = 0;
		foreach ($this->orks as $ork) {
			if ($ork->isDead()) {
				$meatGain += $ork->getMeat();
			}
		}
		return $meatGain;
	}

	/**
	 * If $meat is positive, the meat is just added to the teams stack.
	 * If $meat is negative, the amount is taken from the teams stack. The
	 * stored meat can not go under 0 through this. If the stack is not enough
	 * it will be set to 0 and the lack of meat is returned.
	 * @param int $meat the meat to give (or take if negative)
	 * @return int 0 or a negative number describing the amount of missing meat
	 */
	public function giveMeat($meat) {
		$leftovers = 0;
		$this->meat += $meat;
		if ($this->meat < 0) {
			$leftovers = $this->meat;
			$this->meat = 0;
		}
		return $leftovers;
	}

	/**
	 * @return int the meat the team eats after a match
	 */
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