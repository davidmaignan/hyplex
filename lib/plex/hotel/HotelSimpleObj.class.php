<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HotelSimpleObj
 *
 * @author david
 */
class HotelSimpleObj extends HotelGenericObj {

    private $filename;
    
    public $class = 'bg-1';

    private $arSimpleFields = array('HotelId','HotelName','HotelChain','Location','DisplayPriority',
                                	'IsOurPick','PropertyType','HotelDescription');

    private $arListFacilities = array(  'general'=>array('desk','disabled','elevator','storage','smoking'),
                                        'services'=>array('service','cleaning','breakfast','concierge','ticket','room'),
                                        'internet'=>array('wi-fi','internet'),
                                        'parking'=>array('parking'),
                                        'pets'=>array('pets','pet'));

    private $arFacilitiesList = array();

    public function __construct($data = null, $filename = null) {


        if(!is_null($data) && !is_null($filename)){

            $this->filename = $filename;

            foreach($data as $key=>$value){

                switch ($key) {

                    case (in_array($key , $this->arSimpleFields)):
                         $keyModified = $this->renameXMLTag($key);
                         $this->$keyModified = ((string)$value == '')?'00':(string)$value;
                         break;

                    case 'StarRating':
                         $keyModified = $this->renameXMLTag($key);
                         $v = (string)$value;
                         $this->$keyModified = self::renameStarRating($v);
                         break;

                    case 'BaseImageLink':
                         $keyModified = $this->renameXMLTag($key);
                         $val = (string)$value;
                         //If no value is given to pic -> replace with generic no image available
                         $this->$keyModified = ($val == '')? '/no_image_available.png': $val;
                         break;


                    case 'HotelAddress':
                         foreach($value->children() as $t=>$u){
                            $this->hotelAddress[$t] = (string)$u;
                         }
                         break;

                    case 'HotelFacilities':
                        foreach ($value as $v) {
                            $this->hotelFacilities[(string)$v->{'FacilityName'}] = (string)$v->{'FacilityAvailable'} ;
                        }
                        break;

                    case 'RoomResponses':
                        $this->arRooms = $this->createRoomArray($value);
                        $this->arRoomsType = $this->createRoomTypeArray($value);
                        break;

                        default:
                        break;

                }




            }

            $this->getMinMaxPrice();

            unset($this->arSimpleFields);
            unset($this->arListFacilities);

        }
        
        
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setLocation($location){
        $this->location = $location;
    }

    public function setChain($chain){
        $this->chain = $chain;
    }

    public function setStarRating($star){
        $this->starRating = $star;
    }

    public function setDisplayPriority($value){
        $this->displayPriority = $value;
    }

    public function getToStringHeader(){
        $string = '<thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>minPrice</th>
                            <th>maxPrice</th>
                            <th>location</th>
                            <th>Chain</th>
                        </tr>
                    </thead>
                    ';

        return $string;
    }

    public function  __toString() {

        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'I18N', 'Url', 'Asset', 'Tag'));
        

        $string =   '<tr class="'.$this->class.'">';
        $string .=  '<td>'. image_tag($this->getImageFullPath(),array('width'=>'60px')).'</td>';
        $string .=  '<td>'. $this->name . '</td><td>'.
                    HotelGenericObj::getStarRating($this->starRating). '</td><td>'.
                    format_currency($this->minPrice, sfConfig::get('app_currency')).'</td><td>'.
                    format_currency($this->maxPrice, sfConfig::get('app_currency')).'</td><td>'.
                    $this->location .'</td><td>'.
                    $this->chain.'</td></tr>';


