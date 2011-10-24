<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexResponse
 *
 * Base class for all the PlexResponse objects
 *
 * @author david
 */
class PlexResponse {

    //Variables

    public $type;
    public $response;
    public $request;
    public $header = array();
    public $infoUser = array();
    public $filename;
    public $plexRequestId;      //Id of the saved plexRequest object in the db
    public $arObjs = array();
    public $debug;
    public $paramFactory;

    public $responseData;
    public $responseCode;
    
    /*
     * Constructor creates a unique file to save the raw response from Plex
     * This id is the key to link all the further request with the same information.
     *
     * @param string $type the type of search (flightReturn, flightOneway, Hotel...)
     * @param string $resp the response provided by Plex
     *
     */

    public function __construct($type, $response, $request, $paramFactory, $debug = false) {


        $this->debug = $debug;

        $timer = sfTimerManager::getTimer('PlexResponse');

        if ($type === null || $response === null || $request === null) {
            throw new Exception('Plex response: you must provide a type of search (flightReturn ...) and a response');
        }

        $this->type = $type;
        $this->request = $request;
        $this->response = $response;
        $this->paramFactory = $paramFactory;
        
        //If hotel create a folder in the user folder to seperate hotel with flights

        switch ($type) {
            case 'hotelSimple':

                if(!file_exists(sfConfig::get('sf_user_folder').'/hotel')){
                    mkdir(sfConfig::get('sf_user_folder').'/hotel', 0777);
                }
                $path = sfConfig::get('sf_user_folder').'/hotel';
                break;

            case preg_match('#flight#', $type)>0:
                if(!file_exists(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'flight')){
                    mkdir(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'flight', 0777);
                }
                $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'flight';
                break;

            case preg_match('#package#', $type)>0:
                if(!file_exists(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'package')){
                    mkdir(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'package', 0777);
                }
                $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'package';
                break;

            case preg_match('#car#', $type)>0:
                if(!file_exists(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'car')){
                    mkdir(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'car', 0777);
                }
                $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'car';
                break;

            case preg_match('#excursion#', $type)>0:
                if(!file_exists(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'excursion')){
                    mkdir(sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'excursion', 0777);
                }
                $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'excursion';
                break;

            default:
                $path = sfConfig::get('sf_user_folder');
                break;
        }

        $filename = tempnam($path, $type . '-');
        unlink($filename);
        mkdir($filename, 0777);

        $tmp = explode('/', $filename);
        $this->filename = $tmp[count($tmp)-1];

        $fullFilename = $this->getFilename('xml');

        file_put_contents($fullFilename, $response);
        chmod($fullFilename, 0777);

        $timer->addTime();

    }

    /*
     * Analyse the response and retreives the header information
     * Save in the database the response received, the date, the IP user, User-agent.
     *
     * @param string $response the response provided by Plex
     * @return PlexResponse accordingly to the type provided
     */

    public function retreiveUserInfos($request = null) {

        if(is_null($request)){
            $request = $this->request;
        }

        $path = $request->getHttpHeader('info', 'path');
        $path = explode('/', $path);
        $userCulture = $path[1];

        $tmp = array();
        $tmp['ip'] = $request->getHttpHeader('addr', 'remote');
        $tmp['culture'] = $userCulture;
        $tmp['userAgent'] = $request->getHttpHeader('user-Agent');
        $tmp['date'] = $request->getHttpHeader('Date');
        $tmp['folder'] = $request->getCookie('hypertech_user_folder');

        return $tmp;
    }


    /**
     * Get the filename for this response
     * @return string the fullpath to the raw request saved
     */
    public function getFilename($type = '') {

        switch (true) {
            case preg_match('#hotel#', $this->type)>0:
                $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel';
                break;

            case preg_match('#flight#', $this->type)>0:
                 $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'flight';
                break;

            case preg_match('#car#', $this->type)>0:
                 $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'car';
                break;

            case preg_match('#excursion#', $this->type)>0:
                 $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'excursion';
                break;

            case preg_match('#package#', $this->type)>0:
                 $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'package';
                break;

            default:
                $path = sfConfig::get('sf_user_folder');
                break;
        }



        switch ($type) {
            case 'raw':
                $file = 'plexResponse.raw';
                break;

            case 'xml':
                $file = 'plexResponse.xml';
                break;

            case 'plex':
                $file = 'plexResponse.plex';
                break;

            case 'markers':
                $file = 'plexResponse.markers';
                break;

            case 'filters':
                $file = 'plexResponse.filters';
                break;

            default:
                $file = null;
                break;
        }

        return $path.DIRECTORY_SEPARATOR.$this->filename.DIRECTORY_SEPARATOR.$file;
        //return $this->filename;
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
