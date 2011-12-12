<?php

/**
 * Description of PlexFlightParameters
 * Abstract class where common functionality and variables for flights parameters
 *
 * @author david
 *
 */
abstract class PlexFlightParameters extends PlexParameters {

    //put your code here
    
    public $arParams;
    public $arMatches = array();
    public $arOrigin = array();
    public $arDestination = array();

    public $arTypeRenamed = array('flightReturn'=>array(
        'en_US'=>'Round trip',
        'fr_FR'=>'Aller/retour',
        'zh_CN'=>'往返'
    ),
        'flightOneway'=>array(
        'en_US'=>'One way',
        'fr_FR'=>'Aller simple',
        'zh_CN'=>'单'
    ));

    public function  __construct($type, $params, $culture) {

        parent::__construct($type, $params, $culture);

        /*foreach ($params as $key => $value) {
            $this->$key = $value;
        }
         * 
         */

        //Create $arParams used to generate the edit sfForm
        //$this->arParams = $params['search_flight'];
        //Retreive origin and destination code.

        $this->originCode = $this->getOrigin();
        $this->destinationCode = $this->getDestination();

        //Overide the value from the form.
        $this->type = $type;

    }

    /*
     * @param $ar array with info: name, state, country, state code
     * @param $culture the $sf_user->getCulture();
     *
     * return string formatted like Denver [CO], USA, Denver Metropolitan Area (DEN)
     */
    public function getOrigin() {

        if (!isset($this->origin)) {
            throw new Exception('PlexFlightParameters: you must define an origin');
        }

        $subject = $this->origin;

        $pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $subject, $matchesarray);

        if (empty($matchesarray[0])) {

            $this->problemWithCode = true;

            return $this->origin;
        }


        $this->arOrigin = Doctrine::getTable('City')->getCityAllCulture(substr($matchesarray[0][0], 1, -1));

