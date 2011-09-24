<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexKeepAliveResponse
 *
 * @author david
 */
class PlexKeepAliveResponse {

    public $responseCode;
    private $response;

    public function  __construct($response) {

        $this->response = $response;

    }

    public function  checkResponseCode() {

        $response = $this->response;
        
        $pattern = '#charset=utf-8#';
        $responseSplit = preg_split($pattern, $response);

        $this->responseData = $responseSplit[1];

        //Retreive response code
        $pattern = '#<ResponseCode>.+</ResponseCode>#';
        preg_match_all($pattern, $responseSplit[1], $matchArray);

        if(empty($matchArray)){
            $infos = array();
            $infos['message'] = 'Error while keeping alive: cannot find response code';
            
            
            //$event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            //sfContext::getInstance()->getEventDispatcher()->notify($event);
            //sfContext::getInstance()->getController()->forward('error', 'plexError');
            //exit;
        }

        $code = $matchArray[0][0];

        $start = strpos($code, '>');
        $code = substr($code, $start + 1);

        $end = strpos($code, '<');
        $code = substr($code, 0, $end);

        $this->responseCode = $code;
    }

}
?>
