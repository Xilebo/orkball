<?php

class Ork {

	//constants

	const MAX_ATTRIBUTE = 20;
	const MAX_STRENGTH = Ork::MAX_ATTRIBUTE;
	const MAX_ENDURANCE = Ork::MAX_ATTRIBUTE;
	const MAX_SPEED = Ork::MAX_ATTRIBUTE;

	//static stuff

	static protected $nameGenerations = 0;

	static function generateName() {
		return 'Nameless Grunt Nr. '.(++Ork::$nameGenerations);
	}

	//variables

	protected $name;
	protected $teamName;
	protected $strength;
	protected $endurance;
	protected $speed;

	protected $maxHealth;
	protected $damage;

	protected $health;
	protected $targetEnemy = FALSE;


	// init and magic functions

	function __construct(
			$name = FALSE,
			$teamName = '',
			$strength = FALSE,
			$endurance = FALSE,
			$speed = FALSE)
	{
		$this->teamName = $teamName;
		if ($name) {
			$this->name = $name;
		} else {
			$this->name = Ork::generateName();
		}
		if (	   ($strength > 0)
				&& ($strength < Ork::MAX_STRENGTH)
				&& ($endurance > 0)
				&& ($endurance < Ork::MAX_ENDURANCE)
				&& ($speed > 0)
				&& ($speed < Ork::MAX_SPEED)) {
			$this->strength = $strength;
			$this->endurance = $endurance;
			$this->speed = $speed;
		} else {
			$this->randomizeAttributes();
		}

		$this->calculateSecondaryAttributes();

	}

	protected function randomizeAttributes() {
		$this->strength = rand(1, Ork::MAX_STRENGTH);
		$this->endurance = rand(1, Ork::MAX_ENDURANCE);
		$this->speed = rand(1, Ork::MAX_SPEED);
	}

	protected function calculateSecondaryAttributes() {
		$this->maxHealth = $this->endurance * 10;
		$this->damage = $this->strength;
		$this->reset();
	}

	public function __toString() {
		return $this->name;
	}

	//Getters and Setters

	/**
	 * @return int
	 */
	public function getStrength() {
		return $this->strength;
	}

	/**
	 * @return int
	 */
	public function getEndurance() {
		return $this->endurance;
	}

	/**
	 * @return int
	 */
	public function getSpeed() {
		return $this->speed;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getTeam() {
		return $this->teamName;
	}

	public function setTeam($teamName) {
		$this->teamName = ((string) $teamName);
	}

	/**
	 * @return boolean
	 */
	public function isDead() {
		return ($this->health <= 0);
	}

	/**
	 * @return boolean
	 */
	public function isAlive() {
		return ($this->health > 0);
	}

	/**
	 * @return int the amount of meat this ork gives if slaughtered
	 */
	public function getMeat() {
		return ($this->strength + $this->endurance);
	}

	/**
	 * @return int the amount of meat this ork eats after each match (0 if dead)
	 */
	public function getHunger() {
		return $this->isAlive() ? $this->strength : 0;
	}

	/**
	 * @return boolean
	 */
	public function hasEnemy() {
		$result = TRUE && $this->targetEnemy;
		return $result;
	}

	//fighting

	/**
	 * Lets the ork engage a given target (if still alive)
	 * @param Ork the targeted enemy ork
	 */
	public function engage($target) {
		if ($this->isAlive()) {
			$this->targetEnemy = $target;
		}
	}

	/**
	 * Hit this ork and deal a given amount of damage
	 * @param int $damage
	 * @return boolean is the ork killed by the force of the blow?
	 */
	public function hit($damage) {
		$this->health -= $damage;
		return $this->isDead();
	}

	public function attackTarget() {
		if (($this->targetEnemy) && ($this->isAlive())) {
			$targetKilled = $this->targetEnemy->hit($this->damage);
			if ($targetKilled) {
				$this->targetEnemy = FALSE;
			}
		}
	}

	/**
	 * Resets the ork to state it should have at the beginning of a match.
	 */
	public function reset() {
		$this->health = $this->maxHealth;
		$this->targetEnemy = FALSE;
	}

}
?>