        return substr($matchesarray[0][0], 1, -1);

    }

    /*
     * Return the destination value and
     * create arDestination with all info about the airport in all languages
     * @return string 3 uppercase letter 
     */
    public function getDestination() {

        if (!isset($this->destination)) {
            throw new Exception('PlexFlightParameters: you must define a destination');
        }

        $subject = $this->destination;
        $pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $subject, $matchesarray);

        if (empty($matchesarray[0])) {

            $this->problemWithCode = true;

            return $this->destination;
        }

        $this->arDestination = Doctrine::getTable('City')->getCityAllCulture(substr($matchesarray[0][0], 1, -1));

        return substr($matchesarray[0][0], 1, -1);

    }
    /*
     * Return array with all the search parameters to be used for searchFlight form
     * @param sfUser->getCulture
     * @return array with all the input fields values
     *
     */

    public function getParametersArray($culture = 'en_US') {

        $ar = array();
        $ar['oneway'] = $this->oneway;
        $ar['origin'] = $this->getAirportFormatInput($this->arOrigin, $culture);
        $ar['destination'] = $this->getAirportFormatInput($this->arDestination, $culture);
        $ar['depart_date'] = $this->depart_date;
        $ar['depart_time'] = $this->depart_time;
        $ar['return_date'] = $this->return_date;
        $ar['return_time'] = $this->return_time;
        $ar['cabin'] = $this->cabin;
        $ar['number_adults'] = $this->number_adults;
        $ar['number_children'] = $this->number_children;
        $ar['number_infants'] = $this->number_infants;
        $ar['type'] = $this->type;
        $ar['_csrf_token'] = $this->_csrf_token;

        return $ar;
    }


    /*
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

    /*
     * Return an array with the code for destination
     * Checks if it's a metropolitan code: if yes return the list of associated codes from the file ../data/city/city_metropolitan.yml
     * @return array
     *
     */
    public function getArrayDestinationCode(){

        $arCodes = array();

        //$q = Doctrine::getTable('City_metro')->findOneBy('city_metro_id', $this->arOrigin['id']);

        if ($this->arDestination['metropolitan'] === true) {

            $file = sfConfig::get('sf_data_dir') . '/city/city_metropolitan.yml';
            $metropolitanAreas = sfYaml::load($file);

            $key = $this->destinationCode;

            if (array_key_exists($key, $metropolitanAreas)) {
                $arCodes = $metropolitanAreas[$key];
            } else {
                throw new Exception('A problem exits with city_metropolitan.yml file when trying to determine if
                   it\'s a metropolitan area in FLightReturnParameter object', 500);
            }
        } else {

            array_push($arCodes, $this->destinationCode);

        }

        return $arCodes;

    }

    /*
     * Return the prefer nonstop choice
     * @return string (Y or N)
     */

    public function getPreferNonStop() {
        if (isset($this->prefer_nonstop)) {
            return 'Y';
        } else {
            return 'N';
        }
    }

    /*
     * Return the cabin 
     * @return string
     */

    public function getCabin() {
        if (!isset($this->cabin)) {
            throw new Exception('PlexFlightParameters: you must define a cabin');
        }
        return $this->cabin;
    }

    /*
     * Return the number of adults
     * @return int
     */

    public function getAdults() {
        if (!isset($this->number_adults)) {
            throw new Exception('PlexFlightParameters: you must define a number of adults');
        }
        return (int)$this->number_adults;
    }

    /*
     * Return the number of children
     * @return int
     */

    public function getChildren() {



        if (!isset($this->number_children)) {
            throw new Exception('PlexFlightParameters: you must define a number of children');
        }

        $numChildren = $this->number_children;

        return (int)$this->number_children;


        $array = array();

        if ($numChildren == 0) {
            return $array;
        }

        for ($i = 1; $i <= $numChildren; $i++) {
            $str = 'child_' . $i;
            array_push($array, substr($this->$str, 0, strpos($this->$str, '_')));
        }

        return $array;
    }

    /*
     * Return the number of infants (<2)
     * @return int
     */

    public function getInfants() {
        if (!isset($this->number_infants)) {
            throw new Exception('PlexFlightParameters: you must define a number of children');
        }

        return (int)$this->number_infants;

    }

    /*
     * To define
     *
     */

    public function getDateTime($way) {

        $strDate = $way . '_date';
        $strTime = $way . '_time';

        if (!isset($this->$strDate) || !isset($this->$strTime)) {
            throw new Exception('PlexFlightParameters: you must define a departure date and time');
        }

        $depDate = $this->$strDate;
        $arTime = Utils::generateTimeArray();
        $depTime = $arTime[$this->$strTime];

        return $depDate . ' ' . $depTime;
    }


    public function getType(){

        switch ($this->oneway) {
            case 0:
                return 'flightReturn';
                break;

            case 1:
                return 'flightOneway';
                break;

            default:
                break;
        }

        return $this->type;
        
    }

    public function getOriginFormatResultPage($culture){
        $string = $this->arOrigin['code'];
        $string .= ' '.$this->arOrigin[$culture]['name'];
        $string .= isset($this->arOrigin[$culture]['state'])? ' ['.$this->arOrigin[$culture]['state']['code'].']':'';
        $string .= ', '.$this->arOrigin[$culture]['country'];

        return $string;
    }

    public function getDestinationFormatResultPage($culture){
        $string = $this->arDestination['code'];
        $string .= ' '.$this->arDestination[$culture]['name'];
        $string .= isset($this->arDestination[$culture]['state'])? ' ['.$this->arDestination[$culture]['state']['code'].']':'';
        $string .= ', '.$this->arDestination[$culture]['country'];

        return $string;
    }

    public function getTypeRenamed(){

        $culture = sfContext::getInstance()->getUser()->getCulture();
        return $this->arTypeRenamed[$this->type][$culture];

    }


    public function getOriginDestination($culture = 'en_US'){
        
        return $this->arOrigin['code'].' - '.$this->arDestination['code'];
        
        return $this->arOrigin[$culture]['name'] . ' (' .$this->arOrigin['code'] . ') <br />' .
               $this->arDestination[$culture]['name'] . ' (' .$this->arDestination['code'] . ')';
        

        
    }

    public function getPassengers(){
        $passengers = (int)$this->getAdults() + (int)$this->getChildren() + (int)$this->getInfants();
        return $passengers;
    }

}

