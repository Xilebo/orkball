<?php

class Ork {

	//constants

	const MAX_ATTRIBUTE = 20;
	const MAX_STRENGTH = MAX_ATTRIBUTE;
	const MAX_ENDURANCE = MAX_ATTRIBUTE;
	const MAX_SPEED = MAX_ATTRIBUTE;

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
	protected $targetEnemy = false;


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
		if ($strength && $endurance && $speed) {
			$this->strength = $strength;
			$this->endurance = $endurance;
			$this->speed = $speed;
		} else {
			$strength = rand(1, MAX_STRENGTH);
			$endurance = rand(1, MAX_ENDURANCE);
			$speed = rand(1, MAX_SPEED);
		}
	}

	protected function init() {
		$this->health = $this->endurance * 10;
		$this->damage = $this->strength;
	}

	public function __toString() {
		return $this->name;
	}

	//Getters and Setters

	public function getStrength() {
		return $this->strength;
	}

	public function getEndurance() {
		return $this->endurance;
	}

	public function getSpeed() {
		return $this->speed;
	}

	public function getName() {
		return $this->name;
	}

	public function getTeam() {
		return $this->teamName;
	}

	public function setTeam($teamName) {
		$this->teamName = ((String) $teamName);
	}

	public function isDead() {
		return ($this->health <= 0);
	}

	public function hasEnemy() {
		$result = TRUE && $this->targetEnemy;
	}

	//fighting

	public function engage($enemy) {
		$this->targetEnemy = $enemy;
	}

	public function hit($damage) {
		$this->health -= $damage;
		return $this->isDead();
	}

	public function attackTarget() {
		if ($this->targetEnemy) {
			$targetKilled = $this->targetEnemy->hit($this->damage);
			if ($targetKilled) {
				$this->targetEnemy = false;
			}
		}
	}

}
?>
