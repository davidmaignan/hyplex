<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexBookingRequest
 *
 * @author david
 */
class PlexBookingRequest extends PlexRequest implements PlexRequestInterface {


    private $flight;
    private static $arGender = array(0=>'M',1=>'F');

    public function buildXML() {

        

        $timer = sfTimerManager::getTimer('buildXML');

        //Hack to modify url
        

        $plexBasket = PlexBasket::getInstance();

        //Flight
        //$flightReference = $plexBasket->getFlightUniqueReferenceId();
        //Hotel
        //$hotelId = $plexBasket->getHotelId();

        //Use parameter 2 to keep only the numeric keys
        //$passengers = $plexBasket->getBookingPassengers(2);

        //Use parameter 1 to get the passenger ID 
        //$passengerKeys = $plexBasket->getBookingPassengers(1);

        //Retrieve sTId and the connection parameters
        $sessionTokenId = sfContext::getInstance()->getUser()->getAttribute('sTId');
        $this->defineParams();

        //var_dump($passengers);
        //exit;
        //$bookingAddress = $this->paramFactory;
        
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v1="http://plexconnect.ipm.hypertechsolutions.com/v1">
                    <soapenv:Header/><soapenv:Body><v1:PLEXC_CreateBookingRQ>';

        $xml .= "<v1:SessionTokenId>$sessionTokenId</v1:SessionTokenId>";
        $xml .= "<v1:TransactionId>{$this->transactionId}</v1:TransactionId>";


        //Flight
        $flightDatas = $plexBasket->getArBookingFlight();
        
        if(!empty($flightDatas)){
            foreach($flightDatas as $key=>$value){
                $xml .= "<v1:AirBookingInfo>
                        <v1:UniqueReferenceId>{$key}</v1:UniqueReferenceId>
                        <v1:PaxIds>";
                        foreach($value as $id){
                            $xml .= "<v1:PaxId>{$id}</v1:PaxId>";
                        }
                $xml .= "</v1:PaxIds>";
                $xml .= "</v1:AirBookingInfo>";
            }
        }
         
        /*
        $xml .= "<v1:AirBookingInfo>
                    <v1:UniqueReferenceId>{$flightReference}</v1:UniqueReferenceId>
                    <v1:PaxIds>";
                    foreach($passengerKeys as $key){
                        $xml .= "<v1:PaxId>{$key}</v1:PaxId>";
                    }
        $xml .= "</v1:PaxIds>";
        $xml .= "</v1:AirBookingInfo>";         
        */
        
        //Hotel
        $hotelDatas = $plexBasket->getArBookingHotel();
        
        
        if(!empty($hotelDatas)){
            $xml .= " <v1:HotelBookingInfo><v1:HotelId>{$hotelDatas['hotelID']}</v1:HotelId>";

            foreach($hotelDatas['rooms'] as $key_room=> $room){

                $xml .= "<v1:UniqueRateIdInfo>
                           <v1:UniqueReferenceId>".$key_room."</v1:UniqueReferenceId>
                           <v1:PaxIds>";

                foreach($room as $person){
                    $xml .= "<v1:PaxId>". $person ."</v1:PaxId>";
                }
                $xml .= "</v1:PaxIds></v1:UniqueRateIdInfo>";
            }
            $xml  .= "</v1:HotelBookingInfo>";
        }



        $xml .=    "<v1:PassengersInfo>";

        $passengers = $plexBasket->getBookingPassengers(2);

        foreach ($passengers as $key=>$passenger) {

            $xml .= "<v1:PassengerInfo>
                           <v1:PaxId>{$key}</v1:PaxId>
                           <v1:Salutation>{$passenger['salutation']}</v1:Salutation>
                           <v1:PaxFirstName>{$passenger['first_name']}</v1:PaxFirstName>
                           <v1:PaxMiddleName>{$passenger['middle_name']}</v1:PaxMiddleName>
                           <v1:PaxLastName>{$passenger['last_name']}</v1:PaxLastName>
                           <v1:Gender>{$passenger['gender']}</v1:Gender>
                           <v1:DateOfBirth>{$passenger['dob']}</v1:DateOfBirth>
                           <v1:PaxType>{$passenger['type']}</v1:PaxType>";

            if($passenger['frequent_flyer_number'] != ''){
              $xml .= "<v1:FrequentFlyerNumber>{$passenger['frequent_flyer_number']}</v1:FrequentFlyerNumber>
                       <v1:AirlineCode>{$passenger['airline_code']}</v1:AirlineCode>";
              }

              $xml .="<v1:MealPreference>{$passenger['meal_preference']}</v1:MealPreference>
                           <v1:SpecialAssistance>{$passenger['special_assistance']}</v1:SpecialAssistance>
                        </v1:PassengerInfo>";
        }


        $xml .= "</v1:PassengersInfo>";

        //Get Booking address array
        $bookingAddress = $plexBasket->getBookingAddress();


        $xml .=    "<v1:PaymentInfos>
                            <!--Zero or more repetitions:-->
                            <v1:PaymentInfo>
                               <v1:PaymentType>CreditCard</v1:PaymentType>
                               <v1:CreditCardType>VisaCard</v1:CreditCardType>
                               <v1:Amount>" . $plexBasket->getTotalPrice() . "</v1:Amount>
                            </v1:PaymentInfo>
                         </v1:PaymentInfos>
                         <v1:ShippingInfo>
                            <v1:Address1>{$bookingAddress['address_1']}</v1:Address1>
                            <v1:Address2>{$bookingAddress['address_2']}</v1:Address2>
                            <v1:City>{$bookingAddress['city']}</v1:City>
                            <v1:State>{$bookingAddress['state']}</v1:State>
                            <v1:Country>{$bookingAddress['country']}</v1:Country>
                            <v1:PostalCode>{$bookingAddress['postcode']}</v1:PostalCode>
                            <v1:EmailAddress>{$bookingAddress['email']}</v1:EmailAddress>
                            <v1:Phone>{$bookingAddress['telephone']}</v1:Phone>
                            <v1:CellPhone>{$bookingAddress['telephone']}</v1:CellPhone>
                         </v1:ShippingInfo>
                         <!--Zero or more repetitions:-->
                         <v1:DocRequest>
                            <v1:DocEmailId>{$bookingAddress['email']}</v1:DocEmailId>
                            <v1:DocTypeList>
                               <!--Zero or more repetitions:-->
                               <v1:DocType>Direct Consumer Itinerary</v1:DocType>
                            </v1:DocTypeList>
                         </v1:DocRequest>
                      </v1:PLEXC_CreateBookingRQ>
                   </soapenv:Body>
                </soapenv:Envelope>";

        $this->xml = $xml;
      

    }

