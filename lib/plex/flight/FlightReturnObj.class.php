<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightReturnObj
 *
 * @author david
 */
class FlightReturnObj extends FlightGenericObj {

    //put your code here

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
    public $class = 'white';

    /*
     * To determine which segment is the last part of the outbound flight.
     *
     */

    public function __construct() {

        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'I18N', 'Url', 'Asset', 'Tag', 'Date'));
    }

    public function setClass($value) {
        $this->class = $value;
    }

    public function  __toString() {

        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'I18N', 'Url', 'Asset', 'Tag', 'Date'));


        $string =   '<tr>';
        $string .=  '<td>'. html_entity_decode($this->getAirlineIcon()).'</td>';
        $string .=  '<td>Inbound</td>';
        $string .=  '<td>'. $this->SegmentOutbound->DepartureFrom . '</td><td>'.
                    $this->SegmentOutbound->ArrivalTo. '</td><td>'.
                    format_date($this->SegmentOutbound->Departs, 'flight').'</td><td>'.
                    format_date($this->SegmentOutbound->Departs, 't').'</td><td>'.
                    format_date($this->SegmentOutbound->Arrives, 'flight') .'</td><td>'.
                    format_date($this->SegmentOutbound->Arrives, 't').'</td><td>';
        $string .= $this->SegmentOutbound->NumberStops .'</td><td>';
        $string .= format_currency($this->TotalPrice,sfConfig::get('app_currency')).'</td></tr>';

        $string  .=  '<tr>';
        $string .= '<td></td>';
        $string .= '<td>Outbound</td>';
        $string  .=  '<td>'. $this->SegmentInbound->DepartureFrom . '</td><td>'.
                    $this->SegmentInbound->ArrivalTo. '</td><td>'.
                    format_date($this->SegmentInbound->Departs, 'flight').'</td><td>'.
                    format_date($this->SegmentInbound->Departs, 't').'</td><td>'.
                    format_date($this->SegmentInbound->Arrives, 'flight') .'</td><td>'.
                    format_date($this->SegmentInbound->Arrives, 't').'</td><td></td><td></td></tr>';
        
        

        return $string;
    }

    public function analyseSegmentInfos() {

        $array = $this->SegmentInfos;

        $togo = array();
        $return = array();

        //Check which 
        $id = 0;

        //Determine which segment is the last to arrive so ArrivalTo -> is $destination
        foreach ($array as $value) {
          
            //if ($value->ArrivalTo == $this->destination) {
            //    $id = $value->SegmentNumber;
            //}

            if(in_array($value->ArrivalTo, $this->arDestinationCode)){
                $id = $value->SegmentNumber;
            }
        }

        foreach ($array as $key => $value) {
            if ($value->SegmentNumber <= $id) {
                array_push($togo, $value);
            } else {
                array_push($return, $value);
            }

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

        $this->Segments['outbound'] = $togo;
        $this->Segments['inbound'] = $return;
        //$this->SegmentInfos = array();

        //print_r($this->Segments['outbound'])

    }

    /**
     * Create the SegmentOutbound array and Segment Inbound array
     * to display summurize information of the FlightReturnObject
     *
     */

    public function summurizeSegmentsInfos() {

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

        //$this->nbrStopsOutbound = count($this->Segments['outbound']) - 1;

        //Analyse segment to go and simplify it (if multiple stops just show number of stops
        $data = $this->Segments['inbound'];

        switch (count($data)) {
            case 1:
                $this->SegmentInbound = $data[0];
                break;

            default:
                $this->SegmentInbound = $this->simplifySegmentsInfos2($data);
                break;
        }

        //Define number of stops to go
        $this->nbrStopsInbound = $this->getNumberStops($data);
        //$this->nbrStopsInbound = count($this->Segments['inbound']) - 1;
    }


   

    public function displayConfirmationTitle($culture = 'en_US'){


        $codeFrom = $this->SegmentOutbound->DepartureFrom;
        $codeTo = $this->SegmentOutbound->ArrivalTo;

        //var_dump($this->arAirport);

        $from = $this->arAirport[$codeFrom][$culture]['name'] .' ('.$codeFrom.'),  ' .
                    $this->arAirport[$codeFrom][$culture]['city_name']. ' ';
        $from .= isset($this->arAirport[$codeFrom]['state'])? ' ['.$this->arAirport[$codeFrom]['state'].'], ': '';

        $from .= $this->arAirport[$codeFrom][$culture]['country'];

        $to = $this->arAirport[$codeTo][$culture]['name'] .' ('.$codeTo.'),  ' .
                    $this->arAirport[$codeTo][$culture]['city_name']. ' ';
        $to .= isset($this->arAirport[$codeTo]['state'])? ' ['.$this->arAirport[$codeTo]['state'].'], ': '';

        $to .= $this->arAirport[$codeTo][$culture]['country'];


        
        return __('Round trip from %1% to %2%',array('%1%'=> $from,'%2%'=> $to));


        
    }


    /**
     * Return a string representation of the object summurized flight.
     *
     * @return string 
     */

    /*
    public function __toString() {

        //use_helper('Number');
        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'Date','I18n'));
        $string = "<a id={$this->UniqueReferenceId}></a>";
        $string .= '<div class="box-airline" id=>';
        $string .= $this->getAirlineIcon();
        $string .= '<br />';

        if(count($this->arAirlines)> 1){
            $string .= 'multiple airlines';
        }else{
            $string .= $this->SegmentOutbound->Airline;
        }
        $string .= '</div>';
        $string .= '<div class="flight-data" >';
        $string .= '<table>';
        $string .= $this->displayToStringBound($this->SegmentOutbound);
        $string .= $this->displayToStringBound($this->SegmentInbound);
        $string .= '</table>';
        $string .= '<a href="#" class="flight-link-details">'. __('Details').'</a>';
        $string .= '<a href="#" class="flight-link-save">'.__('Save').'</a>';
        $string .= '<a href="#" class="flight-link-share">'.__('Share').'</a>';
        $string .= '</div>';
        $string .= '<div class="flight-box-price color2">';
        $string .= '<p class="price">'.format_currency($this->TotalPrice, 'USD').'</p>';
        $string .= '<a href="#" class="select">' . __('Select') . '</a>';
        $string .= '</div>';

        return $string;
    }
     *
     */
     /*
    public function displayToStringBound($data) {

        $string = '<tr>';
        $string .= '<td class="airport">' . $data->DepartureFrom . '</td>';
        $string .= '<td class="bold date">' . format_date($data->Departs, 'flight') . '</td>';
        $string .= '<td class="blue time">' . format_date($data->Departs, 't') . '</td>';
        $string .= '<td class="arrow">' . image_tag('generic/arrow.gif') . '</td>';
        $string .= '<td class="airport">' . $data->ArrivalTo . '</td>';
        $string .= '<td class="bold date">' . format_date($data->Arrives, 'flight') . '</td>';
        $string .= '<td class="blue time">' . format_date($data->Arrives, 't') . '</td>';
        $string .= '<td class="stop">' . $data->NumberStops . ' stop</td>';
        $string .= '<td class="duration">' . Utils::getHourMinutes($data->FlightDuration) . '</td>';
        $string .= "</tr>";
        return $string;
    }
      *
      */
      /*
    public function displaySegmentDetails($data) {
        
        $string = '';
        $string .= '<tr class="border"><td class="flight-info" rowspan="2">';
        $string .= $this->getAirlineIconDetails($data);
        //$string .= $this->getAirlineIcon();
        
        $string .= '</td>';
        $string .= '<td class="date">' . format_date($data->Departs, 'p') . '</td>';
        $string .= '<td class="time">' . format_date($data->Departs, 't') . '</td>';
        $string .= '<td class="airport">' . $data->DepartureFrom . '</td>';
        $string .= '<td class="duration" rowspan="2">' . Utils::getHourMinutes($data->FlightDuration) . '</td>';
        $string .= '<td class="class" rowspan="2">' . $data->ClassOfService . '</td>';
        $string .= '</tr>';
        $string .= '<tr class="border">';
        $string .= '<td class="date">' . format_date($data->Arrives, 'p') . '</td>';
        $string .= '<td class="time">' . format_date($data->Arrives, 't') . '</td>';
        $string .= '<td class="airport">' . $data->ArrivalTo . '</td>';
        $string .= '</tr>';
        $string .= $this->getOperatingAirlines($data);
        return $string;
    }
       *
       */

    /*

    public function displayDetails() {
        

        $string = '';
        $string .= '<table class="flight-details append-bottom">';
        $string .= '<tr><td colspan="6" class="title"><span class="depart">'.__('Outbound').': </span>';
        $string .= format_date($this->SegmentOutbound->Departs, 'P');
        $string .= $this->getDiffDays($this->Segments['outbound']);
        $string .= '</td></tr><tr class="small"><td class="flight-info">'.__('Flight').'</td>
                    <td>'.__('Depart/Arrive').'</td><td>'.__('Time').'</td>';
        $string .= '<td>'.__('Airport').'</td><td>'.__('Duration').'</td><td>'.__('Cabin').'</td></tr>';

        $datas = $this->Segments['outbound'];

        for($i=0;$i<count($datas);$i++){
            $string .= $this->displaySegmentDetails($datas[$i]);
            if (count($datas) > 1 && $i < count($datas) - 1) {
                $string .= $this->displayLayover($datas[$i], $datas[$i + 1]);
                //$string .= $this->nbrStopsOutbound;
                //echo "<br />";
                //$string .= $this->nbrStopsInbound;
            }
        }
        $string .= '<tr><td></td></tr>';
        $string .= '<tr><td colspan="6" class="title"><span class="depart">'.__('Inbound').': </span>';
        $string .= format_date($this->SegmentInbound->Departs, 'P');
        $string .= $this->getDiffDays($this->Segments['inbound']);
        $string .= '</td></tr><tr class="small"><td class="flight-info">'.__('Flight').'</td>
                    <td>'.__('Depart/Arrive').'</td><td>'.__('Time').'</td>';
        $string .= '<td>'.__('Airport').'</td><td>'.__('Duration').'</td><td>'.__('Cabin').'</td></tr>';

        $datas = $this->Segments['inbound'];

        for($i=0;$i<count($datas);$i++){
            $string .= $this->displaySegmentDetails($datas[$i]);
            if (count($datas) > 1 && $i < count($datas) - 1) {
                $string .= $this->displayLayover($datas[$i], $datas[$i + 1]);
                //$string .= $this->nbrStopsOutbound;
                //echo "<br />";
                //$string .= $this->nbrStopsInbound;
            }
        }


        //$string .= $this->SegmentOutbound
        //$string .=
        $string .= '</table>';
        return $string;

        $string = "<table>";
        $string .= "<tr>";
        $string .= "<td colspan=5 style=background-color:#ccc;padding:3px 0;><h3 style=color:black; >" . __("Flight details") . "</h3></td>";
        $string .= "</tr>";


        $string .= "<tr><td colspan=5 style=background-color:#eee;padding:3px 0;>" . __("Outbound") . "</td></tr>";
        foreach ($this->Segments['outbound'] as $obj) {
            $string .= "<tr>";
            $string .= "<td style=vertical-align:middle;>";
            $string .= image_tag('AA.gif', array('class' => 'airline-icon'));
            $string .= "</td>";
            $string .= "<td>";
            $string .= "$obj->Airline<br />";
            $string .= __("Flight") . ": {$obj->FlightNumber}";
            $string .= "</td>";
            $string .= "<td>";
            $string .= "$obj->Departs<br />";
            $string .= "{$obj->DepartureFrom}";
            $string .= "</td>";
            $string .= "<td>";
            $string .= "$obj->Arrives<br />";
            $string .= "{$obj->ArrivalTo}";
            $string .= "</td>";
            $string .= "</tr>";
        }


        $string .= "<tr><td colspan=5 style=background-color:#eee;padding:3px 0;>" . __("Inbound") . "</td></tr>";
        foreach ($this->Segments['inbound'] as $obj) {
            $string .= "<tr>";
            $string .= "<td style=vertical-align:middle;>";
            $string .= image_tag('AA.gif', array('class' => 'airline-icon'));
            $string .= "</td>";
            $string .= "<td>";
            $string .= "$obj->Airline<br />";
            $string .= "Flight: {$obj->FlightNumber}";
            $string .= "</td>";
            $string .= "<td>";
            $string .= "$obj->Departs<br />";
            $string .= "{$obj->DepartureFrom}";
            $string .= "</td>";
            $string .= "<td>";
            $string .= "$obj->Arrives<br />";
            $string .= "{$obj->ArrivalTo}";
            $string .= "</td>";
            $string .= "</tr>";
        }


        $string .= "</table>";

        return $string;
    }
     *
     */

     /*

    public function displayIphone() {

        $string = '';
        $string .= '<div class="search-box-list ' . $this->class . '">';
        $string .= '<div class="airline-line">';
        $string .= $this->getAirline();
        $string .= "<span class=price>" . format_currency($this->TotalPrice, 'USD') . "</span>";
        $string .= '</div>';
        $string .= '<div class="search-box-float">';
        $string .= $this->getAirlineIcon();
        $string .= '</div>';
        $string .= '<div class="search-box-float details">';
        $string .= "<span class=airport>{$this->origin}</span>";
        $string .= "<span class=time>" . format_date($this->SegmentOutbound->Departs, 't') . "</span>";
        $string .= "<span class=arrow>" . image_tag('iphone/arrow.gif') . "</span>";
        $string .= "<span class=airport>{$this->destination}</span>";
        $string .= "<span class=time>" . format_date($this->SegmentOutbound->Arrives, 't') . "";
        $string .= "<span class=stop>";
        $string .= format_number_choice(
                    '[0]0 stop|[1] 1 stop|(1,+Inf]%count% stops',
                    array('%count%' => $this->nbrStopsOutbound),
                    $this->nbrStopsOutbound
                  );
        $string.= "</span>";
        $string .= "<span class=nb-days>".Utils::calculateNbrDays($this->SegmentOutbound->Departs, $this->SegmentOutbound->Arrives)."</span>";
        $string .= "</span><br />";
        $string .= "<span class=airport>{$this->destination}</span>";
        $string .= "<span class=time>" . format_date($this->SegmentInbound->Departs, 't') . "</span>";
        $string .= "<span class=arrow>" . image_tag('iphone/arrow.gif') . "</span>";
        $string .= "<span class=airport>{$this->origin}</span>";
        $string .= "<span class=time>" . format_date($this->SegmentInbound->Arrives, 't') . "";
        $string .= "<span class=stop>";
        $string .= format_number_choice(
                    '[0]0 stop|[1] 1 stop|(1,+Inf]%count% stops',
                    array('%count%' => $this->nbrStopsInbound),
                    $this->nbrStopsInbound
                  );
        $string.= "</span>";
        $string .= "<span class=nb-days>".Utils::calculateNbrDays($this->SegmentInbound->Departs, $this->SegmentInbound->Arrives)."</span>";
        $string .= "</span></div>";
        
        
        $string .= "</div>";

        return $string;
    }

    public function displayIphoneDetails() {

        $string = '<div class=flight-details-container >';

        //Outbound
        $datas = $this->Segments['outbound'];

        for ($i = 0; $i < count($datas); $i++) {
            $string .= $this->displayIphoneSegmentDetails($datas[$i], 'Depart');

            //Check if layover to display
            if (count($datas) > 1 && $i < count($datas) - 1) {
                $string .= $this->displayIphoneLayover($datas[$i], $datas[$i + 1]);
            }
            $string .= '<div class=line ></div>';
            $string .= '</div>';
        }

        //$string .= '<div class=line ></div>';
        //Outbound
        $datas = $this->Segments['inbound'];

        for ($i = 0; $i < count($datas); $i++) {
            $string .= $this->displayIphoneSegmentDetails($datas[$i], 'Return');
            if (count($datas) > 1 && $i < count($datas) - 1) {
                $string .= $this->displayIphoneLayover($datas[$i], $datas[$i + 1]);
                //$string .= $this->nbrStopsOutbound;
                //echo "<br />";
                //$string .= $this->nbrStopsInbound;
            }
            $string .= '</div>';
        }

        //$string .= '<div class=line-blue></div>';

        $string .= '</div>';

        return $string;
    }

    public function displayIphoneSegmentDetails($data, $way) {

        $string = '';
        $string .= '<div class="flight-details ' . $this->class . '">';
        $string .= '<div class="flight-date">';
        $string .= __($way) . ' - ' . format_date($data->Departs, 'P');
        $string .= '</div>';
        $string .= '<div class="search-box-float" style="margin-left:5px">';
        $string .= $this->getAirlineIcon();
        $string .= '</div>';
        $string .= '<span class="flight-number">' . $data->Airline . ' Flight ' . $data->FlightNumber . '</span>';
        
        $string .= '<div class="search-box-float details">';
        $string .= '<dl>';
        $string .= '<dt>Depart: </dt>';
        $string .= '<dd>' . format_date($data->Departs, 'q') . '</dd>';
        $string .= '<dt>Arrive: </dt>';
        $string .= '<dd>' . format_date($data->Arrives, 'q') . '</dd>';
        $string .= '<dt>Duration: </dt>';
        $string .= '<dd>' . $this->calculateDuration($data->Departs, $data->Arrives) . '</dd>';
        $string .= '<dt class="no-border">Details: </dt>';
        $string .= $this->getOperatingAirlines2($data);
        $string .= '</dl>';
        $string .= '</div>';
        $string .= '<div style="clear:both;"></div>';

        return $string;
    }

    public function displayIphoneLayover($data1, $data2) {

        //Calculate time between 2 flight

        $where = $data1->ArrivalTo;
        $layover = Utils::getMinutesBetweenDates($data1->Arrives, $data2->Departs);

        $string = '';
        $string .= '<div class="layover">';
        $string .= __('Layover in ') . $where . __(' for ') . Utils::getHourMinutes($layover);
        $string .= '</div>';
        return $string;
    }
      *
      */

     public function getOperatingAirlines2($data){

        //var_dump($data);

        $airline = $data->AirlineCode;
        $operatingAirline = $data->OperatingAirlineCode;

        $string = '';

        if($airline != $operatingAirline && $operatingAirline != '**'){
            $string .= '<dd class="no-border">';
            $string .= __('Operated by: ');
            $string .= $data->OperatingAirline;
            $string .= '</dd>';
            
        }

        return $string;

    }

    public function calculateDuration($data1, $data2) {
        return date('H:i:s', (strtotime($data1) - strtotime($data2)));
    }


}

?>
