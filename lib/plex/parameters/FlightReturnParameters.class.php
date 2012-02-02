<?php

/**
 * Description of FlightReturnParameters
 *
 * @author david
 */
class FlightReturnParameters extends PlexFlightParameters implements ParametersInterface {

    //put your code here
    public function __construct($type, $params, $culture) {

        parent::__construct($type, $params, $culture);
        
    }
	
    /**
     * Return string formatted for statistical table
     */
    public function displayParamsStats(){
    	$string  = $this->originCode;
    	$string .= __(' to ');
    	$string .= $this->destinationCode;
    	$string .= ' - ';
    	if($this->getDepartDate() != ''){
    		$string .= format_date($this->getDepartDate(), 'p');
    	}
    	$string .= ' - ';
    	if($this->getReturnDate() != ''){
    		$string .= format_date($this->getReturnDate(), 'p');
    	}
    	
        $string .= ' - ';
        $string .= Utils::getAdultChildInfantString($this->getAdults(), $this->getChildren(), $this->getInfants());
        
        return $string;
    }
	
	/**
	 * Return string formatted for Iphone
	 */
    public function displayParamsIphone() {
        $string = $this->getOrigin();
        $string .= __(' to ');
        $string .= $this->getDestination();
        $string .= ' - ';
        $string .= format_date($this->getDepartDate(), 'p');
        $string .= ' - ';
        $string .= format_date($this->getReturnDate(), 'p');

        return $string;
    }
	
    /**
     * Return string formated with depart and return dates
     */
    public function getDates(){

        $string = format_date($this->getDepartDate(), 'flight');
        $string .= ' - ';
        $string .= format_date($this->getReturnDate(), 'flight');

        return $string;
    }

}
