<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightGenericObj
 *
 * @author david
 */
class FlightGenericObj {


    public function getToStringHeader(){
        $string = '<thead>
                        <tr>
                            <th>Compagnie</th>
                            <th></th>
                            <th>From</th>
                            <th>To</th>
                            <th>Leaves</th>
                            <th>at</th>
                            <th>Arrives</th>
                            <th>at</th>
                            <th>stops</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    ';

        return $string;
    }

    
    
    /*
     * Calculate the number of stops in inbound and outbound
     * Check number of stops in FlightSegmentObject and the number of FlightSegmentObject
     *
     * @return int the number of stops total per bounds (in or out)
     */
    protected function getNumberStops($data) {
        $number = 0;
        foreach ($data as $d) {
            $number += $d->NumberStops;
        }
        $number += count($data) - 1;
        return $number;
    }

    /*
     * Calculate the duration for inbound or outbound
     *
     * @return int in minutes.
     *
     * To complete: need to add the time between the flights, right now it's only the time in the air.
     * not the waiting time between each fligth.
     * Should return a variable for red eyes flight ?
     */

    protected function getDuration($data) {
        $number = 0;
        foreach ($data as $d) {
            $number += $d->FlightDuration;
        }

        //Add the layover between the flights
        $extra = 0;
        if (count($data) > 1) {

            for ($i = 0; $i < count($data) - 1; $i++) {
                $extra += Utils::getMinutesBetweenDates($data[$i]->Arrives, $data[$i + 1]->Departs);
            }
        }


        //print_r($extra);

        return (int) ($number + $extra);
    }

    

    public function setAirportInfo($listAirports)
    {
        foreach ($this->arAirportKeys as $value) {
            $this->arAirport[$value] = $listAirports[$value];
        }
    }



    public function getAirportName($code, $culture)
    {
        $string = $code;
        $string .= ' - '.$this->arAirport[$code][$culture]['name']. '<br />';
        $string .= '<span class="small blue1 bold"> ('.$this->arAirport[$code][$culture]['city_name'];
        if($this->arAirport[$code]['state'] != ''){
            $string .= ' ['.$this->arAirport[$code]['state'] .']';
        }
        $string .=  ' - '.$this->arAirport[$code][$culture]['country'].')</span>';
        return $string;
    }


    /*
     * This function is complementary to the above one
     * For cases with more than one segment keep the
     * appropriate infos
     * E.g: Departs from the first segment, Arrives from the last segments ....
     *
     * To complete: case with multiple airlines.
     *
     */

    protected function simplifySegmentsInfos2($data) {
        $segment = new FlightSegmentObj();
        $ar = array();

        //echo "<pre>";
        //print_r($data);
        //break;

        $keys = get_object_vars($data[0]);
        $keys = array_keys($keys);

        //echo "<pre>";
        //print_r($keys);
        //$keys = array_keys($data[0]);

        $first = 0;
        $last = count($data) - 1;
        $firstValue = array('SegmentNumber', 'AirlineCode', 'Airline', 'OperatingAirlineCode',
            'OperatingAirline', 'FlightNumber', 'EquipmentCode',
            'ClassOfService', 'Departs', 'DepartureFrom', 'FlightDuration');

        foreach ($keys as $value) {
            $segment->$value = (in_array($value, $firstValue)) ? $data[$first]->$value : $data[$last]->$value;
        }

        $segment->NumberStops = $this->getNumberStops($data);

        $segment->FlightDuration = $this->getDuration($data);

        return $segment;
    }

