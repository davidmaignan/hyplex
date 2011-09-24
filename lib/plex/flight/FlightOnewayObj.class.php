<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightOnewayObj
 *
 * @author david
 */
class FlightOnewayObj extends FlightGenericObj {

    public $FareDescription;
    public $TotalPrice;
    public $CommissionAmount;
    public $CommissionPercentage;
    public $UniqueReferenceId;
    public $SegmentInfos = array();
    public $Segments = array();
    public $origin = 'LAX';
    public $destination = 'HNL';
    public $departDate;
    public $departTime;
    public $arrival;
    public $nbrStopsOutbound;
    public $nbrStopsInbound;
    public $SegmentOutbound = array();
    public $SegmentInbound = array();
    public $arAirlines = array();
    public $arAirportKeys = array();
    public $arAirport = array();


    public function __construct() {
        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'Date'));
    }

     public function setClass($value) {
        $this->class = $value;
    }

    public function analyseSegmentInfos() {


        $array = $this->SegmentInfos;

        foreach ($array as $key => $value) {

            if (!in_array($value->AirlineCode, $this->arAirlines)) {
                array_push($this->arAirlines, $value->AirlineCode);
            }

            if(!in_array($value->DepartureFrom, $this->arAirportKeys)){
                array_push($this->arAirportKeys, $value->DepartureFrom);
            }
            if(!in_array($value->ArrivalTo, $this->arAirportKeys)){
                array_push($this->arAirportKeys, $value->ArrivalTo);
            }

        }

        $this->Segments['outbound'] = $this->SegmentInfos;
 
    }

    public function summurizeSegmentsInfos(){


        //Analyse segment to go and simplify it (if multiple stops just show number of stops
        $data = $this->Segments['outbound'];

        switch (count($data)) {
            case 1:
                $this->SegmentOutbound = $data[0];
                break;

            default:
                $this->SegmentOutbound = $this->simplifySegmentsInfos2($data);
                break;
        }

        //Define number of stops to go
        $this->nbrStopsOutbound = $this->getNumberStops($data);

    }
}
?>
