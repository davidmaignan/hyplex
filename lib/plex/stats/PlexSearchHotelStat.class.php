<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexSearchHotelStat
 *
 * @author david
 */
class PlexSearchHotelStat implements PlexSearchStatInterface {

    public $arWhere = array();
    private $arCheckinDate = array();
    private $arCheckoutDate = array();
    private $arRooms = array('numberRooms'=>array(1=>0), 'number_adults'=>array(), 'number_children'=>array());
    private $parameters;
    public $arNbrDaysBefore = array();
    public $arNbrDaysBooked = array();
    public $total = 0;

    public function  __construct() {
        
    }

    public function  parseData($datas) {
        
    	if(array_key_exists('search_hotel', $datas['parameters'])){
    		
    		if($datas['parameters']['search_hotel']['wherebox'] == ''){
    			
    			return null;
    		}
    		
    		$this->total++;
    		
    		
    		$this->parameters = $datas['parameters']['search_hotel'];
    		$this->addWhere($this->parameters['wherebox']);
    		$this->addCheckinDate($this->parameters['checkin_date']);
    		$this->addCheckoutDate($this->parameters['checkout_date']);
    		$this->parseRoomInfo($this->parameters['newRooms']);
    		//var_dump($datas['parameters']['search_hotel']['newRooms']);
    		$this->getNbrDaysBetweenSearchDateAndTravelDate($datas['date'], $this->parameters['checkin_date']);
    		$this->getNbrDaysBooked($this->parameters['checkin_date'], $this->parameters['checkout_date']);
    	}
    	
    }
    
    private function getNbrDaysBooked($date1, $date2){
    	$date1 = new DateTime($date1);
    	$date2 = new DateTime($date2);
    	$interval = $date1->diff($date2);
    	
    	$nbrDays = ($interval->format('%a'));
    	if(!array_key_exists($nbrDays, $this->arNbrDaysBooked)){
    		$this->arNbrDaysBooked[$nbrDays] = 1;
    	}else{
    		$this->arNbrDaysBooked[$nbrDays]++;
    	}
    }
    
	private function getNbrDaysBetweenSearchDateAndTravelDate($date1, $date2){
    	
    	$date1 = new DateTime($date1);
    	$date2 = new DateTime($date2);
    	$interval = $date1->diff($date2);
    	
    	$nbrDays = ($interval->format('%a'));
    	if(!array_key_exists($nbrDays, $this->arNbrDaysBefore)){
    		$this->arNbrDaysBefore[$nbrDays] = 1;
    	}else{
    		$this->arNbrDaysBefore[$nbrDays]++;
    	}
    	
    	
    }
    
    private function parseRoomInfo($rooms){
    	
    	//Number of rooms
    	$nbrRooms = count($rooms);
    	if(array_key_exists($nbrRooms, $this->arRooms['numberRooms'])){
    		$this->arRooms['numberRooms'][$nbrRooms]++;
    	}else{
    		$this->arRooms['numberRooms'][$nbrRooms] = 1;
    	}
    	
    	
    	
    	foreach($rooms as $room){
    		
    		if(array_key_exists($room['number_adults'], $this->arRooms['number_adults'])){
    			$this->arRooms['number_adults'][$room['number_adults']]++;
    		}else{
    			$this->arRooms['number_adults'][$room['number_adults']] = 1;
    		}
    		
    		if(array_key_exists($room['number_children'], $this->arRooms['number_children'])){
    			$this->arRooms['number_children'][$room['number_children']]++;
    		}else{
    			$this->arRooms['number_children'][$room['number_children']] = 1;
    		}
    		
    	}
    	
    }
    
    /**
     * Return fullName airport from a code
     * @param $code
     * @param $culture
     */
	public function getAirportFullName($code, $culture = 'en_US'){
		//echo "<pre>";
		//echo print_r($this->arAirports[$code]);
		//exit;
		
		$string = $code;
		if($this->arAirport[$code][$culture]['name']){
        	$string = $this->arAirport[$code][$culture]['name']. '<br />';
		}
        $string .= '<span class="small blue1 bold"> ('.$this->arAirport[$code][$culture]['city_name'];
        if($this->arAirport[$code]['state'] != ''){
            $string .= ' ['.$this->arAirport[$code]['state'] .']';
        }
        $string .=  ' - '.$this->arAirport[$code][$culture]['country'].')</span>';
        return $string;
		
	}
    
    /**
     * Add CheckcinDate
     * @param $value
     */
    public function addCheckinDate($value){
    if(array_key_exists($value, $this->arCheckinDate) && $value != ''){
            $this->arCheckinDate[$value]++;
        }else{
            $this->arCheckinDate[$value] = 1;
        }
    }
    
	/**
     * Add CheckoutDate
     * @param $value
     */
    public function addCheckoutDate($value){
    if(array_key_exists($value, $this->arCheckoutDate) && $value != ''){
            $this->arCheckoutDate[$value]++;
        }else{
            $this->arCheckoutDate[$value] = 1;
        }
    }
	
    /**
     * Add where value
     * @param $value
     */
    public function addWhere($value){
    	
    	$pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $value, $matchesarray);
        
        if(empty($matchesarray[0])){
        	return null;
        }

        $value = substr($matchesarray[0][0], 1, -1);
    	

        if(array_key_exists($value, $this->arWhere) && $value != ''){

            $this->arWhere[$value]++;

        }else{
            $this->arWhere[$value] = 1;
        }

    }
    
    
    public function getArPassengersPieValues($type = 'adults'){
    	
    	if($type == 'adults'){
    		return $this->arRooms['number_adults'];
    	}else{
    		return $this->arRooms['number_children'];
    	}
    	
    	exit;
    	
    }
    
    /**
     * Retreive list of airport infos from list of codes
     */
	public function getAirportNames(){
		
		//Sort arrays
		arsort($this->arNbrDaysBooked);
		arsort($this->arNbrDaysBefore);
		
		$codes = $this->getCodes();
		if(empty($codes)){
			return null;
		}
		
		$this->arAirport = Doctrine::getTable('City')->getListAirportByCode($codes);
		
	}
	
    
    public function getCodes(){
    	return array_keys($this->arWhere);
    }
}

