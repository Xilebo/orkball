<?php

include_once 'ork.php';
include_once 'team.php';

class Match {


	protected $team1;
	protected $team2;

	/**
	 * @param Team $team1
	 * @param Team $team2
	 */
	protected function __construct($team1, $team2) {
		$this->team1 = $team1;
		$this->team2 = $team2;

	}

	public function start() {

		//TODO calculate match
	}

}
?>