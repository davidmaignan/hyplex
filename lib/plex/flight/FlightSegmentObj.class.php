<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SegmentObj
 *
 * @author david
 */
class FlightSegmentObj {
    //put your code here

    public $SegmentNumber;
    public $AirlineCode;
    public $Airline;
    public $OperatingAirlineCode;
    public $OperatingAirline;
    public $FlightNumber;
    public $EquipmentCode;
    public $ClassOfService;
    public $Departs;
    public $DepartureFrom;
    public $ArrivalTo;
    public $NumberStops;
    public $FlightDuration;
    public $Cabin;
    public $DepartureTerminal;
    public $ArrivalTerminal;
    public $TransitAirportCode1;
    public $TransitAirportCode2;



    public function  __toString() {
        $vars = get_object_vars($this);
        
        //print_r($vars);
        //return 'Segment to display';
    }


    public function getSegmentNumber(){
        return 'SegmentNumber;';
    }

    //public function get
    
}
?>
