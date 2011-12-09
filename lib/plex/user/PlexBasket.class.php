<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexBasket
 *
 * @author david
 */
class PlexBasket {
    
    //Variables
    private static $instance;
    private $arFlights = array();
    private $arFlightsArchived = array();
    private $arHotels = array();
    private $arHotelsArchived = array();
    private $culture;

    private $arBookingPassengers = array();
    private $arBookingAddress = array();
    private $arBookingHotel = array();          //Rooms with id of the passengers adults / children
    private $arBookingFlight = array();         //Flight reference with id of the passengers adults / children

    private $total = array();

    private function  __construct() {
        $this->culture = sfContext::getInstance()->getUser()->getCulture();
    }

    public static function getInstance(){

        if(!self::$instance){
            self::$instance = new PlexBasket();
        }
        
        return self::$instance;
    }

    public function setInstance($o) {
        
        self::$instance = $o;
    }
    

    public function  __destruct() {
        $basketFile = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'basket';
        $content = serialize($this);
        file_put_contents($basketFile, $content);
    }

    public function save(){
        $basketFile = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'basket';
        $content = serialize($this);
        file_put_contents($basketFile, $content);
    }

    private function  __clone() { }

    public function setItemToHistoric($item){
        
    }

    /**
     * Function to delete all datas from previous booking
     */
    public function reset(){
        
        //echo "basket reset is called";
        //$request = sfContext::getInstance()->getRequest();
        //$parameters = $request->getParameterHolder();
        //var_dump($parameters);
        //exit;

        $this->arFlights = array();
        $this->arFlightsArchived = array();
        $this->arHotels = array();
        $this->arHotelsArchived = array();
        $this->culture;

        $this->arBookingPassengers = array();
        $this->arBookingAddress = array();
        $this->arBookingHotel = array();          //Rooms with id of the passengers adults / children
        $this->arBookingFlight = array();         //Flight reference with id of the passengers adults / children

        $this->total = array();

        $this->save();

    }

    /*
    public function setAllItemsToHistoric(){

        //Flight
        foreach ($this->arFlights as $key=>$flight) {
            array_push($this->arFlightsArchived, $flight);
            unset ($this->arFlights[$key]);
        }

        foreach ($this->arHotels as $key=>$hotel) {
            array_push($this->arHotelsArchived, $hotel);
            unset ($this->arHotels[$key]);
        }

    }
     * 
     */

    public function addFlight($filename, $uniqueReferenceId){
        $this->arFlights[0] = array('filename'=>$filename,'uniqueReferenceId'=>$uniqueReferenceId);
        //array_unshift($this->arFlights,array('filename'=>$filename,'uniqueReferenceId'=>$uniqueReferenceId));
    }


    public function getFlight(){

        if(empty($this->arFlights) || $this->arFlights[0] === null){
            return null;
        }
        return PlexParsing::retreiveFlight($this->arFlights[0]['filename'], $this->arFlights[0]['uniqueReferenceId']);
    }

    public function getFlightFilename(){
        if(empty($this->arFlights) || is_null($this->arFlights[0])){
            return null;
        }
        return $this->arFlights[0]['filename'];

    }

    public function getFlightUniqueReferenceId(){

        if(empty($this->arFlights)){
            return null;
        }
        return $this->arFlights[0]['uniqueReferenceId'];
    }

    public function getHotelFilename(){
        if(empty($this->arHotels) || is_null($this->arHotels[0])){
            return null;
        }
        return $this->arHotels[0]['filename'];
    }

    public function addHotel($filename, $slug, $hotelId, $parameters, $roomIds){

        $tmp = array();
        $tmp['filename'] = $filename;
        $tmp['slug'] = $slug;
        $tmp['hotelId'] = $hotelId;
        $tmp['rooms'] = array_combine($roomIds, $parameters);

        $this->arHotels[0] = $tmp;
        //array_unshift($this->arHotels, $tmp);
        
    }

    public function getHotel(){

        if(empty($this->arHotels) || $this->arHotels[0] === null){
            return null;
        }

        $hotel = PlexParsing::retreiveHotel($this->arHotels[0]['filename'], $this->arHotels[0]['slug']);
        $hotel->cleanRates($this->arHotels[0]['rooms']);

        return $hotel;

    }

