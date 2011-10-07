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
    private $arBookingRooms = array();          //Rooms with id of the passengers adults / children
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

    public function addFlight($filename, $uniqueReferenceId){
        array_unshift($this->arFlights,array('filename'=>$filename,'uniqueReferenceId'=>$uniqueReferenceId));
    }


    public function getFlight(){

        if(empty($this->arFlights) || $this->arFlights[0] === null){
            return null;
        }
        return PlexParsing::retreiveFlight($this->arFlights[0]['filename'], $this->arFlights[0]['uniqueReferenceId']);
    }

    public function getFlightFilename(){
        if(empty($this->arFlights)){
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
        if(empty($this->arHotels)){
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

        array_unshift($this->arHotels, $tmp);
        
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
       
        
        /*
        $hotelParameters = array('search_hotel' => array(
            'wherebox' => $wherebox,
            'checkin_date' => $checkin_date,
            'checkout_date' => $checkin_out,
            'newRooms' => array
                (
                    1 => array
                        (
                            'number_adults' => 2,
                            'number_children' => 1
                        )

                ),

            'childrenAge' => array
                (
                    '1_1' => array
                        (
                            'age' => 0
                        )

                ),

            'type' => 'hotelSimple',
            '_csrf_token' => '9bb65d63c895c582e7a0af13d448842a'
        ));
         * 
         */



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

        //echo "<pre>";
        //print_r($hotelParameters);
        //exit;

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

            $hotelParameters = PlexParsing::retreiveParameters($filename);
            $paramRooms = $hotelParameters->newRooms;
            $hotelRooms = $this->getHotelRooms();


            //Retreive the keys for in the Booking passenger array to assign them to the the rooms
            if(isset($this->arBookingPassengers['adults'])){
                $keysAdults = array_keys($this->arBookingPassengers['adults']);
            }
             if(isset($this->arBookingPassengers['children'])){
                $keysAdults = array_keys($this->arBookingPassengers['children']);
            }
            
            
            //var_dump($paramRooms);
            //var_dump($hotelRooms);
            //var_dump($this->arBookingPassengers);

            /* 3 arrays are used: the newRoom from parameters that gives the number of adults and children for
             * each room, hte hotelRoom from the basket gives the uniqueReferenceID
             * and the bookingPassengers in basket that hold identity of the passengers
             *
             * This function distribute the adults and children for each room only give the key -> can retreive the id
             * from the arBookingPassengers array
             *
             */

            foreach($paramRooms as $key=>$room){

                
                //Unique reference Id
                $arReturn[$key]['uniqueReferenceId'] = $hotelRooms['room'.$key];

                //Adult
                if($room['number_adults']){
                    $arReturn[$key]['adults'] = array();
                    for($i=0;$i<$room['number_adults'];$i++){
                        array_push($arReturn[$key]['adults'],  array_shift($keysAdults));
                    }   
                }

                //Children
                if($room['number_children']){
                    $arReturn[$key]['children'] = array();
                    for($i=0;$i<$room['number_children'];$i++){
                        array_push($arReturn[$key]['children'],  array_shift($keysChildren));
                    }
                }
                
            }

           $this->arBookingRooms = $arReturn;

        }

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


    }

    public function getArBookingFlight(){

        if(empty($this->arBookingFlight)){
            $this->distributePassengerPerFlight();
        }

        return $this->arBookingFlight;
    }

    public function addBookingPassengers($values){

        //Adults
        $this->arBookingPassengers = $values;
        $this->arBookingPassengers[0]=null;

        foreach($values as $value){
            foreach($value as $val){
                 array_push($this->arBookingPassengers, $val);
            }

        }

        unset($this->arBookingPassengers[0]);

    }

    public function getBookingPassengers(){

        return $this->arBookingPassengers;

    }

    public function addBookingAddress($values){
        $this->arBookingAddress = $values;
      
        $this->save();

    }

    public function getBookingAddress(){

        return $this->arBookingAddress;

    }

    public function getArBookingRooms(){
        return $this->arBookingRooms;
    }

}

