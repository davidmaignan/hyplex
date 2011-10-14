<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexKeepAliveRequest
 *
 * @author david
 */
class PlexKeepAliveRequest extends PlexRequest implements PlexRequestInterface {

    protected $sTId;

    public function  __construct($sTId) {
        
        $this->sTId = $sTId;

        $this->defineParams();
        $this->xml = $this->buildXML();
        
    }

    public function  buildXML() {

        $timer = sfTimerManager::getTimer('buildXML');

        $string = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"
                        xmlns:plex=\"http://plexconnect.ipm.hypertechsolutions.com\">
                        <soapenv:Header/><soapenv:Body><plex:PLEXC_KeepAliveRQ>
                        <plex:SessionTokenId>{$this->sTId}</plex:SessionTokenId>
                        <plex:TransactionId>{$this->transactionId}</plex:TransactionId>
                        <plex:CallingSystemId>{$this->systemName}</plex:CallingSystemId>
                        </plex:PLEXC_KeepAliveRQ>
                        </soapenv:Body>
                        </soapenv:Envelope>
                        ";

       return $string;

       $timer->addTime();

    }

    public function  executeRequest() {
        
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
    }


}
?>
