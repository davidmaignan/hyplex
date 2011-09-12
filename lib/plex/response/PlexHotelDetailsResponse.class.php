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

        //echo $this->getFilename();

    }

    /*
     * Get the filename for this response
     * @return string the fullpath to the raw request saved
     */

    public function getFilename() {

        $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$this->filename;

        return $path.DIRECTORY_SEPARATOR.$this->hotel->id;
        //return $this->filename;
    }

    public function  analyseResponse() {

    }


    public function  parseResponse() {

        $responseData = $this->responseData;

        $timer = sfTimerManager::getTimer('ParseResponse');

        //Parse the response for - HotelDescription, AllHotelImageLinks, AllHotelFacilities

        

        $start = strpos($responseData, '<HotelDescription>');
        $end = strrpos($responseData, '</HotelDescription>');

        //If can't find tags AirInfos. xml empty or badly formatted
        if($start == -1 || $end == -1 || $star === false || $end === false)
        {


            $infos = array();
            $infos['message'] = 'Error while building xml: cannot find tags hotelDescription for '.$this->getFilename();
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            exit;
        }

        $body = trim(substr($responseData, $start +  strlen('<HotelDescription>'), $end - $start -strlen('</HotelDescription>')));

        //$body = strip_tags(html_entity_decode($body),'<p><b>');
        //echo ($body);

        $body = html_entity_decode($body);

       
        //echo $body[0];


        //$body = htmlspecialchars_decode($body);

        
        //$body = html_entity_decode($body);
        //$pattern = '#<b>[a-zA-Z ]+</b>#';
        //preg_match_all($pattern, $body, $matchesarray);


        //var_dump($matchesarray);
        //exit;
        
        $this->hotel->setFullDescription(($body));



        //Facilities
        $start = strpos($responseData, '<AllHotelFacilities>');
        $end = strrpos($responseData, '</AllHotelFacilities>');

        //If can't find tags AllHotelFacilities. xml empty or badly formatted
        if($start == -1 || $end == -1 || $star === false || $end === false)
        {
            $infos = array();
            $infos['message'] = 'Error while building xml: cannot find tags AllHotelFacilities for '.$this->getFilename();
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            exit;
        }

        $body = trim(substr($responseData, $start , $end - $start + strlen('</AllHotelFacilities>')));

        $data = '<?xml version="1.0" encoding="utf-8"?>' . $body;
        $xmlFacilities = simplexml_load_string($data);
        $this->hotel->setFullFacilities(($xmlFacilities));


        //Images
        $start = strpos($responseData, '<AllHotelImageLinks>');
        $end = strrpos($responseData, '</AllHotelImageLinks>');

        if($start == -1 || $end == -1 || $star === false || $end === false)
        {
            $infos = array();
            $infos['message'] = 'Error while building xml: cannot find tags AllHotelImageLinks for '.$this->getFilename();
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            //sfContext::getInstance()->getController()->forward('error', 'plexError');
            //exit;
        }


        //Coordinates
        $start = strpos($responseData, '<MapLatLon>');
        $end = strrpos($responseData, '</MapLatLon>');

        if($start == -1 || $end == -1 || $star === false || $end === false)
        {
            $infos = array();
            $infos['message'] = 'Error while building xml: cannot find tags MapLatLon for '.$this->getFilename();
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            //sfContext::getInstance()->getController()->forward('error', 'plexError');
            //exit;
        }

        $body = trim(substr($responseData, $start , $end - $start + strlen('</MapLatLon>')));

        //echo htmlentities($body);

        $data = '<?xml version="1.0" encoding="utf-8"?>' . $body;
        $xmlCoordinates = simplexml_load_string($data);
        $this->hotel->setCoordinates(($xmlCoordinates));

        
    }

    public function  sendResponse() {
        
    }

    public function getHotel(){
        return $this->hotel;
    }
}
?>
