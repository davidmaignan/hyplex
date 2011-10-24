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
        //$this->url = sfConfig::get('app_plex_url2');


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

    /*
    public function executeRequest() {

        $timer = sfTimerManager::getTimer('PlexRequest');

        $client = new SoapClient(null,array('location'=>$this->location,'uri'=>$this->uri, 'trace'=>1));
        $response = $client->__doRequest($this->xml, $this->url, 'doAuthorization', 1);

        $header = $this->getHeader($client->__getLastResponseHeaders());
        $infosUser = $this->retreiveUserInfos($request);
        $elapsedTime = $timer->getElapsedTime();

        //Http code 200 success, 500 failure ...
        $code = $header['code'][1];

        //If code not 200 -> redirect to error page and save in plexErrorLog
        if($code != 200){
            $this->redirectIfServerError($code, $this->request->getPostParameters(), $response);
        }

        $this->response = simplexml_load_string($this->removeSoapEnvelop($response));

        $header = $client->__getLastResponseHeaders();
        

        $timer->addTime();

        return $this->response;
    }
    */

}


