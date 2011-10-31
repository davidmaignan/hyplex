<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightOnewayParameters
 *
 * @author david
 */
class FlightOnewayParameters extends PlexFlightParameters implements ParametersInterface  {

    //put your code here

    public function  __construct($type, $params, $culture) {

        parent::__construct($type, $params, $culture);

        
    }
    
    public function getDates(){

        $string = format_date($this->getDepartDate(), 'flight');
        

        return $string;
    }

}

