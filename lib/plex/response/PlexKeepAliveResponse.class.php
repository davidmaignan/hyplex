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


    /**
     * Return RespponseCode from plex response
     * @return integer
     */
    public function checkResponseCode() {

        $xml = simplexml_load_string($this->response);
        $this->responseCode = (int)$xml->ResponseCode;
        return $this->responseCode;
    }
}