        return $string;
    }
    
 	/**
     * Display hotel summary for statistical view
     * @return string $string
     */
    public function displayParamsStats(){
    	
    	$args = func_get_args();
    	
    	$string = '';
    	
    	//Argument rate is passed so need to display the rates infos
    	if(!empty($args)){
    		
    		$rates = $args[0];
    		
    		foreach($rates as $key=>$rate){
    			
    			$string .= $key. ': ';
    			$string .= $this->getRoomPrice($key, $rate, array('RateType','TotalPrice'));
    			
    		}
    		
    		return $string;
    		
    		echo $string;
    		exit;
    	}

    		
    	$string =  $this->name. ' &bull; ';
    	$string .= HotelGenericObj::getStarRating($this->starRating). ' &bull; ';
    	$string .= 'minPrice: '.format_currency($this->minPrice, '$'). ' &bull; ';
    	$string .= 'maxPrice: '.format_currency($this->maxPrice, '$'). ' &bull; ';
    	$string .= $this->location . ' &bull; ';
    	$string .= $this->chain.' &bull; ';
    	
    	return $string;
    	
    }
    
    public function displayParamsBookingTable($rooms){
    	
    	$string = '<tr>';
    	
    	$string .= '<td>Hotel</td>';
    	
    	$string .= '<td class="info" >Name:</td>';
    	
    	$string.= '<td style="width: 100px;">'.$this->name.'</td>';
    	
    	$string .= '<td class="info">';
    	
    	$totalRoom = count($rooms);
    	for($i=1;$i<=$totalRoom;$i++){
    		$string .= $i.'<br />';
    	}
    	$string .='</td>';
    	
    	$string .= '<td>';
    	
    	$i=0;
    	foreach($rooms as $key=>$room){
    		$string .= $this->getPrice($i).'<br />';
    		++$i;
    	}
    	
    	$string .= '</td>';
    	$string .= '<td>';
    	
    	$string .= '</td>';
    	$string .= '</tr>';
    	
    	return $string;
    	
    }
    
    /**
     * Set filename
     * @param $filename
     */

    public function setFilename($filename){
        $this->filename = $filename;
    }

    public function getFilename(){
        return $this->filename;
    }

    public function getMinMaxPrice() {

        
        //Retreive number of rooms
        $numRooms = array_keys($this->arRooms);
        sort($numRooms);
        $this->numRooms = $numRooms;

        //var_dump($numRooms);
        //var_dump($this->arRooms);

        //Retreive min and max for each rooms

        foreach ($this->arRooms as $key => $arRoom) {


            $firstKey = key($arRoom);

            //Convert SimpleXMLObject to array
            $default = (array) $arRoom[$firstKey];


            $tmp = $default['arMinMaxPrice'];

            $this->minPrice = $default['arMinMaxPrice']['min'];
            $this->maxPrice = $default['arMinMaxPrice']['max'];
            $this->minTotalPrice = $default['arMinMaxPrice']['minTotal'];
            $this->maxTotalPrice = $default['arMinMaxPrice']['maxTotal'];

            foreach ($arRoom as $value) {

                //Convert SimpleXMLObject to array
                $toArray = (array) $value;
                $tmp['min'] = min($toArray['arMinMaxPrice']['min'], $tmp['min']);
                $tmp['max'] = max($toArray['arMinMaxPrice']['max'], $tmp['max']);
                $tmp['minTotal'] = min($toArray['arMinMaxPrice']['minTotal'], $tmp['minTotal']);
                $tmp['maxTotal'] = max($toArray['arMinMaxPrice']['maxTotal'], $tmp['maxTotal']);
                $this->minPrice = min($toArray['arMinMaxPrice']['min'], $this->minPrice);
                $this->maxPrice = max($toArray['arMinMaxPrice']['max'], $this->maxPrice);
                $this->minTotalPrice = min($toArray['arMinMaxPrice']['minTotal'], $this->minTotalPrice);
                $this->maxTotalPrice = max($toArray['arMinMaxPrice']['maxTotal'], $this->maxTotalPrice);
            }

            $this->arMinMaxPrice[$key] = $tmp;
        }

    }

    public function getRoomIds() {

        $ids = array_keys($this->arRooms);
        sort($ids, SORT_STRING);
        return $ids;
        //return array_keys($this->arRooms);

        return array_keys($this->arRooms);
    }

    public function getNumberRates() {

        $numRates = 0;

        foreach ($this->arRoomsType as $value) {
            $tmp = (array) $value;
            $numRates += count($tmp['arRates']);
        }

        return $numRates;
    }

    /**
     * Funtion to keep rates selected by user when hotel is added in basket
     * @param array('room1'=>'uniqueReferenceId', room2'=> ...
     *
     */
     public function cleanRates($values){

         //var_dump($values);
         //echo "<pre>";

         foreach($this->arRoomsType as $roomType){

            $roomType->cleanRates($values);
         }

         foreach($this->arRoomsType as $key=>$roomType){

            if(!isset($roomType->arRates)){
                unset($this->arRoomsType[$key]);
            }

        }
        //var_dump($values);
        //var_dump($this->arRooms);
        //exit;

        foreach ($this->arRooms as $key=>$room) {

            foreach($room as $k=>$r){
  
                $r->cleanRates($values[$key]);

                if(!isset($r->arRates)){
                    unset($this->arRooms[$key][$k]);
                }
            }
            //echo $key;
            //print_r($room);
            //echo "<hr />";
        }

        //exit;

        foreach($this->arRooms as $key=>$value){
            if(empty($value)){
                unset($this->arRooms[$key]);
            }
        }

     }


    /*
     * Function to remove rates outside filter price range
     */
    public function filterRates($filterPrices){

        foreach($this->arRoomsType as $roomType){

            $roomType->filterRates($filterPrices);
        }

        foreach($this->arRoomsType as $key=>$roomType){
            
            if(!isset($roomType->arRates)){
                unset($this->arRoomsType[$key]);
            }

        }

        //var_dump($this->arRooms);

        //echo "<pre>";
        foreach ($this->arRooms as $key=>$room) {

            foreach($room as $k=>$r){
                //var_dump($r);
                $r->filterRates($filterPrices);

                if(!isset($r->arRates)){
                    unset($this->arRooms[$key][$k]);
                    
                }

                
            }

            //print_r($room);

            
        }

        foreach($this->arRooms as $key=>$value){
            if(empty($value)){
                unset($this->arRooms[$key]);
            }
        }
       
        
        //print_r($this->arRooms);
        //exit;

    }

    public function setFullDescription($data){
        $this->hotelFullDescription = $data;
    }

    public function getFullDescription($strip = false){
       
        return $this->hotelFullDescription;
        
    }

    public function setFullFacilities($data){
        
        foreach ($data->children() as $value) {
            array_push($this->hotelFullFacilities, trim((string)$value));
        }

        $this->arFacilitiesList = $this->hotelFullFacilities;
        sort($this->arFacilitiesList);

        $this->hotelFullFacilities = array_map('strtolower',$this->hotelFullFacilities);
        $this->hotelFullFacilities = array_unique($this->hotelFullFacilities);

        //Analysing the array
        $keys = array_keys($this->arListFacilities);
        $tmp = array();

        foreach($keys as $k){
            $tmp2 = array();
            $tmp[$k] = $tmp2;
        }

        foreach($this->arListFacilities as $key=>$value){
            foreach($value as $v){
                foreach($this->hotelFullFacilities as $k=>$facility){

                    $pattern = '#'.$v.'#';
                    if(preg_match($pattern, $facility) > 0){
                        array_push($tmp[$key],$facility);
                        unset($this->hotelFullFacilities[$k]);
                    }
                }
            }
        }

       //Add the rest to general
       foreach($this->hotelFullFacilities as $facility){
           array_push($tmp['general'], $facility);
       }

       array_multisort($tmp);
       $this->hotelFullFacilities = $tmp;
    }

    public function getFullFacilities() {
        return $this->hotelFullFacilities;
    }

    public function getFullFacilitiesListSorted(){
      return $this->arFacilitiesList;
    }


    public function setCoordinates($datas){

        foreach((array)$datas as $key=>$value){
            $this->arCoordinates[strtolower($key)] = $value;
        }

    }

    public function getImageFullPath(){

        $this->targetPath = sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.'hotels'.DIRECTORY_SEPARATOR.'baseImage'.DIRECTORY_SEPARATOR;
        $this->targetPath = DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'hotels'.DIRECTORY_SEPARATOR.'baseImage'.DIRECTORY_SEPARATOR;

        $filename = strrpos($this->baseImageLink, DIRECTORY_SEPARATOR);


        return $this->targetPath . substr($this->baseImageLink, $filename+1);
    }

    /**
     * Funtion to return the price total or per night for a specific room selected for the hotel in basket
     * @param int $key
     * @param boolean $total
     * @return float
     */
    public function getPrice($key,$total = true){

        $room = 'room'.($key+1);

        $hotelRoomObj = reset($this->arRooms[$room]);
        $rate = reset($hotelRoomObj->arRates);

        if($total){
            return (float)$rate['TotalPrice'];
        }else{
            return (float)$rate['AvgPricePerNight'];
        }

    }


    public function getTotalPrice(){

        $total = 0;

        foreach($this->numRooms as $key=>$room){
            $total += $this->getPrice($key,true);
        }

        return $total;

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

    }


    public function getInfos(){
        return $this->id .' | '.$this->name;
    }
    
    /**
     * Return all the info about a rate from a uniqueReferenceId
     * @param $roomId
     * @param $uniqueReferenceId
     * @param array containing all the fields to return
     */
    public function getRoomPrice($roomId, $uniqueReferenceId, $values = array('TotalPrice')){
    	
    	foreach($this->arRooms[$roomId] as $hotelRoom){
    		
    		foreach($hotelRoom->arRates as $rate){
    			
    			if($rate['UniqueReferenceId'] == $uniqueReferenceId){
    				
    				//var_dump($rate);
    				
    				$string = '';
    				foreach($values as $value){
    					
    					$string .= $value.': '.$rate[$value].' - ';
    					
    				}
    				
    				return $string;
    				
    				return $rate['TotalPrice'];
    				
    			}
    			
    			
    		}
    		
    		
    		
    	}
    	
    	
    }

}