    public function getHotelId(){
        if(empty($this->arHotels) || $this->arHotels[0] === null){
            return null;
        }

        return $this->arHotels[0]['hotelId'];
    }

    public function getHotelRooms(){
        if(empty($this->arHotels) || $this->arHotels[0] === null){
            return null;
        }

        return $this->arHotels[0]['rooms'];
    }
    
    
    public function remove($type){

        switch($type){
            case 'flight':
                $this->arFlights[0] = null;
                break;
            case 'hotel':
                $this->arHotels[0] = null;
                break;
        }

        $this->save();

    }

    public function getHotelComplementaryParameters(){

        sfProjectConfiguration::getActive()->loadHelpers(array('Number','Date', 'I18N', 'Url', 'Asset', 'Tag'));

        $flight = $this->getFlight();
        $parameters = PlexParsing::retreiveParameters($this->getFlightFilename());

        $numberAdults = (int)$parameters->getAdults();
        //echo $numberAdults;
        $numberChildren = (int)$parameters->getChildren() + (int)$parameters->getInfants();

        //$wherebox = $parameters->getDestination();

        //$wherebox = '('.$flight->SegmentOutbound->ArrivalTo.')';
        $wherebox = $parameters->getAirportFormatInput($parameters->arDestination,sfContext::getInstance()->getUser()->getCulture());
        $checkin_date = format_date($flight->SegmentOutbound->Arrives, 'i');
        $checkin_out = format_date($flight->SegmentInbound->Departs, 'i');
        //var_dump($parameters);
        //exit;

        $newRooms = array();
        $numberOfRooms = (int)ceil($numberAdults/2);
        $childperRoom = ceil($numberChildren/$numberOfRooms);
        
        for($i=1;$i<=$numberOfRooms;$i++){

            $numberAdultsPerRoom = ($numberAdults > 2)? 2 : $numberAdults;
            $newRooms[$i]['number_adults'] = $numberAdultsPerRoom;
            $newRooms[$i]['number_children'] = ($numberChildren > $childperRoom)? $childperRoom: $numberChildren;
            $numberAdults -= 2;
            $numberChildren -= $childperRoom;
        }

      
        
        //If kids, distribute them equally per room
        $numberChildren = (int)$parameters->getChildren() + (int)$parameters->getInfants();
        if($numberChildren >0){

           
            //Create array to hold children ages
            $arChildrenAge = array();
            foreach($newRooms as $key=>$room){
                for($i=1;$i<=$room['number_children'];$i++ ){

                    $arChildrenAge[$key.'_'.$i] = null;
                }
            }
        }

        //Generate crsf_token
        $secret = sfConfig::get('sf_csrf_secret');
        $csrf_token = $this->getCSRFToken(new SearchHotelForm());

        $hotelParameters = array(
            'wherebox' => $wherebox,
            'checkin_date' => $checkin_date,
            'checkout_date' => $checkin_out,
            'newRooms' => $newRooms,
            'type' => 'hotelSimple',
            '_csrf_token' => $csrf_token
        );

        //Add children age if children
        if(!empty($arChildrenAge)){
            $hotelParameters['childrenAge'] = $arChildrenAge;
        }

        return $hotelParameters;
        
    }

    public function getCSRFToken(sfForm $form){
        $secret = sfConfig::get('sf_csrf_secret');
        $csrf_token = md5($secret.session_id().get_class($form));
        return $csrf_token;
    }


    public function getPassengers(){

        $tmp = array();
        $flightFilename = $this->getFlightFilename();
        if(!is_null($flightFilename)){
            $flightParameters = PlexParsing::retreiveParameters($flightFilename);
            $tmp['flight'] = array( 'adults'=>$flightParameters->getAdults(),
                                'children'=>$flightParameters->getChildren(),
                                'infants'=>$flightParameters->getInfants());
        }

        $hotelFilename = $this->getHotelFilename();
        if(!is_null($hotelFilename)){
            $hotelParameters = PlexParsing::retreiveParameters($hotelFilename);
            $tmp['hotel'] = array('adults'=>$hotelParameters->getNumberAdults(),
                              'children'=>$hotelParameters->getNumberChildren());
        }

        return $tmp;
    }


    public function getAdults(){

        $tmp = $this->getPassengers();
        $total = 0;

        if(isset($tmp['flight'])){

            $total = (int)$tmp['flight']['adults'];

        }else if(isset($tmp['hotel'])){

              $total = (int)$tmp['hotel']['adults'];
        }

        return $total;

    }

