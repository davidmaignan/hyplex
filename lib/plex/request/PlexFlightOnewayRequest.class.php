<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexFlightOnewayRequest
 *
 * @author david
 */
class PlexFlightOnewayRequest extends PlexRequest implements PlexRequestInterface {
    
    //put your code here

    public function  __construct($type, $request, $paramFactory) {
        parent::__construct($type, $request, $paramFactory);
    }


    public function buildXML() {

        $timer = sfTimerManager::getTimer('buildXML');

        $sessionTokenId = sfContext::getInstance()->getUser()->getAttribute('sTId');

        //Retrieve the connection parameters
        $this->defineParams(1);

        $paramFactory = $this->paramFactory;

        $this->xml = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"
                        xmlns:plex=\"http://plexconnect.ipm.hypertechsolutions.com\">
                        <soapenv:Header/><soapenv:Body><plex:PLEXC_AirAvailRQ>
                        <plex:SessionTokenId>$sessionTokenId</plex:SessionTokenId>
                        <plex:TransactionId>{$this->transactionId}</plex:TransactionId>
                        <plex:CallingSystemId>{$this->systemName}</plex:CallingSystemId>";

        $this->xml .= "<plex:AirItinerary><plex:OneWay>";

        //Origin
        $this->xml .= "<plex:Origin>" . $paramFactory->getOrigin() . "</plex:Origin>";

        //Destination
        $this->xml .= "<plex:Destination>" . $paramFactory->getDestination() . "</plex:Destination>";

        //DepartureDateTime
        $this->xml .= "<plex:DepartureDateTime>" . $paramFactory->getDateTime('depart') . "</plex:DepartureDateTime>";

        $this->xml .= "</plex:OneWay></plex:AirItinerary>";

        //Non stop flights
        $this->xml .= "<plex:DirectFlight>" . $paramFactory->getPreferNonStop() . "</plex:DirectFlight>";

        //Cabin
        $this->xml .= "<plex:ServiceClass>" . $paramFactory->getCabin() . "</plex:ServiceClass>";

        //Adults
        $this->xml .= "<plex:NumberOfAdults>" . $paramFactory->getAdults() . "</plex:NumberOfAdults>";


        $nbrChildren = $paramFactory->getChildren();
        $nbrInfants = $paramFactory->getInfants();

        if($nbrChildren >0 || $nbrInfants > 0){

            $this->xml .= "<plex:NumberOfChildren>" . $nbrChildren+$nbrInfants . "</plex:NumberOfChildren>";

            $this->xml .= "<plex:ChildrenAges>";

             //Children
            if ($nbrChildren >0) {
                
                foreach ($paramFactory->getChildren() as $value) {
                    $this->xml .= "<plex:Age>10</plex:Age>";
                }
            }

            //Infants (pass an age inferior to 2
            if($nbrInfants > 0){
                for($i=0;$i<$nbrInfants;$i++){
                    $this->xml .= "<plex:Age>0</plex:Age>";
                }

            }


            $this->xml .= "</plex:ChildrenAges>";

        }
        

        $this->xml .=   "</plex:PLEXC_AirAvailRQ></soapenv:Body></soapenv:Envelope>";

        $timer->addTime();

        //print_r(htmlentities($this->xml));
        //break;
        return $this->xml;
    }

    public function executeRequest() {

        $timer = sfTimerManager::getTimer('PlexRequest');

        sfContext::getInstance()->getLogger()->alert('Execute xml for flight Return request');

        ini_set('error_reporting', E_ERROR | E_STRICT);

        $client = new nusoap_client($this->url, false);
        $client->persistentConnection = true;
        $client->soap_defencoding = 'utf-8';
        $client->send($this->xml);

        $this->response = $client->response;

        $timer->addTime();

        ini_restore('error_reporting');

        return $this->response;

        //$this->parseResponse();
    }

}
?>
