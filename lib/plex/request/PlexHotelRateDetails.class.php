<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexHotelRateDetails
 * Request to get terms and conditions for a specific rate
 * @author david
 */
class PlexHotelRateDetails extends PlexRequest implements PlexRequestInterface{
    //put your code here


    //<SessionTokenId>
    //<TransactionId>
    //<CallingSystemId>
    //<HotelId>
    //<UniqueReferenceId>
    private $filename;
    private $hotel;
    protected $uniqueReferenceId;
    

    public function  __construct(HotelSimpleObj $hotel, $filename, $termsConditionId, sfUser $user) {

        
        $this->sTId = $user->getAttribute('sTId');
        $this->filename = $filename;


        $this->termsConditionId = $termsConditionId;

        $this->callingSystemId = 'Hypertech';

        $this->hotel = $hotel;

        //build the xml
        $this->defineParams(1);



    }

    public function buildXML()
    {
         $this->xml  = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"
                            xmlns:plex=\"http://plexconnect.ipm.hypertechsolutions.com\">
                            <soapenv:Header/> <soapenv:Body>
                            <plex:PLEXC_HotelRateDetailRQ>
                                <plex:SessionTokenId>{$this->sTId}</plex:SessionTokenId>
                                <plex:TransactionId>{$this->transactionId}</plex:TransactionId>
                                <plex:CallingSystemId>{$this->callingSystemId}</plex:CallingSystemId>
                                <plex:HotelId>{$this->hotel->id}</plex:HotelId>
                                <plex:UniqueReferenceId>{$this->termsConditionId}</plex:UniqueReferenceId>
                            </plex:PLEXC_HotelRateDetailRQ>
                            </soapenv:Body>
                            </soapenv:Envelope>";


         return $this->xml;

    }

    public function getXML(){
        return $this->xml;
    }
    
    public function executeRequest() {

        //$timer = sfTimerManager::getTimer('PlexRequest');

        //sfContext::getInstance()->getLogger()->alert('Execute xml for flight Return request');

        ini_set('error_reporting', E_ERROR | E_STRICT);

        $client = new nusoap_client($this->url, false);
        $client->persistentConnection = true;
        $client->soap_defencoding = 'utf-8';
        $client->send($this->xml);

        $this->response = $client->response;

        //$timer->addTime();

        ini_restore('error_reporting');

        $pathname = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$this->filename;


        $filename = $pathname.DIRECTORY_SEPARATOR.$this->termsConditionId.'.raw';
        file_put_contents($filename, $this->response);

        chmod($filename, 0777);


        return $this->response;

        //Save the response in a tmp file



    }
    
}
