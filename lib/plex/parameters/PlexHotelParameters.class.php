<?php

/**
 * Description of PlexHotelParameters
 * 
 * @author david
 */
abstract class PlexHotelParameters extends PlexParameters implements ParametersInterface {
    //put your code here

    public $arRooms = array();
    public $arTypeRenamed = array('hotelSimple'=>array(
        'en_US'=>'hotel',
        'fr_FR'=>'hôtel',
        'zh_CN'=>'酒店'
    ));


    public function  __construct($type, $params, $culture) {
        parent::__construct($type, $params, $culture);
    }
    /**
     * Get CheckinDate
     * @return string (Y-m-d format)
     */
    public function getCheckinDate() {
        return $this->checkin_date;
    }

    /**
     * Get CheckoutDate
     * @return string (Y-m-d format)
     */
    public function getCheckoutDate() {
        return $this->checkout_date;
    }

    public function getParametersArray($culture = 'en_US') {

        $ar = array();
        $ar['wherebox'] = $this->getAirportFormatInput($this->arWhere, $culture);
        $ar['checkin_date'] = $this->checkin_date;
        $ar['checkout_date'] = $this->checkout_date;
        $ar['newRooms'] = $this->newRooms;
        if(isset($this->childrenAge)){
            $ar['childrenAge'] = $this->childrenAge;
        }
        $ar['type'] = $this->type;
        $ar['_csrf_token'] = $this->_csrf_token;

        return $ar;
    }
    
    /**
     * Return a string formatted city_name [state], country, airport_name (airport_code)
     * e.q: London, United Kingdom, Heathrow (LHR)
     * @return string
     */
    public function getAirportFormatInput($ar, $culture) {
        $string = $ar[$culture]['name'] . '';
        $string .= isset($ar[$culture]['state']) ? ' [' . $ar[$culture]['state']['code'] . ']' : '';
        $string .= ', ' . $ar[$culture]['country'] . ', ';
        $string .= $ar['airport'] . '';
        $string .= ' (' . $ar['code'] . ')';

        return $string;

    }

    /**
     * Return the number of adults
     * @return int
     */
    public function getAdults() {
        if (!isset($this->number_adults)) {
            throw new Exception('PlexFlightParameters: you must define a number of adults');
        }
        return $this->number_adults;
    }


    /**
     * Get number of adults by adding number_adults for each rooms in arRooms array
     * @return int
     */
    public function getNumberAdults() {
        
        $total = 0;
        foreach ($this->arRooms as $value) {
            $total += $value['number_adults'];
        }

        return $total;

    }

    /**
     * Get number of children by adding number_children for each rooms in arRooms array
     * @return int
     */
    public function getNumberChildren() {

        $total = 0;
        foreach ($this->arRooms as $value) {
            $total += $value['number_children'];
        }

        return $total;

    }

    /**
     * Get the number of rooms by counting the number of entries in arRooms array
     * @return int
     */
    public function getNumberRooms(){
        return count($this->arRooms);
    }

    /**
     * Get Number of nights between checkin and checkout dates
     * @return integer
     */
    public function getNumberNights(){

        $sStartDate = date("Y-m-d", strtotime($this->checkin_date));
        $sEndDate = date("Y-m-d", strtotime($this->checkout_date));

        $aDays = array();

        // Start the variable off with the start date
        // $aDays[] = $sStartDate;
        // Set a 'temp' variable, sCurrentDate, with the start date - before beginning the loop
        $sCurrentDate = $sStartDate;

        if ($sCurrentDate < $sEndDate) {

            // While the current date is less than the end date
            while ($sCurrentDate < $sEndDate) {
                // Add a day to the current date
                $sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));

                // Add this new day to the aDays array
                $aDays[] = $sCurrentDate;
            }

            // Once the loop has finished, return the array of days.
            if (!empty($aDays)){
                return count($aDays);
            }
        }
    }

    
    public function getTypeRenamed(){

        $culture = sfContext::getInstance()->getUser()->getCulture();
        return $this->arTypeRenamed[$this->type][$culture];

        
    }

     public function displayParamsIphone() {
        $string = $this->getOrigin();
        $string .= __(' to ');
        $string .= $this->getDestination();
        $string .= ' - ';
        $string .= format_date($this->getCheckinDate(), 'p');
        $string .= ' - ';
        $string .= format_date($this->getReturnDate(), 'p');

        return $string;
    }


    public function getDates(){

        $string = format_date($this->getCheckinDate(), 'flight');
        $string .= ' - ';
        $string .= format_date($this->getCheckoutDate(), 'flight');

        return $string;
    }

    /**
     * Get the children ages
     * @return array with children age sorted ascending
     */
    public function getChildrenAge(){

        $tmp = array();

        foreach($this->childrenAge as $child){
            array_push($tmp , (int)$child['age']);
        }
        
        sort($tmp);

        return $tmp;
    }
    

}

