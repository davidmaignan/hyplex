<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexBookingResponse
 *
 * @author david
 */
class PlexBookingResponse extends PlexResponse implements PlexResponseInterface {
    //put your code here

    public function  __construct($response) {

        $this->response = $response;

        $xml = simplexml_load_string($response);
        //var_dump($xml);

        $this->responseData = $xml;

        $this->responseCode = (int)$xml->ResponseCode;

        /*
        $filename = tempnam(sfConfig::get('sf_user_folder'), 'booking-');
        $fullFilename = $filename.'.raw';
        file_put_contents($fullFilename, $this->response);
        chmod($fullFilename, 0777);

        unlink($filename);
        */
        
        //$xml = simplexml_load_string($response);


        

        $this->response = file_get_contents($filename);
        //$tmp = explode('/', $filename);
    }

    public function checkResponseCode() {



        /*
        ini_set('error_reporting', E_ERROR);

        $response = $this->response;

        $pattern = '#charset=utf-8#';
        $responseSplit = preg_split($pattern, $response);

        $this->responseData = $responseSplit[1];

        //Retreive response code
        $pattern = '#<ResponseCode>.+</ResponseCode>#';
        preg_match_all($pattern, $responseSplit[1], $matchArray);

        if(empty($matchArray)){
            $infos = array();
            $infos['message'] = 'Error while building xml: cannot find response code';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            //exit;
        }

        $code = $matchArray[0][0];

        $start = strpos($code, '>');
        $code = substr($code, $start + 1);

        $end = strpos($code, '<');
        $code = substr($code, 0, $end);

        $this->responseCode = $code;

        //$infosUser = $this->retreiveUserInfos($this->request);
        //$header = $this->getHeader();

        $times = sfTimerManager::getTimers();
        $t = $times['PlexRequest'];
         * 
         */


    }

    /**
     * Save the booking response in a file
     */
    public function parseResponse(){
        
    }

    public function analyseResponse(){

        $responseData = $this->responseData;

        $bookingId = (string)$responseData->BookingId;

        //var_dump($bookingId);
        //exit;
        
        if($bookingId == ''){

            echo 'PlexBookingRespons analyseResponse to complete line 117';
            exit;

            //$event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            //sfContext::getInstance()->getEventDispatcher()->notify($event);
            //sfContext::getInstance()->getController()->forward('error', 'plexError');
            //exit;
        }

        
        

        //var_dump($bookingId);

        $plexBasket = PlexBasket::getInstance();

        $arBooking = array();
        $arBooking['date'] = date('Y-m-d H:m:i');
        $arBooking['bookingId'] = $bookingId;
        $arBooking['sf_user_folder'] = sfConfig::get('sf_user_folder');
        $arBooking['rooms'] = $plexBasket->getArBookingHotel();
        $arBooking['address'] = $plexBasket->getBookingAddress();
        $arBooking['passengers'] = $plexBasket->getBookingPassengers();
        $arBooking['flightFilename'] = $plexBasket->getFlightFilename();
        $arBooking['flight'] = $plexBasket->getFlight();
        $arBooking['hotel'] = $plexBasket->getHotel();
        $arBooking['hotelFilename'] = $plexBasket->getHotelFilename();
        $arBooking['plexResponse'] = $this->response;

        $finalFilename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'booking-'.$bookingId.'.plex';

        //Create plexBooking Object
        $plexBooking = new PlexBooking($arBooking);

        //Delete the raw response - to uncomment for production
        if(file_put_contents($finalFilename, serialize($plexBooking)) !== false){
            //unlink(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'booking-'.$bookingId.'.raw');

            //$booking = new Booking();
            //$booking->saveBooking($plexBooking);

        }

        return $bookingId;

    }

    public function sendResponse(){
        
    }


}


