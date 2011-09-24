<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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

}
