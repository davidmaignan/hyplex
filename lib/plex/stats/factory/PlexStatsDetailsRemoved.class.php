<?php

class PlexStatsDetailsRemoved {
	
	private $values;
	private $type;
	
	public function __construct($q){
		
		$this->values = $q;
		$this->type = $q['parameters']['type'];

	}
	
	public function __toString(){
		
		$string = '';
		$string .= 'Remove '.$this->type;
		
		return $string;
	}
	
}