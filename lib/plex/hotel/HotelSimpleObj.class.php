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

    private $arListFacilities = array(  'general'=>array('desk','disabled','elevator','storage','smoking'),
                                        'services'=>array('service','cleaning','breakfast','concierge','ticket','room'),
                                        'internet'=>array('wi-fi','internet'),
                                        'parking'=>array('parking'),
                                        'pets'=>array('pets','pet'));

    private $arFacilitiesList = array();

    public function __construct() {
        
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

        $string =   '<tr class="'.$this->class.'">';
        $string .=  '<td>'. image_tag($this->getImageFullPath(),array('width'=>'60px')).'</td>';
        $string .=  '<td>'. $this->name . '</td><td>'.
                    HotelGenericObj::getStarRating($this->starRating). '</td><td>'.
                    format_currency($this->minPrice, sfConfig::get('app_currency')).'</td><td>'.
                    format_currency($this->maxPrice, sfConfig::get('app_currency')).'</td><td>'.
                    $this->location .'</td><td>'.
                    $this->chain.'</td></tr>';

        /*
        $string .= '<tr>';

        foreach ($this->arRoomsType as $key => $value) {

            $value = (array)$value;

            foreach($value['arRates'] as $rate){
                $string .= '<td>'.$rate['room1']['AvgPricePerNight'].' - </td>';
            }

            

        }

        $string .= '<tr>';
        */

        //echo "<pre>";
        //print_r($this->arRoomsType);

        return $string;
    }

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

}

