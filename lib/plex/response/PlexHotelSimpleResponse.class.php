<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexHotelSimpleResponse
 *
 * @author david
 */
class PlexHotelSimpleResponse extends PlexResponse implements PlexResponseInterface {

    //put your code here
    public $arObjs = array();

    public function  parseResponse() {
        
        $responseData = $this->responseData;

        //print_r($responseData);
        //break;

        $timer = sfTimerManager::getTimer('ParseResponse');

        //Parse the response if Success
        $start = strpos($responseData, '<HotelInfos>');
        $end = strrpos($responseData, '</HotelInfos>');
        //break;

        //If can't find tags AirInfos. xml empty or badly formatted
        if($start == -1 || $end == -1 || $star === false || $end === false)
        {
            

            $infos = array();
            $infos['message'] = 'Error while building xml: cannot find tags HotelInfos';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            exit;
        }

        $body = trim(substr($responseData, $start, $end - $start + 13));

        $data = '<?xml version="1.0" encoding="utf-8"?>' . $body;
        $filename = $this->getFilename() . '.xml';
        file_put_contents($filename, $data);
        chmod($filename, 0777);



        //Delete the raw response.
        //unlink($this->getFilename());

        $timer->addTime();

        //Create file for google map markers
        //Parse the response if Success
        $start = strpos($responseData, '<GoogleMapInfo>');
        $end = strrpos($responseData, '</GoogleMapInfo>');

         //If can't find tags AirInfos. xml empty or badly formatted
        if($start == -1 || $end == -1 || $star === false || $end === false)
        {


            $infos = array();
            $infos['message'] = 'Error while populating markers hotels: cannot find tags GoogleMapInfo';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');
            exit;
        }

        
        $body = trim(substr($responseData, $start, $end - $start + 16));
        $data = '<?xml version="1.0" encoding="utf-8"?>' . $body;
        $xml = simplexml_load_string($data);

        //echo "<pre>";
        //print_r($xml);
        //break;

        //Loop through xml to create array with lat/long hotels and info about the map (lat/long/zoom)
        $arMarkers = array();

        foreach ($xml->{'MapLatLon'}->children() as $key => $value) {
            //echo $key.":".$value;
            $arMarkers[strtolower((string)$key)] = (string)$value;
        }

        //$tmpHotels = array();
        $arMarkers['hotels'] = array();

        foreach($xml->{'MarkerInfos'}->{'MarkerInfo'} as $value){
            $datas = (array)$value;
            //unset($datas['MarkerInfoType']);
            //var_dump($datas);

            $tmp = array();
            $tmp['name'] = $datas['MarkerName'];
            $latlong = array($datas['MarkerLatLon']);
            $latlong = (array)($latlong[0]);
            $tmp['latitude'] = $latlong['Latitude'];
            $tmp['longitude'] = $latlong['Longitude'];
            $tmp['info'] = $datas['MarkerWindowInfo'];
            $tmp['num'] = $datas['MarkerIconLink'];
            $arMarkers['hotels'][$datas['MarkerId']] = $tmp;
            
        }

        //var_dump($arMarkers);
        
        $filename = $this->getFilename() . '.markers';
        file_put_contents($filename, serialize($arMarkers));
        chmod($filename, 0777);
        //break;

    }

