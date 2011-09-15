<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexHotelRateResponse
 * Parse plex soap response for rate terms & conditions, rate detail info
 *
 * @author david
 */
class PlexHotelRateResponse extends PlexResponse implements PlexResponseInterface {

    public $termsConditions = array();
    public $rateDetails = array();

    public function  __construct($response) {
        $this->response = $response;
    }


    public function parseResponse() {

        $responseData = $this->response;

        $timer = sfTimerManager::getTimer('ParseResponse');

        //Parse the response if Success
        $start = strpos($responseData, '<TermsAndConditionsInfo>');
        $end = strrpos($responseData, '</TermsAndConditionsInfo>');

        //Terms and conditions tags 
        if(($start > 0 && $end > 0) || ($start !== false || $end !== false))
        {
            $body = trim(substr($responseData, $start, $end - $start + strlen('</TermsAndConditionsInfo>')));
            $xml = new SimpleXMLElement($body);
            foreach($xml->children() as $value){
                array_push($this->termsConditions, $value);
            }
        }else{
            unset($this->termsConditions);
        }


        $start = strpos($responseData, '<ItineraryDescriptionInfo>');
        $end = strrpos($responseData, '</ItineraryDescriptionInfo>');

        
        

        //Rate detail tags
        if(($start > 0 && $end > 0) || ($start !== false || $end !== false))
        {
            $body = trim(substr($responseData, $start, $end - $start + strlen('</ItineraryDescriptionInfo>')));
            
            $xml = new SimpleXMLElement($body);
            foreach($xml->children() as $value){
                array_push($this->rateDetails, $value);
            }
        }else{
            unset($this->rateDetails);
        }

    }
    

    public function checkResponseCode() {

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
            $infos['plexResponse'] = $response;
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

        $times = sfTimerManager::getTimers();
        $t = $times['PlexRequest'];

    }

    public function analyseResponse(){
        
    }

    public function sendResponse(){
        
    }

}
?>