    public function getChildren(){

        $tmp = $this->getPassengers();
        $total = 0;

        if(isset($tmp['flight'])){

            $total = (int)$tmp['flight']['children'] + (int)$tmp['flight']['infants'];

        }else if(isset($tmp['hotel'])){

            $total = (int)$tmp['hotel']['children'];
        }

        return $total;

    }

    public function getTotalPassengers(){

        $tmp = $this->getPassengers();
        $total = 0;

        if(isset($tmp['flight'])){

            foreach($tmp['flight'] as $tmp){
                $total += (int)$tmp;
            }

        }else if(isset($tmp['hotel'])){
            
             foreach($tmp['hotel'] as $tmp){
                $total += (int)$tmp;
            }
        }
        return $total;

    }

    

    /**
     *
     * @param <type> $values
     *
     * create an array
           room level - 1 =>
                          array
                            'uniqueReferenceId' => string 'qdlbu138g7qc95jqt55hsb1l0c' (length=26)
                            'adults' => array(0, 2, 3...) {keys of the passenger from arBookingPassengers['adults']
     *                      'children'=> array(0, 2, 3...), {keys of the passenger from arBookingPassengers['children']
     *     room level - 2 => ....
     *
     * 
     */
    public function distributePassengerPerRoom($values = null){

        $arReturn = array();

        if($values === null){

            $filename = $this->getHotelFilename();

            if(is_null($filename)){
                return $this->arBookingHotel = array();
            }

            $hotelParameters = PlexParsing::retreiveParameters($filename);
            $childrenAges = $hotelParameters->childrenAge;
            $paramRooms = $hotelParameters->newRooms;
            $hotelRooms = $this->getHotelRooms();

            $passengers = $this->getBookingPassengers();


            //Retreive the keys for in the Booking passenger array to assign them to the the rooms

            $arReturn = array_fill(1, count($hotelRooms), array());

            //$this->arBookingHotel = array_combine($hotelRooms, $arReturn);

            foreach($paramRooms as &$room){
                $room['number_children'] = array();
            }

            foreach($childrenAges as $key=>$childAge){
                $index = $key[0];
                array_push($paramRooms[$index]['number_children'],$childAge['age']);
            }

            //echo "<pre>";
            //print_r($paramRooms);
            //var_dump($passengers);

            foreach ($paramRooms as $key_1=>$value_1) {

                foreach($value_1 as $key_2=>$value_2){
                    
                    //number_adults: int
                    if($key_2 == 'number_adults'){

                        for($i=0;$i<$value_2;$i++){
                            array_push($arReturn[$key_1], $this->getPassenger($passengers, 'ADT'));
                        }

                        //var_dump($value_2);
                    }

                    if($key_2 == 'number_children'){

                        foreach($value_2 as $value_3){
                            array_push($arReturn[$key_1], $this->getPassenger($passengers, 'CHD', $value_3));
                        }
                       //var_dump($value_2);
                    }
                    
                }

            }

            //echo $this->getPassenger($passengers, 'ADT');
            
            //var_dump($passengers);
            //var_dump($arReturn);

            $tmp = array_combine($hotelRooms, $arReturn);
            $this->arBookingHotel['hotelID'] = $this->getHotelId();
            $this->arBookingHotel['rooms'] = $tmp;

            //var_dump($arReturn);

            //exit;

        }

    }

    private function getPassenger(&$array, $type, $age = null){
        
        foreach($array as $key=>$passenger){

            if($passenger['type'] == $type && $type == 'ADT'){
                unset($array[$key]);
                return $key;
            }else if($passenger['age'] == $age){
                unset($array[$key]);
                return $key;
            }

        }

    }


    public function getArBookingHotel(){

        $this->arBookingHotel = array();

        if(empty($this->arBookingHotel)){
            $this->distributePassengerPerRoom();
        }

        return $this->arBookingHotel;
        
    }