    public function getAirlineIcon() {

        if (count($this->arAirlines) > 1) {
            return image_tag('airlines/MULT.gif', array('class' => 'airline border', 'alt'=>'multi'));
        } else {

            switch (true) {
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $this->arAirlines[0] . '.png')):
                    return image_tag('airlines/' . $this->arAirlines[0] . '.png', array('class' => 'airline border', 'alt'=>$this->arAirlines[0]));
                    break;
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $this->arAirlines[0] . '.gif')):
                    return image_tag('airlines/' . $this->arAirlines[0] . '.gif', array('class' => 'airline border', 'alt'=>$this->arAirlines[0]));
                    break;
                default:
                    return $this->arAirlines[0];
                    return image_tag('airlines/no-icon.gif', array('class' => 'airline border', 'alt'=>$this->arAirlines[0]));
                    break;
            }
        }
    }

    public function getDiffDays($datas){

        $depart = $datas[0]->Departs;
        $arrive = $datas[count($datas)-1]->Arrives;

        $nbrDays = Utils::calculateNbrDays($depart, $arrive);

        if($nbrDays != null){
            $string = '<span class="important">';
            $string .= $nbrDays;

            $string .= '</span>';

            return $string;
        }else{
            return null;
        }


    }


    public function getAirline(){
        if (count($this->arAirlines) > 1) {
            return 'Multiple airlines';
        } else {
            return $this->SegmentOutbound->Airline;
        }
    }

    public function getAirlineIconDetails($data){

        //var_dump($data);

        $string = '';

        $airline = $data->AirlineCode;
        $operatingAirline = $data->OperatingAirlineCode;

        switch (true) {
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $airline . '.png')):
                    $string .= image_tag('airlines/' . $airline . '.png', array('class' => 'airline border', 'alt'=>$this->arAirlines[0]));
                    $string .= '<br />'.$data->Airline;
                    break;
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $airline . '.gif')):
                    $string .= image_tag('airlines/' . $airline . '.gif', array('class' => 'airline border', 'alt'=>$this->arAirlines[0]));
                    $string .= '<br />'.$data->Airline;
                    break;
                default:
                    $string .= $airline;
                    $string .= '<br />'.$data->Airline;
                    //$string = image_tag('airlines/no-icon.gif', array('class' => 'airline border', 'alt'=>$this->arAirlines[0]));
                    break;
            }
        $string .= '<br />';
        $string .= '<span class="small blue">'.$data->FlightNumber.'</span>';

        return $string;

    }

    public function getOperatingAirlines($data){

        //var_dump($data);

        $airline = $data->AirlineCode;
        $operatingAirline = $data->OperatingAirlineCode;

        $string = '';

        if($airline != $operatingAirline && $operatingAirline != '**'){
            $string .= '<tr class="border"><td colspan="6" class="text-right">';
            $string .= __('Operated by: ');
            $string .= '<span class="blue1 bold">'.$data->OperatingAirline.'</span>';
            $string .= '</td></tr>';
        }

        return $string;

    }

    public function displayLayover($data1, $data2) {
        $where = $data1->ArrivalTo;
        $layover = Utils::getMinutesBetweenDates($data1->Arrives, $data2->Departs);

        $string = '';
        $string .= '<tr><td colspan="6" class="layover"><span class="layover">';
        //$string .= __('Layover in ') . $where . __(' for ');
        $string .= __('Layover for ');
        $string .= '<span class="layover-time">'. Utils::getHourMinutes($layover);
        $string .= '</span></span></td></tr>';

        return $string;
    }


    /**
     * Function to retreive the search parameters
     * @param string $filename
     * @return flightparameter object
     */
    public function getPassengerInfo($filename){
        $parameters = PlexParsing::retreiveParameters($filename);
        
        $passengersString =  format_number_choice(
                '[0]|[1]1 adult|(1,+Inf]%1% adults',
                array('%1%' => $parameters->getAdults()), $parameters->getAdults());

        if($parameters->getChildren() || $parameters->getInfants()) $passengersString.= ', ';

        $passengersString .= format_number_choice(
                '[0]|[1]1 child|(1,+Inf]%1% children',
                array('%1%' => $parameters->getChildren()), $parameters->getChildren());

        if($parameters->getInfants()) $passengersString.= ', ';
        
        $passengersString .= format_number_choice(
                '[0]|[1]1 infant (travel on laps)|(1,+Inf]%1% infants (travel on laps)',
                array('%1%' => $parameters->getInfants()), $parameters->getInfants());

        return $passengersString;
    }


    /**
     * Return Origin or Destination airport formatted: LAX - Los Angeles [CA], USA
     * @param string $culture
     * @return string
     */
    public function getOriginOrDestination($way, $culture = 'en_US'){

        $string = '';

        if($way == 'origin'){
            $code = $this->SegmentOutbound->DepartureFrom;
        }else{
            $code = $this->SegmentOutbound->ArrivalTo;
        }
        //$codeFrom = $this->SegmentOutbound->DepartureFrom;
        

        //var_dump($this->arAirport);

        $string = truncate_text($this->arAirport[$code][$culture]['name'], 15) .' ('.$code.'),  ' .
                    $this->arAirport[$code][$culture]['city_name']. ' ';
        $string .= isset($this->arAirport[$code]['state'])? ' ['.$this->arAirport[$code]['state'].'], ': '';

        $string .= $this->arAirport[$code][$culture]['country'];


        return $string;
    }

}
