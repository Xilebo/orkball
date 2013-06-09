<?php

class Ork {

	//constants

	const MAX_ATTRIBUTE = 20;
	const MAX_STRENGTH = MAX_ATTRIBUTE;
	const MAX_ENDURANCE = MAX_ATTRIBUTE;
	const MAX_SPEED = MAX_ATTRIBUTE;

	//variables

	static protected $nameGenerations = 0;
	
	protected $name;
	protected $teamName;
	protected $strength;
	protected $endurance;
	protected $speed;

	protected $maxHealth;
	protected $damage;

	protected $health;
	protected $targetEnemy = false;

	// initialize

	function __construct($name, $teamName, $strength = FALSE, $endurance = FALSE, $speed = FALSE) {
		$this->name = $name;
		$this->teamName = $teamName;
		if ($strength and $endurance and $speed) {
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

	static function generateName() {
		return 'Nameless Grunt Nr. '.(++Ork::$nameGenerations);
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

	public function isDead() {
		return ($this->health <= 0);
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
			$targetKilled = $this->targetEnemy.hit($this->damage);
			if ($targetKilled) {
				$this->targetEnemy = false;
			}
		}
	}

}
?>