    public function distributePassengerPerFlight(){

        $filename = $this->getFlightFilename();
        $flightParameters = PlexParsing::retreiveParameters($filename);

        //Retreive the number of adults / children / infants for the fligth
        $adults = $flightParameters->getAdults();
        $children = $flightParameters->getChildren();
        $infants = $flightParameters->getInfants();
        
        /**
         * Here I assume that all the passengers are attached to this flight
         * It might be different in the future
         */
        $keys = array_keys($this->arBookingPassengers);

        //Remove 'adults' and 'children' keys to keep only the numeric one.
        foreach($keys as $k=>$key){
            if(!is_int($key)) unset($keys[$k]);
        }
        //var_Dump($keys);

        $uniqueReferenceId = $this->arFlights[0]['uniqueReferenceId'];
        $this->arBookingFlight[$uniqueReferenceId] = $keys;

        return $this->arBookingFlight;
    }

    public function getArBookingFlight(){
        
        if(empty($this->arBookingFlight) && !is_null($this->getFlightFilename())){
            $this->distributePassengerPerFlight();
        }

        return $this->arBookingFlight;
        

    }
    /**
     *
     * @param <type> $values
     */
    public function addBookingPassengers($values){

        //Adults
        $this->arBookingPassengers = $values;
        $this->arBookingPassengers[0]=null;

        //Hotel - retreive checkin date to calculate the age
        $hotelFilename = $this->getHotelFilename();

        if(!is_null($hotelFilename)){
            $hotelParams = PlexParsing::retreiveParameters($hotelFilename);
            //$hotelParams = new PlexHotelParameters($type, $params, $culture);
            $checkIn = $hotelParams->getCheckinDate();
        }

        foreach($values as $key=>$value){
            foreach($value as &$val){
                 $val['type'] = ($key == 'adults')? 'ADT':'CHD';
                 $val['gender'] = ($val['gender'] == 0)? 'M':'F';
                 $val['age'] = Utils::getAge($val['dob'], $checkIn);
                 array_push($this->arBookingPassengers, $val);
            }
        }

       
        unset($this->arBookingPassengers[0]);

        //var_dump($this->arBookingPassengers);
        //exit;
    }

    /**
     * Return the booking array passengers
     * @param <int> $keys 0 = unchanged, 1 = keys ony, 2 = numeric keys only (adults, children keys removed)
     * @return <array>
     */
    public function getBookingPassengers($keys = 2){

        $tmp = $this->arBookingPassengers;

        switch ($keys) {
            case 0:
                return $tmp;
                break;

            case 1:
                $tmp = array_keys($tmp);
                foreach($tmp as $k=>$key){
                    if(!is_int($key)) unset($tmp[$k]);
                }
                return $keys;
                break;

            case 2:

                foreach ($tmp as $key => $value) {
                    if(!is_int($key)) unset($tmp[$key]);
                }
                
                break;
        }

        return $tmp;
        
    }

    public function addBookingAddress($values){
        $this->arBookingAddress = $values;
        $this->save();
    }

    public function getBookingAddress(){

        return $this->arBookingAddress;

    }



    public function getTotalPrice(){

        $total = 0;

        //Flight
        $flight = $this->getFlight();
        if(!is_null($flight)){
            $total += $flight->TotalPrice;
        }

        $hotel = $this->getHotel();

        if(!is_null($hotel)){
            $total += $hotel->getTotalPrice();
        }

        return $total;
        
    }

    /**
     * Function to return childrenAges entered in search form for hotel
     * and number of children and infatns for search Flight
     *
     * Use for validation for passenger forms to check if
     *
     * @return <array>
     */
    public function getChildrenAges(){

        $tmp = array('hotel'=>array(),'flight'=>array());

        $hotel= $this->getHotel();

        //Check if hotel exists cause user enter the age of children
        if(!is_null($hotel)){

            //Get hotel params
            $hotelParams = PlexParsing::retreiveParameters($this->getHotelFilename());
            
            $tmp['hotel']['age'] = $hotelParams->getChildrenAge();
            $tmp['hotel']['checkin'] = $hotelParams->getCheckinDate();
        }

        //Check if flight
        $flight = $this->getFlight();
        
        if(!is_null($flight)){

            $returnDate = explode(' ', $flight->SegmentInbound->Departs);

            $flightParams = PlexParsing::retreiveParameters($this->getFlightFilename());
            $tmp['flight']['age'] = array('children'=>$flightParams->getChildren(),'infants'=>$flightParams->getInfants());
            $tmp['flight']['returnDate'] = $returnDate[0];
        }

        return $tmp;

        
    }

}

