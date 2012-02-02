<?php

class PlexStatsDetailsSearch{
	
	private $values;
	private $parameters;
	private $paramFactory;
	private $type;
	private $culture;
	
	public function __construct($q){
		
		$this->culture = sfContext::getInstance()->getUser()->getCulture();
		
		$this->values = $q;

		
		if(array_key_exists('search_flight', $q['parameters'])){
			$this->parameters = $q['parameters']['search_flight'];
	        $this->type = ($this->parameters['oneway'] == 0)? 'flightReturn': 'flightOneway';
	          
	    }else if(array_key_exists('search_hotel', $q['parameters'])){
	    	$this->parameters = $q['parameters']['search_hotel'];
	        $this->type = 'hotelSimple';
	    }else{
	    	return true;
	    }
	    
	    
		$this->paramFactory = PlexParametersFactory::factory($this->type, $this->parameters, $this->culture);
		
		
	}
	
	public function __toString(){
		
		$string = '';
		
		try{
			//Check if parameters are valid
			$validation = '';
			$validation = $this->paramFactory->isValid($this->values['session_id']);
	
			if(is_object($this->paramFactory)){
				$string = $this->paramFactory->displayParamsStats();
			}
			
			$string .= $validation;
			
		}catch(Exception $e){
			$string = $e->getMessage();
		}
		
		return $string;
		
	}
	
}