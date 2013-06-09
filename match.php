<?php

include_once 'ork.php';
include_once 'team.php';

class Match {

	/**
	 * This should be managed in the database. This solution only works, while
	 * I test all stuff locally and alone.
	 * @var array multidimensional array containing all active matches
	 */
	protected static $matches = array();

	protected $team1;
	protected $team2;

	protected $active = FALSE;

	/**
	 * factory function for a new match
	 * @param Team $team1
	 * @param Team $team2
	 */
	static public function createMatch($team1, $team2) {
		$createNewMatch = TRUE;
		$match = FALSE;
		if ($matches[$team1->getName()]) {
			$createNewMatch = FALSE; //TODO improve
		}
		if ($createNewMatch && ($matches[$team2->getName()])) {
			$createNewMatch = FALSE; //TODO improve
		}

		if ($createNewMatch) {
			$match = new Match($team1, $team2);
		}

		return $match;
	}

	/**
	 * @param Team $team1
	 * @param Team $team2
	 */
	protected function __construct($team1, $team2) {
		$this->team1 = $team1;
		$this->team2 = $team2;
		$team1Name = $team1->getName();
		$team2Name = $team2->getName();

		Match::$matches[$team1Name] = $this;
		Match::$matches[$team1Name] = $this;
	}
	
	public function start() {
		$this->active = TRUE;
		
		//TODO other stuff
	}
	
	public function stop() {
		$this->active = FALSE;
		
		//TODO other stuff (if needed)
	}
}
?>