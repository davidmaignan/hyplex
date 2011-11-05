<?php

/**
 * Description of Abstract PlexRequest
 * Abstract class to initialize sTId with Plex
 * Constructor check presence of sTId in user object - No will create an initial request check response code
 * and on success will save sTId in user object
 * if sTId exist return true directly
 *
 * @author david
 */
abstract class PlexRequest{
    
    protected $sTId;
    protected $url;
    protected $username;
    protected $password;
    protected $transactionId;
    protected $systemName;
    protected $companyId;
    protected $partnerId;
    protected $xml;
    protected $response;
    public    $header = array();
    public    $type;
    protected $request;
    protected $infosUser = array();
    public    $return;
    public    $paramFactory;
    public    $dispatcher;

    public function  __construct($type, $request, $paramFactory) {

        $this->type = $type;
        $this->request = $request;
        $this->paramFactory = $paramFactory;

        //Retreive the connection parameters
        $this->defineParams();

        //check if a sessionTokenId (sTId) already exists
        $user = sfContext::getInstance()->getUser();
        $this->sTId = $user->getAttribute('sTId');
    
        if($this->sTId === null){

            $timer = sfTimerManager::getTimer('RequestInitPlex');

            //build the xml
            $this->xml = $this->buildXML();

            $client = new SoapClient(null,array('location'=>$this->location,'uri'=>$this->uri,'trace'=>1));
            $response = $client->__doRequest($this->xml, $this->url, 'doAuthorization', 1);

            //Retreive info from the request (header, user ...)
            $header = $this->getHeader($client->__getLastResponseHeaders());
            $infosUser = $this->retreiveUserInfos($this->request);
            $elapsedTime = $timer->getElapsedTime();

            //Http code 200 success, 500 failure ...
            $code = $header['code'][1];

            //If code not 200 -> redirect to error page and save in plexErrorLog
            if($code != 200){
                $this->redirectIfServerError($code, $this->request->getPostParameters(), $response);
            }
            
            //Save RequestInitPlex
            $xmlResponse = simplexml_load_string($this->removeSoapEnvelop($response));
            $sessionTokenId = (string)$xmlResponse->SessionTokenId;
            $saveResponse = new RequestInitPlex();
            $saveResponse->advancedSave($infosUser, $header, $elapsedTime, $sessionTokenId);
            $user->setAttribute('sTId',$sessionTokenId);
            $user->setAttribute('sTId_time', (time() + sfConfig::get('app_plexSession_duration')));
        }
    }

    protected function defineParams($i = 0)
    {

        $i = sfConfig::get('plex_ipm');

        if($i == 0){
            $this->url = sfConfig::get('app_plex_url');
            $this->location = sfConfig::get('app_plex_location');
            $this->uri = sfConfig::get('app_plex_uri');
            $this->username = sfConfig::get('app_plex_username');
            $this->password = sfConfig::get('app_plex_password');
            $this->transactionId = sfConfig::get('app_plex_transactionId');
            $this->systemName = sfConfig::get('app_plex_systemName');
            $this->companyId = sfConfig::get('app_plex_companyId');
            $this->partnerId = sfConfig::get('app_plex_partnerId');
        }else if($i==1){
            $this->url = sfConfig::get('app_plex2_url');
            $this->location = sfConfig::get('app_plex2_location');
            $this->uri = sfConfig::get('app_plex2_uri');
            $this->username = sfConfig::get('app_plex2_username');
            $this->password = sfConfig::get('app_plex2_password');
            $this->transactionId = sfConfig::get('app_plex2_transactionId');
            $this->systemName = sfConfig::get('app_plex2_systemName');
            $this->companyId = sfConfig::get('app_plex2_companyId');
            $this->partnerId = sfConfig::get('app_plex2_partnerId');
        }else if($i==2){
            $this->url = sfConfig::get('app_plex3_url');
            $this->location = sfConfig::get('app_plex3_location');
            $this->uri = sfConfig::get('app_plex3_uri');
            $this->username = sfConfig::get('app_plex3_username');
            $this->password = sfConfig::get('app_plex3_password');
            $this->transactionId = sfConfig::get('app_plex3_transactionId');
            $this->systemName = sfConfig::get('app_plex3_systemName');
            $this->companyId = sfConfig::get('app_plex3_companyId');
            $this->partnerId = sfConfig::get('app_plex3_partnerId');
        }
        
    }

    private function buildXML()
    {
        $string = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\"
                            xmlns:plex=\"http://plexconnect.ipm.hypertechsolutions.com\">
                            <soapenv:Header/> <soapenv:Body>
                            <plex:PLEXC_AuthorizationRQ>
                            <plex:TransactionId>{$this->transactionId}</plex:TransactionId>
                            <plex:CallingSystemId>{$this->systemName}</plex:CallingSystemId>
                            <plex:CompanyId>{$this->companyId}</plex:CompanyId>
                            <plex:PartnerId>{$this->partnerId}</plex:PartnerId>
                            <plex:UserName>{$this->username}</plex:UserName>
                            <plex:Password>{$this->password}</plex:Password>
                            </plex:PLEXC_AuthorizationRQ>
                            </soapenv:Body>
                            </soapenv:Envelope>
                            ";

         //echo htmlentities($string);
         //exit;

         return $string;
    }

