<?php
class Ork {
	public final $maxAttribute = 20;
	public final $maxStrength = maxAttribute;
	public final $maxEndurance = maxAttribute;
	public final $maxSpeed = maxAttribute;

	protected $strength;
	protected $endurance;
	protected $speed;

	protected $engage = false;
	
	function __construct() {
		$strength = rand(1, $maxStrength);
		$endurance = rand(1, $maxEndurance);
		$speed = rand(1, $maxSpeed);
	}

	function __construct($strength, $endurance, $speed) {
		$this->strength = $strength;
		$this->endurance = $endurance;
		$this->speed = $speed;
	}

}
?>