    /*
    public function executeRequest() {

        //$timer = sfTimerManager::getTimer('PlexRequest');

        //sfContext::getInstance()->getLogger()->alert('Execute xml for flight Return request');

        ini_set('error_reporting', E_ERROR | E_STRICT);

        $client = new nusoap_client($this->url.'_v1', false);
        $client->persistentConnection = true;
        $client->soap_defencoding = 'utf-8';
        $client->send($this->xml);

        $this->response = $client->response;

        //$timer->addTime();

        //echo "<pre>";
        //print_r($this->response);

        ini_restore('error_reporting');

        $pathname = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$this->filename;
        $filename = tempnam(sfConfig::get('sf_user_folder'), 'booking-');
        
        $fullFilename = $filename.'.raw';
        file_put_contents($fullFilename, $this->response);
        chmod($fullFilename, 0777);

        unlink($filename);

        return $fullFilename;

    }
     * 
     */

    public function getXML(){

        return htmlentities(str_replace("/\>", "/\>\n", $this->xml));
    }

    public function executeRequest() {

        $this->url = $this->url.'_v1';


        $timer = sfTimerManager::getTimer('PlexRequest');

        $client = new SoapClient(null,array('location'=>$this->location,'uri'=>$this->uri, 'trace'=>1));
        $response = $client->__doRequest($this->xml, $this->url, 'doAuthorization', 1);

        $header = $this->getHeader($client->__getLastResponseHeaders());
        $infosUser = $this->retreiveUserInfos($this->request);
        $elapsedTime = $timer->getElapsedTime();

        //Http code 200 success, 500 failure ...
        $code = $header['code'][1];

        //If code not 200 -> redirect to error page and save in plexErrorLog
        if($code != 200){
            $this->redirectIfServerError($code, $this->request->getPostParameters(), $response);
        }

        $this->response = ($this->removeSoapEnvelop($response));

        //If cant' create SimpleXMLObject
        if (simplexml_load_string($this->response) === false){

            $infos = array();
            $infos['message'] = 'Error XML: plexResponse cannot be create a simpleXMLObject.';
            $infos['code'] = 500;
            $infos['filename'] = null;
            $infos['parameters'] = $this->request->getPostParameters();
            $infos['response'] = $this->response;

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getLogger()->alert('executeRequest function called in plexRequest');
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            exit;

        }

        $timer->addTime();

        return $this->response;
    }

}