    /**
     * Parse header string and return an array with header info.
     * @param string $response
     * @return array
     */
    protected function getHeader($response) {

        $header = preg_split('#(\r\n|\n)#', $response);
        $tmp['code'] = explode(' ', $header[0]);
        $tmp['date'] = Utils::formatDateResponse($header[1]);
        $tmp['server'] = trim(substr($header[2], strpos($header[2], ' ')+1));
        $tmp['raw'] = $response;

        return $tmp;
    }

    /**
     * Take a sfWebRequest and return different info about the http header
     * @param sfWebRequest $request
     * @return array
     */
    protected function retreiveUserInfos($request)
    {

        //$path = $request->getHttpHeader('info','path');
        //$path = explode('/', $path);
        //$userCulture = $path[1];

        $tmp = array();
        $tmp['ip'] = $request->getHttpHeader('addr','remote');
        $tmp['culture'] = null;
        $tmp['userAgent'] = $request->getHttpHeader('user-Agent');
        $tmp['date'] = $request->getHttpHeader('Date');
        $tmp['folder'] = $request->getCookie('hypertech_user_folder');

        return $tmp;
    }

    /**
     * Not in use anymore - to delete for production
     * @param <type> $response
     * @param <type> $user
     * @return <type> 
     */
    protected function getStId($response, $user)
    {
         $pattern = '#\<SessionTokenId\>.+\<\/SessionTokenId\>#';
         preg_match_all($pattern, $response, $matchesarray);
         $sessionTokenId = $matchesarray[0][0];
         $sessionTokenId = substr($sessionTokenId, 16, -17);

         $user->setAttribute('sTId',$sessionTokenId);
         $user->setAttribute('sTId_time', (time() + sfConfig::get('app_plexSession_duration')));

         return $sessionTokenId;
    }

    /**
     * Remove the soap envelop from the plex Response
     * @param string $string
     * @return string
     */
    protected function removeSoapEnvelop($string){

        $pattern = '#<soapenv:Body>.+</soapenv:Body>#';
        preg_match_all($pattern, $string, $matchArray);

        if(empty($matchArray)){

            $infos = array();
            $infos['message'] = 'Error removingSoapEnvelop ';
            $infos['code'] = null;
            $infos['filename'] = null;
            $infos['parameters'] = $this->paramFactory;
            $infos['response'] = $string;

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getLogger()->alert('redirectIfServerError function called in plexRequest');
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');

        }

        return '<?xml version="1.0" encoding="utf-8"?>'.substr($matchArray[0][0], strlen('<soapenv:Body>'),- strlen('</soapenv:Body>'));

    }

    /**
     * Redirect controller and dispatch plex.responsexml_error event to save in sfErrorLog
     * @param int $code
     * @param array $parameters
     * @param string $response
     */
    protected function redirectIfServerError($code, $parameters, $response){

        $infos = array();
        $infos['message'] = 'Error plex: '.$code.' sent back by server';
        $infos['code'] = $code;
        $infos['filename'] = null;
        $infos['parameters'] = $parameters;
        $infos['response'] = $response;

        $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
        sfContext::getInstance()->getLogger()->alert('redirectIfServerError function called in plexRequest');
        sfContext::getInstance()->getEventDispatcher()->notify($event);
        sfContext::getInstance()->getController()->forward('error', 'plexError');
        exit;
        
    }

    public function setURL($url){
        $this->url = $url;
    }

    public function executeRequest() {

        $timer = sfTimerManager::getTimer('PlexRequest');

        $client = new SoapClient(null,array('location'=>$this->location,'uri'=>$this->uri, 'trace'=>1));
        $response = $client->__doRequest($this->xml, $this->url, 'doAuthorization', 1);

        $header = $this->getHeader($client->__getLastResponseHeaders());
        $infosUser = $this->retreiveUserInfos($this->request);
        $elapsedTime = $timer->getElapsedTime();

        //Http code 200 success, 500 failure ...
        $code = $header['code'][1];

        //If code not 200 -> redirect to error page and save in plexErrorLog
        if($code != 200){
            $this->redirectIfServerError($code, $this->request->getPostParameters(), $response);
        }

        $this->response = ($this->removeSoapEnvelop($response));

        //If cant' create SimpleXMLObject
        if (simplexml_load_string($this->response) === false){

            $infos = array();
            $infos['message'] = 'Error XML: plexResponse cannot be create a simpleXMLObject.';
            $infos['code'] = 500;
            $infos['filename'] = null;
            $infos['parameters'] = $this->request->getPostParameters();
            $infos['response'] = $this->response;

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getLogger()->alert('executeRequest function called in plexRequest');
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            exit;
            
        }

        $timer->addTime();

        return $this->response;
    }

}