    public function  analyseResponse() {

        $timer = sfTimerManager::getTimer('AnalyseResponse');

        //Create the file to save search parameters and the list of serialize flightReturnObjects.
        $file = $this->getFilename() . '.xml';
        $content = file_get_contents($file);

        //Retreive the xml file from the plex request
        $xml = simplexml_load_file($file);

        if (!$xml) {
            $infos = array();
            $infos['message'] = 'Error while building xml';
            $infos['filename'] = $this->getFilename();
            $infos['plexResponse'] = file_get_contents($this->getFilename());
            $infos['parameters'] = $this->request->getPostParameters();

            $event = new sfEvent($this, 'plex.responsexml_error', array('infos' => $infos));
            sfContext::getInstance()->getEventDispatcher()->notify($event);
            sfContext::getInstance()->getController()->forward('error', 'plexError');

        }

        

        $arSimpleFields = array('HotelId','HotelName','HotelChain','Location','DisplayPriority',
                                'IsOurPick','PropertyType','HotelDescription');

        $arArrayFields = array('HotelAddress');


        //Retreive array with lat/long
        $filename = $this->getFilename() . '.markers';
        $fileContent = file_get_contents($filename);   
        $arMarkers = unserialize($fileContent);
        //var_dump($arMarkers);
        //break;
       

        //Loop through the xml for each flight
        foreach ($xml->children() as $value) {

            $hotelSimple = new HotelSimpleObj();
            $hotelSimple->setFilename($this->getFilename());

            foreach ($value as $key => $value) {

                switch ($key) {

                    case (in_array($key , $arSimpleFields)):
                         $keyModified = $this->renameXMLTag($key);
                         $hotelSimple->$keyModified = ((string)$value == '')?'independant':(string)$value;
                         break;

                    case 'StarRating':
                         $keyModified = $this->renameXMLTag($key);
                         $v = (string)$value;
                         $hotelSimple->$keyModified = self::renameStarRating($v);
                         break;
           

                    case 'BaseImageLink':
                         $keyModified = $this->renameXMLTag($key);
                         $val = (string)$value;
                         //If no value is given to pic -> replace with generic no image available
                         $hotelSimple->$keyModified = ($val == '')? '/no_image_available.png': $val;

                    case 'HotelAddress':

                         foreach($value->children() as $t=>$u){
                            $hotelSimple->hotelAddress[$t] = (string)$u;
                         }

                         break;

                    case 'HotelFacilities':

                        foreach ($value as $v) {
                            $hotelSimple->hotelFacilities[(string)$v->{'FacilityName'}] = (string)$v->{'FacilityAvailable'} ;
                        }
                        break;

                    case 'RoomResponses':
                        $hotelSimple->arRooms = $this->createRoomArray($value);
                        $hotelSimple->arRoomsType = $this->createRoomTypeArray($value);

                        break;

                    default:

                        break;
                }

            }

            //Add latitude and longitude
            $hotelSimple->latitude = $arMarkers['hotels'][$hotelSimple->id]['latitude'];
            $hotelSimple->longitude = $arMarkers['hotels'][$hotelSimple->id]['longitude'];

            //Create array with min/max price
            $hotelSimple->getMinMaxPrice();


            array_push($this->arObjs, $hotelSimple);

        }
        

        // Save the HotelSimpleObjects in plex file
        $handle = fopen($this->getFilename() . '.plex', 'wb');
        foreach($this->arObjs as $hotelSimple){
            //$hotelSimple->setAirportInfo($listAirports);
            fwrite($handle, serialize($hotelSimple) . "\r\n --- " . "\r\n");
        }
        fclose($handle);
        chmod($this->getFilename() . '.plex', 0777);

         //Create and/or add info request / might have to modify it to save some extra info (min price, max price, airlines ...) -> to define by tomi
        $file = sfConfig::get('sf_user_folder') . '/request';
        $handle = fopen($file, 'ab');
        //fwrite($handle, date('Y-m-d H:i:s') . '|' . $this->filename . '|' . $this->type . '|' . serialize($this->request->getPostParameters()) . "\r\n");
        fwrite($handle, "\r\n". date('Y-m-d H:i:s') . '|' . $this->filename . '|' . $this->type . '|' . serialize($this->paramFactory));
        fclose($handle);
        chmod($file, 0777);

        //Delete the xml file
        //unlink($this->getFilename().'.xml');
        //Retreive the previous searches and add them to user object attribute prevSearches.
        //Utils::retreivePrevSearch(sfContext::getInstance()->getUser());

        $datas = array();
        $datas['type'] = $this->type;
        $datas['infosUser'] = $this->retreiveUserInfos($this->request);
        $datas['header'] = $this->getHeader();
        $datas['code']= $this->responseCode;
        $datas['userFolder'] = sfConfig::get('sf_user_folder');
        $datas['filename'] = $this->filename;
        $datas['params'] = $this->paramFactory;

        //Save info in db
        $event = new sfEvent($this, 'plex.response_success', array('datas' => $datas));
        sfContext::getInstance()->getEventDispatcher()->notify($event);

        //var_dump($this->arObjs);
        //break;
        //echo "<pre>";
        //print_r($this->arObjs[0]);

        //break;

        $arStars = array();
        $arChains = array();
        $arLocations = array();
        $arIsOurPicks = array('list'=>array(),'min'=>array('price' =>0, 'list'=>array()),'max'=>array('price'=>0, 'list'=>array()));
        $arPrices = array('min'=>0,'max'=>0);

        foreach ($this->arObjs as $value) {

            //Star rating
            if(!array_key_exists($value->starRating, $arStars)){

                $min = array('price'=>$value->minPrice,'list'=>array($value->id=>Utils::slugify($value->name)));
                $max = array('price'=>$value->maxPrice,'list'=>array($value->id=>Utils::slugify($value->name)));

                $arStars[(string)$value->starRating] = array('total'=>1, 'min'=>$min,'max'=>$max);
                
            }else{
                
                $arStars[(string)$value->starRating]['total'] += 1;

                if($arStars[(string)$value->starRating]['min']['price'] > $value->minPrice){
                    $arStars[(string)$value->starRating]['min']['price'] = $value->minPrice;
                    $arStars[(string)$value->starRating]['min']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arStars[(string)$value->starRating]['min']['price'] == $value->minPrice){
                    $arStars[(string)$value->starRating]['min']['list'][$value->id] = Utils::slugify($value->name);
                }

                if($arStars[(string)$value->starRating]['max']['price'] < $value->maxPrice){
                    $arStars[(string)$value->starRating]['max']['price'] = $value->maxPrice;
                    $arStars[(string)$value->starRating]['max']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arStars[(string)$value->starRating]['max']['price'] == $value->maxPrice){
                    $arStars[(string)$value->starRating]['max']['list'][$value->id] = Utils::slugify($value->name);
                }

                
            }

            

            
            //Hotel chain
            $hotelChain = self::replaceSpaceWithUnderScore($value->chain);

            if(!array_key_exists($hotelChain, $arChains)){

                $min = array('price'=>$value->minPrice,'list'=>array($value->id=>Utils::slugify($value->name)));
                $max = array('price'=>$value->maxPrice,'list'=>array($value->id=>Utils::slugify($value->name)));
           
                $tmp = array('list'=>array($value->id), 'min'=>$min, 'max'=>$max);
                $arChains[$hotelChain] = $tmp;

            }else{

                array_push($arChains[$hotelChain]['list'], $value->id);

                if($arChains[$hotelChain]['min']['price'] > $value->minPrice){
                    $arChains[$hotelChain]['min']['price'] = $value->minPrice;
                    $arChains[$hotelChain]['min']['list'] = array($value->id=>  Utils::slugify($value->name));
                } else if($arChains[$hotelChain]['min']['price'] == $value->minPrice){
                    $arChains[$hotelChain]['min']['list'][$value->id] = Utils::slugify($value->name);
                }

                if($arChains[$hotelChain]['max']['price'] < $value->maxPrice){
                    $arChains[$hotelChain]['max']['price'] = $value->maxPrice;
                    $arChains[$hotelChain]['max']['list'] = array($value->id=>  Utils::slugify($value->name));
                }if($arChains[$hotelChain]['max']['price'] == $value->maxPrice){
                    $arChains[$hotelChain]['max']['list'][$value->id] = Utils::slugify($value->name);
                }
            }

            //Location
            $hotelLocation = self::replaceSpaceWithUnderScore($value->location);
            if(!array_key_exists($hotelLocation, $arLocations) && $value->location != ''){

                $min = array('price'=>$value->minPrice,'list'=>array($value->id=>Utils::slugify($value->name)));
                $max = array('price'=>$value->maxPrice,'list'=>array($value->id=>Utils::slugify($value->name)));
                $tmp = array('list'=>array($value->id), 'min'=>$min, 'max'=>$max);
                $arLocations[$hotelLocation] = $tmp;
                
            }else{
                array_push($arLocations[$hotelLocation]['list'], $value->id);
                if($arLocations[$hotelLocation]['min']['price'] > $value->minPrice){
                    $arLocations[$hotelLocation]['min']['price'] = $value->minPrice;
                    $arLocations[$hotelLocation]['min']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arLocations[$hotelLocation]['min']['price'] == $value->minPrice){
                    $arLocations[$hotelLocation]['min']['list'][$value->id] = Utils::slugify($value->name);
                }

                if($arLocations[$hotelLocation]['max']['price'] < $value->maxPrice){
                    $arLocations[$hotelLocation]['max']['price'] = $value->maxPrice;
                    $arLocations[$hotelLocation]['max']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arLocations[$hotelLocation]['max']['price'] == $value->maxPrice){
                    $arLocations[$hotelLocation]['max']['list'][$value->id] = Utils::slugify($value->name);
                }
            }

            //IsOurPick
            if($value->isOurPick == 'Y'){

                $arIsOurPicks['list'][$value->id] = Utils::slugify($value->name);
                
                if($arIsOurPicks['min']['price'] == 0){
                    $arIsOurPicks['min']['price'] = $value->minPrice;
                    $arIsOurPicks['min']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arIsOurPicks['min']['price'] > $value->minPrice){
                    $arIsOurPicks['min']['price'] = $value->minPrice;
                    $arIsOurPicks['min']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arIsOurPicks['min']['price'] == $value->minPrice){
                    $arIsOurPicks['min']['list'][$value->id] = Utils::slugify($value->name);

                }

                $arIsOurPicks['list'][$value->id] = Utils::slugify($value->name);

                if($arIsOurPicks['max']['price'] == 0){
                    $arIsOurPicks['max']['price'] = $value->maxPrice;
                    $arIsOurPicks['max']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arIsOurPicks['max']['price'] < $value->maxPrice){
                    $arIsOurPicks['max']['price'] = $value->maxPrice;
                    $arIsOurPicks['max']['list'] = array($value->id=>  Utils::slugify($value->name));
                }else if($arIsOurPicks['max']['price'] == $value->maxPrice){
                    $arIsOurPicks['max']['list'][$value->id] = Utils::slugify($value->name);

                }

            }

            //Min and max price for slider
            if($arPrices['min'] == 0){
                $arPrices['min'] = $value->minPrice;
                $arPrices['max'] = $value->maxPrice;
            }else{
                $arPrices['min'] = min($arPrices['min'],$value->minPrice);
                $arPrices['max'] = max($arPrices['max'],$value->maxPrice);
            }

        }

        ksort($arStars);
        ksort($arChains);
        ksort($arLocations);

        //Create .filters file (location -> show cheapest, star rating -> show cheapest,
        //price (min, max), isOurPick (cheapestL), amenities, hotelChain (cheapest))
        $arFilters = array();
        $arFilters['starRating'] = $arStars;
        $arFilters['chain'] = $arChains;
        $arFilters['location'] = $arLocations;
        $arFilters['isOurPick'] = $arIsOurPicks;
        $arFilters['prices'] = $arPrices;
        
        //Save filters in file
        file_put_contents($this->getFilename().'.filters', serialize($arFilters));
        chmod($this->getFilename().'.filters', 0777);
        
    }

