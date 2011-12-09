<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexHotelDetailsResponse
 *
 * @author david
 */
class PlexHotelDetailsResponse extends PlexResponse implements PlexResponseInterface {
    //put your code here

    

    private $hotel;

    public function  __construct(HotelSimpleObj $hotel, $response, $request, $filename) {


        $this->response = $response;
        $this->filename = $filename;
        $this->hotel = $hotel;
        $this->request = $request;
        

    }

    /**
     * Get the filename for this response
     * @return string the fullpath to the response xml
     */
    public function getFilename($type = '') {

        $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.
                'hotel'.DIRECTORY_SEPARATOR.
                $this->filename;

        return $path.DIRECTORY_SEPARATOR.$this->hotel->id.'.xml';
        //return $this->filename;
    }


    
    public function  analyseResponse() {

    }

    /*
    public function checkResponseCode() {

        

        ini_set('error_reporting', E_ERROR);

        $response = file_get_contents($this->getFilename());

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


    }
    */


    public function  parseResponse() {

        $timer = sfTimerManager::getTimer('ParseResponse');

        //Parse the response for - HotelDescription, AllHotelImageLinks, AllHotelFacilities        
        $xml = simplexml_load_string($this->response); 
        
        
        
        if((array)$xml->HotelDescription){
            $data = html_entity_decode((string)$xml->HotelDescription);
            $this->hotel->setFullDescription($data);
        }else{
            $infos = array();
            $infos['code'] = 811;
            $infos['response'] = $this->response;
            $infos['message'] = 'Error hotel description: '. $this->hotel->id .' doesn\'t have any description';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = null;

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);

       }

       if((array)$xml->AllHotelFacilities){
            $data = html_entity_decode((string)$xml->HotelDescription);
            $this->hotel->setFullFacilities(($xmlFacilities));
        }else{
            $infos = array();
            $infos['code'] = 812;
            $infos['response'] = $this->response;
            $infos['message'] = 'Error hotel facilities: '. $this->hotel->id .' doesn\'t have any facilities';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = null;

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);

        }

        if((array)$xml->AllHotelImageLinks){
            //$data = html_entity_decode((string)$xml->HotelDescription);
            //$this->hotel->setFullFacilities(($xmlFacilities));
        }else{
            $infos = array();
            $infos['code'] = 813;
            $infos['response'] = $this->response;
            $infos['message'] = 'Error hotel images: '. $this->hotel->id .' doesn\'t have any images';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = null;

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);

        }
        

        if((array)$xml->GoogleMapInfo->MapLatLon){
            $this->hotel->setCoordinates($xml->GoogleMapInfo->MapLatLon);
        }else{
            $infos = array();
            $infos['code'] = 814;
            $infos['response'] = $this->response;
            $infos['message'] = 'Error hotel latLong: '. $this->hotel->id .' doesn\'t have any latLong info';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = null;

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);

        }
        
    }

    public function  sendResponse() {
        
    }

    public function getHotel(){
        return $this->hotel;
    }
}
?>
