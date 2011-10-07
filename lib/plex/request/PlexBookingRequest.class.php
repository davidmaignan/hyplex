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

        $this->url = $this->url.'_v1';

        $plexBasket = PlexBasket::getInstance();
        

        $rooms = $plexBasket->getArBookingRooms();
        //var_dump($plexBasket->getBookingPassengers());
        //var_dump($rooms);

        $flightReference = $plexBasket->getFlightUniqueReferenceId();
        $hotelId = $plexBasket->getHotelId();
        $passengers = $plexBasket->getBookingPassengers();
        $bookingAddress = $plexBasket->getBookingAddress();

        //var_dump($bookingAddress);
        //exit;

        $timer = sfTimerManager::getTimer('buildXML');
        $sessionTokenId = sfContext::getInstance()->getUser()->getAttribute('sTId');

        //Retrieve the connection parameters
        $this->defineParams();


        //$bookingAddress = $this->paramFactory;
        
        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v1="http://plexconnect.ipm.hypertechsolutions.com/v1">
                    <soapenv:Header/><soapenv:Body><v1:PLEXC_CreateBookingRQ>';

        $xml .= "<v1:SessionTokenId>$sessionTokenId</v1:SessionTokenId>";
        $xml .= "<v1:TransactionId>{$this->transactionId}</v1:TransactionId>";
        $xml .= "<v1:AirBookingInfo>
                    <v1:UniqueReferenceId>{$flightReference}</v1:UniqueReferenceId>
                    <v1:PaxIds>
                       <v1:PaxId>1</v1:PaxId>
                    </v1:PaxIds>
                 </v1:AirBookingInfo>";

         

        $xml .=    "<v1:PassengersInfo>
                    <!--Zero or more repetitions:-->
                        <v1:PassengerInfo>
                           <v1:PaxId>1</v1:PaxId>
                           <v1:Salutation>Mr</v1:Salutation>
                           <v1:PaxFirstName>John</v1:PaxFirstName>
                           <v1:PaxMiddleName>David</v1:PaxMiddleName>
                           <v1:PaxLastName>Smith</v1:PaxLastName>
                           <v1:Gender>M</v1:Gender>
                           <v1:DateOfBirth>1970-01-01</v1:DateOfBirth>
                           <v1:PaxType>ADT</v1:PaxType>
                           <v1:FrequentFlyerNumber>123456789</v1:FrequentFlyerNumber>
                           <v1:MealPreference>SFML</v1:MealPreference>
                           <v1:SpecialAssistance>WCHR</v1:SpecialAssistance>
                        </v1:PassengerInfo>
                    </v1:PassengersInfo>";

        $xml .=    "<v1:PaymentInfos>
                            <!--Zero or more repetitions:-->
                            <v1:PaymentInfo>
                               <v1:PaymentType>CreditCard</v1:PaymentType>
                               <v1:CreditCardType>VisaCard</v1:CreditCardType>
                               <v1:Amount>740.73</v1:Amount>
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

        ini_restore('error_reporting');

        $pathname = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$this->filename;
        $filename = tempnam(sfConfig::get('sf_user_folder'), 'booking-');
        
        $fullFilename = $filename.'.raw';
        file_put_contents($fullFilename, $this->response);
        chmod($fullFilename, 0777);

        unlink($filename);

        return $fullFilename;

        //Save the response in a tmp file



    }


}

