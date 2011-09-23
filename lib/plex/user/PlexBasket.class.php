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

    public function getHotelFilename(){
        return $this->arHotels[0]['filename'];
    }

    public function addHotel($filename, $slug, $parameters, $roomIds){

        $tmp = array();
        $tmp['filename'] = $filename;
        $tmp['slug'] = $slug;
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

    public function remove($type){

        switch($type){
            case 'flight':
                $this->arFlights[0] = null;
                break;
            case 'hotel':
                $this->arHotels[0] = null;
                break;
        }

        //var_dump($this->arFlights);

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
        $csrf_token = md5($secret.session_id().get_class(new SearchHotelForm()));
       
        
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
}

