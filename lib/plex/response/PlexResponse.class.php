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

        

        if ($debug === false) {

            $this->debug = $debug;

            $timer = sfTimerManager::getTimer('PlexResponse');

            if ($type === null || $response === null || $request === null) {
                throw new Exception('Plex response: you must provide a type of search (flightReturn ...) and a response');
            }

            $this->type = $type;
            $this->request = $request;
            $this->response = $response;
            $this->paramFactory = $paramFactory;

            //Create the file to save the raw response prefixed by the type or search (returnFlight, Hotel ...)

            //If hotel create a folder in the user folder to seperate hotel with flights

            switch ($type) {
                case 'hotelSimple':

                    if(!file_exists(sfConfig::get('sf_user_folder').'/hotel')){
                        mkdir(sfConfig::get('sf_user_folder').'/hotel', 0777);
                    }
                    $path = sfConfig::get('sf_user_folder').'/hotel';
                    break;

                default:
                    $path = sfConfig::get('sf_user_folder');
                    break;
            }

            $filename = tempnam($path, $type . '-');
            $tmp = explode('/', $filename);
            $this->filename = $tmp[count($tmp)-1];
            
            chmod($filename, 0777);
            file_put_contents($filename.'.raw', $this->response);
            chmod($filename.'.raw', 0777);

            unlink($filename);
            
            mkdir($filename, 0777);
            
            $timer->addTime();
           
        }else{
            
            $timer = sfTimerManager::getTimer('PlexResponse');
            $this->type = $type;
            $this->request = $request;
            $this->response = $response;
            $this->paramFactory = $paramFactory;
            $this->filename = 'flightOneway-Fx20Gl';

        }
    }

    /*
     * Analyse the response and retreives the header information
     * Save in the database the response received, the date, the IP user, User-agent.
     *
     * @param string $response the response provided by Plex
     * @return PlexResponse accordingly to the type provided
     */

    protected function retreiveUserInfos($request) {
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

    protected function getHeader() {

        //Check the header response and choose the action depending on the status of the response.
        //Temp ---------------------------------
        $filename = $this->getFilename().'.raw';
        $this->response = file_get_contents($filename);
        //--------------------------------------

        $response = $this->response;
        $pattern = '#charset=utf-8#';
        $responseSplit = preg_split($pattern, $response);

        //$header = $responseSplit[0].'charset=utf-8';
        $header = preg_split('#(\r\n|\n)#', $responseSplit[0]);

        $tmp = array();
        $tmp['code'] = explode(' ', $header[0]);
        $tmp['date'] = Utils::formatDateResponse($header[1]);
        $tmp['server'] = trim(substr($header[2], strpos($header[2], ' ') + 1));
        $tmp['raw'] = $responseSplit[0];
        return $tmp;
    }

    /*
     * Get the filename for this response
     * @return string the fullpath to the raw request saved
     */

    public function getFilename() {

        switch ($this->type) {
            case 'hotelSimple':
                $path = sfConfig::get('sf_user_folder').'/hotel';

                break;

            default:
                $path = sfConfig::get('sf_user_folder');
                break;
        }

        return $path.'/'.$this->filename;
        //return $this->filename;
    }

    public function checkResponseCode() {
        
        ini_set('error_reporting', E_ERROR);

        $response = file_get_contents($this->getFilename().'.raw');
       
        $pattern = '#charset=utf-8#';
        $responseSplit = preg_split($pattern, $response);

        $this->responseData = $responseSplit[1];

        //Retreive response code
        $pattern = '#<ResponseCode>.+</ResponseCode>#';
        preg_match_all($pattern, $responseSplit[1], $matchArray);

        if(empty($matchArray)){
            $infos = array();
            $infos['message'] = 'Error while building xml: cannot find response code';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

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

        $infosUser = $this->retreiveUserInfos($this->request);
        $header = $this->getHeader();
        
        $times = sfTimerManager::getTimers();
        $t = $times['PlexRequest'];

        //Calculate validity of sTId depending on the code
        /*
        switch ($code) {
            case 0:
                sfContext::getInstance()->getUser()->setAttribute('sTId_time', (time() + sfConfig::get('app_plexSession_duration')));
                break;

            default:
                break;
        }
         * 
         */
        

    }

    

}