    protected function createRoomArray($datas){

        $tmp = array();

        //Create array room with keys => UniqueRoomRequestId (e.g. room1, room2 ...)
        foreach($datas->children() as $key=>$value){
            $tmp[strtolower((string)$value->{'UniqueRoomRequestId'})] = $this->createHotelRoomObj($value->{'RoomTypeInfos'});
        }

        return $tmp;

    }

    protected function createHotelRoomObj($data){

        $tmp = array();

        foreach ($data->{'RoomTypeInfo'} as $key => $value) {
                //var_dump($value);
                $hotelRoomObj = new HotelRoomObj($value);
                array_push($tmp, $hotelRoomObj);
                //var_dump($hotelRoomObj);
        }

        return $tmp;
        
    }

    /*
     * Create array('roomType'=>array('RoomDescription'=>string,'rateType'=>array(
     *
     */
    protected function createRoomTypeArray($datas){

        $tmp = array();
        //echo "<pre>";
        //print_r($datas);
        //break;

        //Loop through each room
        foreach($datas->children() as $key=>$room){

            //Add every roomType in array -> add every rate and check if it's for room1, room 2 or both
            foreach($room->{'RoomTypeInfos'}->children() as $roomType){

                $roomTypeValue = (string)$roomType->{'RoomType'};
                $roomNumber = Utils::lcfirst((string)$room->{'UniqueRoomRequestId'});

                //Add new room types
                if(!array_key_exists($roomTypeValue, $tmp)){
                    
                    $tmp[$roomTypeValue] = $this->createRoomTypeObj($roomType, $roomNumber);
                    
                }else{
                    
                    $tmp[$roomTypeValue]->addRoom($roomType, $roomNumber);

                }

            }
            
        }

        return $tmp;
        //break;
    }

    protected function createRoomTypeObj($data, $roomNumber){

        $newRoomType = new RoomTypeObj($data, $roomNumber);
        return $newRoomType;
        
        //echo "<pre>";
        //print_r($newRoomType);
        //break;
    }

    protected function renameXMLTag($name){

        if(strpos($name, 'Hotel')>-1){
            $name = substr($name , 5);
        }

        //$name = str_replace('.', '_', $name);

        return Utils::lcfirst($name);
    }

    public static function renameStarRating($text){
        $text = preg_replace('#(stars)#i', '', $text);
        $text = str_replace('.', '_', $text);
        return (string)$text;
    }

    public static function replaceSpaceWithUnderScore($text){
        $text = str_replace(' ', '_', $text);
        if(empty ($text)){
            $text = 'n-a';
        }
        return $text;

    }



    public function  sendResponse() {
        
    }
}

