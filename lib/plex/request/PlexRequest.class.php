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
    private   $request;
    protected $infosUser = array();
    public    $return;
    public    $paramFactory;
    public    $dispatcher;

    public function  __construct($type, $request, $paramFactory) {

        $this->type = $type;
        $this->request = $request;
        $this->paramFactory = $paramFactory;

        ini_set('error_reporting', E_ERROR);

        //check if a sessionTokenId (sTId) already exists
        $user = sfContext::getInstance()->getUser();
        $this->sTId = $user->getAttribute('sTId');

        //For debugging purpose only
        //$user->setAttribute('sTId', null);
    
        if($this->sTId === null){

            $timer = sfTimerManager::getTimer('RequestInitPlex');

            //sfContext::getInstance()->getLogger()->alert('Generate a sessionTokenId');
            //Retreive the parameters to login
            $this->defineParams();

            //build the xml
            $this->xml = $this->buildXML();

            $client = new nusoap_client($this->url, false);
            $client->persistentConnection = true;
            $client->soap_defencoding = 'utf-8';
            $client->send($this->xml);

            $response = $client->response;

            $timer->addTime();
            $elapsedTime = $timer->getElapsedTime();

            //Functions to retreive infos to save in db
            $header = $this->getHeader($response);
            $infosUser = $this->retreiveUserInfos($request);

            $code = $header['code'][1];
            
            //Query to save response in RequestInitPlex table
            $saveResponse = new RequestInitPlex();
            $saveResponse->setDate(date('Y-m-d H:i:s'));
            $saveResponse->setUserCulture($infosUser['culture']);
            $saveResponse->setUserIp($infosUser['ip']);
            $saveResponse->setUserAgent($infosUser['userAgent']);
            $saveResponse->setUserFolder($infosUser['folder']);
            $saveResponse->setElapsedTime($elapsedTime);
            $saveResponse->setHeader(serialize($header));
            $saveResponse->setResponseCode($code);
            $saveResponse->setResponseRaw($header['raw']);

            //Checking response code and take approprivate action
            switch ($code) {
                case 200:
                    $sTId = $this->getStId($response, $user);
                    $saveResponse->setStid($sTId);
                    $return = true;
                    break;

                case 500:
                    $return = false;
                    break;

                default:
                    break;
            }

            //Save query
            try{
                $saveResponse->save();
            }  catch(Doctrine_Exception $e){
                
            }      
       
        }else{
            $return = true;
        }

        ini_restore('error_reporting');

        $this->return = $return;
        
    }

    protected function defineParams($i = 0)
    {

        $i = sfConfig::get('plex_ipm');

        if($i == 0){
            $this->url = sfConfig::get('app_plex_url');
            $this->username = sfConfig::get('app_plex_username');
            $this->password = sfConfig::get('app_plex_password');
            $this->transactionId = sfConfig::get('app_plex_transactionId');
            $this->systemName = sfConfig::get('app_plex_systemName');
            $this->companyId = sfConfig::get('app_plex_companyId');
            $this->partnerId = sfConfig::get('app_plex_partnerId');
        }else if($i==1){
            $this->url = sfConfig::get('app_plex2_url');
            $this->username = sfConfig::get('app_plex2_username');
            $this->password = sfConfig::get('app_plex2_password');
            $this->transactionId = sfConfig::get('app_plex2_transactionId');
            $this->systemName = sfConfig::get('app_plex2_systemName');
            $this->companyId = sfConfig::get('app_plex2_companyId');
            $this->partnerId = sfConfig::get('app_plex2_partnerId');
        }else if($i==2){
            $this->url = sfConfig::get('app_plex3_url');
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

         return $string;

    }

    protected function getHeader($response) {

        //Check the header response and choose the action depending on the status of the response.
        $responseSplit = preg_split('#charset=utf-8#', $response);
        //$header = $responseSplit[0].'charset=utf-8';
        $header = preg_split('#(\r\n|\n)#', $responseSplit[0]);
        $tmp['code'] = explode(' ', $header[0]);
        $tmp['date'] = Utils::formatDateResponse($header[1]);
        $tmp['server'] = trim(substr($header[2], strpos($header[2], ' ')+1));
        $tmp['raw'] = $responseSplit[0];

        return $tmp;

    }

    protected function retreiveUserInfos($request)
    {
        $path = $request->getHttpHeader('info','path');
        $path = explode('/', $path);
        $userCulture = $path[1];

        $tmp = array();
        $tmp['ip'] = $request->getHttpHeader('addr','remote');
        $tmp['culture'] = $userCulture;
        $tmp['userAgent'] = $request->getHttpHeader('user-Agent');
        $tmp['date'] = $request->getHttpHeader('Date');
        $tmp['folder'] = $request->getCookie('hypertech_user_folder');


        return $tmp;
    }

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

}


