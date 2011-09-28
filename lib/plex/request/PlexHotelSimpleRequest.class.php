<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexHotelSimpleRequest
 *
 * @author david
 */
class PlexHotelSimpleRequest extends PlexRequest implements PlexRequestInterface {
    //put your code here

    protected $url;

    public function  __construct($type, $request, $paramFactory) {
        parent::__construct($type, $request, $paramFactory);

        $this->url = sfConfig::get('app_plex_url2');
    }

    public function  buildXML() {

        $timer = sfTimerManager::getTimer('buildXML');

        $sessionTokenId = sfContext::getInstance()->getUser()->getAttribute('sTId');

        //Retrieve the connection parameters
        $this->defineParams();

        $paramFactory = $this->paramFactory;

        $this->xml = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"
                        xmlns:plex=\"http://plexconnect.ipm.hypertechsolutions.com\">
                        <soapenv:Header/><soapenv:Body><plex:PLEXC_HotelAvailRQ>
                        <plex:SessionTokenId>$sessionTokenId</plex:SessionTokenId>
                        <plex:TransactionId>{$this->transactionId}</plex:TransactionId>
                        <plex:CallingSystemId>{$this->systemName}</plex:CallingSystemId>";

        //Destination
        $this->xml .= "<plex:DestinationCode>".$paramFactory->getWhereBoxCode()."</plex:DestinationCode>";

        //CheckinDate
        $this->xml .= "<plex:CheckInDate>". $paramFactory->getCheckinDate() ."</plex:CheckInDate>";

        //CheckoutDate
        $this->xml .= "<plex:CheckOutDate>". $paramFactory->getCheckoutDate() ."</plex:CheckOutDate>";

        //Rooms
        $this->xml .= "<plex:RoomRequests>";

        foreach ($paramFactory->arRooms as $key => $value) {
            $this->xml .= "<plex:RoomRequest>";
            $this->xml .= "<plex:RoomRequestGroupId>1</plex:RoomRequestGroupId>";
            $this->xml .= "<plex:UniqueRoomRequestId>Room".($key+1)."</plex:UniqueRoomRequestId>";
            $this->xml .= "<plex:NumberOfAdults>".$value['number_adults']."</plex:NumberOfAdults>";
            $this->xml .= "<plex:NumberOfChildren>".$value['number_children']."</plex:NumberOfChildren>";
            if($value['number_children']>0){
                $this->xml .= "<plex:ChildrenAges>";
                foreach ($value['children_age'] as $v) {
                    $this->xml .= "<plex:Age>".$v['age']."</plex:Age>";
                }
                $this->xml .= "</plex:ChildrenAges>";
            }
            $this->xml .= "</plex:RoomRequest>";
        }
        $this->xml .= "</plex:RoomRequests>";
        $this->xml .=   "</plex:PLEXC_HotelAvailRQ></soapenv:Body></soapenv:Envelope>";

        $timer->addTime();
        
        //print_r(htmlentities($this->xml));
        //break;
        
        return $this->xml;

    }

    public function getXML(){
        return $this->xml;
    }

    public function executeRequest() {

        $timer = sfTimerManager::getTimer('PlexRequest');

        //sfContext::getInstance()->getLogger()->alert('Execute xml for flight Return request');

        ini_set('error_reporting', E_ERROR | E_STRICT);

        $client = new nusoap_client($this->url, false);
        $client->persistentConnection = true;
        $client->soap_defencoding = 'utf-8';
        $client->send($this->xml);

        $this->response = $client->response;

        $timer->addTime();

        ini_restore('error_reporting');

        return $this->response;
    }


}


