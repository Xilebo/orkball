<?php
class Ork {

	//constants

	public final $maxAttribute = 20;
	public final $maxStrength = maxAttribute;
	public final $maxEndurance = maxAttribute;
	public final $maxSpeed = maxAttribute;

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

	// initialize

	function __construct($name, $teamName) {
		$this->name = $name;
		$this->teamName = $teamName;
		$strength = rand(1, $maxStrength);
		$endurance = rand(1, $maxEndurance);
		$speed = rand(1, $maxSpeed);
	}

	function __construct($name, $teamName, $strength, $endurance, $speed) {
		$this->name = $name;
		$this->teamName = $teamName;
		$this->strength = $strength;
		$this->endurance = $endurance;
		$this->speed = $speed;
	}

	protected function init() {
		$this->health = $this->endurance * 10;
		$this->damage = $this->strength;
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
