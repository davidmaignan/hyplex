<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexSearchFlightStat
 *
 * @author david
 */
class PlexSearchFlightStat implements PlexSearchStatInterface {

    public $arOrigin = array();
    public $arDestination = array();
    public $arOriginDestination = array();
    public $arDepartDate = array();
    public $arDepartTime = array();
    public $arReturnTime = array();
    public $arReturnDate = array();
    public $arCabin = array();
    public $arTypes = array('return'=>0, 'oneway'=>0);
    public $arPassengers = array();
    public $arAirport = array();
    public $arNbrDays = array();

    public function __construct(){
        sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'Date','Text', 'Url', 'I18n'));
    }
	
    /**
     * (non-PHPdoc)
     * @see plex/stats/PlexSearchStatInterface::parseData()
     */
    public function  parseData($data) {
    	    	
    	if(array_key_exists('search_flight',$data['parameters'])){
    		$this->parseParameters($data['parameters']['search_flight']);
    		$this->getNbrDaysBetweenSearchDateAndTravelDate($data['date'], $data['parameters']['search_flight']['depart_date']);
    	}
		
    	return true;
    	
    }
    
    private function getNbrDaysBetweenSearchDateAndTravelDate($date1, $date2){
    	
    	$date1 = new DateTime($date1);
    	$date2 = new DateTime($date2);
    	$interval = $date1->diff($date2);
    	
    	$nbrDays = ($interval->format('%a'));
    	if(!array_key_exists($nbrDays, $this->arNbrDays)){
    		$this->arNbrDays[$nbrDays] = 1;
    	}else{
    		$this->arNbrDays[$nbrDays]++;
    	}
    	
    	
    }
	
	/**
	* Function to parse parameters
	* @param $params 
	*/
    private function parseParameters($params){
    	
    	if($params['origin'] == '' || $params['destination'] == ''){
    		return false;
    	}

        //Type of flight
        $this->addType($params['oneway']);
        $this->addOrigin($params['origin']);
        
        $this->addDestination($params['destination']);
        $this->addOriginDestination($params['origin'],$params['destination']);
        $this->addDepartDate($params['depart_date'], $params['destination']);
        $this->addReturnDate($params['return_date']);
        $this->addDepartTime($params['depart_time']);
        $this->addReturnTime($params['return_time']);
        $this->addCabin($params['cabin']);
        $this->addPassengers($params['number_adults'],$params['number_children'],$params['number_infants'] );
        //var_dump($this);
        //var_dump($params);
        //exit;
    }
	
    /**
     * Add passengers to arPassengers
     * @param $adults
     * @param $children
     * @param $infants
     */
	private function addPassengers($adults, $children, $infants){
		
		$type = $adults.'|'.$children.'|'.$infants;
		
		if(!array_key_exists($type, $this->arPassengers)){
			$this->arPassengers[$type] = 1;
		}else{
			$this->arPassengers[$type]++;
		}
		
	}
	
	/**
	 * Add cabin to arCabin
	 * @param $data
	 */
    private function addCabin($data){

        if(array_key_exists($data, $this->arCabin)){
            $this->arCabin[$data]++;
        }else{
            $this->arCabin[$data] = 1;
        }
    }
	
    /**
     * Add type of flight (return, oneway ...) to arType
     * @param unknown_type $type
     */
    private function addType($type){
        if($type == 0){
            $this->arTypes['return']++;
        }else if($type == 1){
            $this->arTypes['oneway']++;
        }
    }
    
    /**
     * Add origin|destination to arOriginDestination
     * @param $origin
     * @param $destination
     */
    private function addOriginDestination($origin, $destination){
    	
    	$pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $origin, $matchesarray);

        $origin = substr($matchesarray[0][0], 1, -1);
        
        $pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $destination, $matchesarray);

        $destination = substr($matchesarray[0][0], 1, -1);
        
        $value = $origin.'|'.$destination;
        
    	 if(array_key_exists($value, $this->arOriginDestination)){

            $this->arOriginDestination[$value]++;

        }else{
            $this->arOriginDestination[$value] = 1;
        }
    }
    
    /**
     * Get 3 letters code from the string
     * @param $data string
     */
    static public function getCode($data){
    	$pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $data, $matchesarray);

        return substr($matchesarray[0][0], 1, -1);
    }
	
    /**
     * Add origin code to arOrigin
     * @param $data
     */
    public function addOrigin($data){
		
        $pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $data, $matchesarray);

        $value = substr($matchesarray[0][0], 1, -1);

        if(array_key_exists($value, $this->arOrigin)){

            $this->arOrigin[$value]++;

        }else{
            $this->arOrigin[$value] = 1;
        }
        
    }
    
	/**
	 * Add Destination to arDestination
	 * @param unknown_type $data
	 */
     public function addDestination($data){

        $pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $data, $matchesarray);

        $value = substr($matchesarray[0][0], 1, -1);

        if(array_key_exists($value, $this->arDestination)){

            $this->arDestination[$value]++;

        }else{
            $this->arDestination[$value] = 1;
        }

    }
	
    /**
     * Add departure date ot arDepartDate
     * @param $value
     */
    public function addDepartDate($value, $destination){
    	
    	$destination = self::getCode($destination);

        if(!array_key_exists($value, $this->arDepartDate)){
            $this->arDepartDate[$value] = array();
        }
        
        if(!array_key_exists($destination, $this->arDepartDate[$value])){
        	$this->arDepartDate[$value][$destination] = 1;
        }else{
        	$this->arDepartDate[$value][$destination]++;
        }

    }
	
    /**
     * Add return date to arReturnDate
     * @param $value
     */
    public function addReturnDate($value){

        if(array_key_exists($value, $this->arReturnDate)){
            $this->arReturnDate[$value]++;
        }else{
            $this->arReturnDate[$value] = 1;
        }

    }
    
    /**
     * Add depart time to arDepartTime
     * @param $value
     */
    public function addDepartTime($value){

        if(array_key_exists($value, $this->arDepartTime)){
            $this->arDepartTime[$value]++;
        }else{
            $this->arDepartTime[$value] = 1;
        }

    }

	/**
	 * Add return time to arReturnTime
	 * @param $value
	 */
	public function addReturnTime($value){

        if(array_key_exists($value, $this->arReturnTime)){
            $this->arReturnTime[$value]++;
        }else{
            $this->arReturnTime[$value] = 1;
        }

    }
    
    public function getOrigins(){
    	return $this->arOrigin;
    }

	/**
	 * 
	 * Return list of destination searched for an origin
	 * @return array multidimentional key as origin and an array of destination 
	 * with keys as code and value as number of times destination was searched
	 */
	public function getOriginDestinationList(){
		
		//Query to retreive airport name
		
		$return = array();
		arsort($this->arOrigin);
		
		foreach($this->arOrigin as $key=>$origin){
			
			$return[$key] = array();
			
			foreach($this->arOriginDestination as $k=>$originDestination){
				
				$split = explode('|', $k);
				if($split[0] == $key){
					$return[$key][$split[1]] = $originDestination;
				}		
			}	
		}
		return $return;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see plex/stats/PlexSearchStatInterface::getCodes()
	 */
	public function getCodes(){
		$keys1 = array_keys($this->arOrigin);
		$keys2 = array_keys($this->arDestination);
		//var_dump($keys1,$keys2);
		//exit;
		return (array_merge($keys1, $keys2));
	}
    
	public function getAirportNames(){
		
		//var_dump($this);
		//exit;
		arsort($this->arDestination);
		arsort($this->arOrigin);
		arsort($this->arOriginDestination);
		krsort($this->arNbrDays);
		
		$codes = $this->getCodes();
		if(empty($codes)){
			return null;
		}
		$this->arAirport = Doctrine::getTable('City')->getListAirportByCode($codes);
		
	}
	
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
	
	public function getOriginByDestination($code){
		$string = '';
		
		//var_dump($this->arOriginDestination, $code);
		foreach($this->arOriginDestination as $key=>$value){
			
			$jeton = explode('|', $key);
			//var_dump($jeton);
			if($code == $jeton[0]){
				$string .= '<div class="top-search-origin"><div class="left">'. end($jeton).'<br />';
				$string .= $this->getAirportFullName(end($jeton)).'</div><div class="right">'.$value.'</div><div style="clear: both;"></div>';
				$string .= '</div>';
			}
			
			
		}

		
		return $string;
	}
	
	public function getDestinationByOrigin($code){
		
		$string = '';
		
		//var_dump($this->arOriginDestination, $code);
		foreach($this->arOriginDestination as $key=>$value){
			
			$jeton = explode('|', $key);
			//var_dump($jeton);
			if($code == end($jeton)){
				$string .= '<div class="top-search-origin"><div class="left">'. $jeton[0].'<br />';
				$string .= $this->getAirportFullName($jeton[0]).'</div><div class="right">'.$value.'</div><div style="clear: both;"></div>';
				$string .= '</div>';
			}
			
			
		}

		
		return $string;
		
	}
	
	/**
	 * Return values for Pie chart
	 */
	public function getArPassengersPieValues(){
		
		$return = array();
		
		foreach($this->arPassengers as $key=>$value){
			
			$passengers = explode('|', $key);
			
			$string = Utils::getAdultChildInfantString($passengers[0], $passengers[1], $passengers[2]);
			
			$return[$string] = $value;
			
			
		}
		
		ksort($return);
		
		return $return;
		
		return $this->arPassengers;
		
	}
	
	
	
	public function getGmapDatas(){
		
		//var_dump($this->arAirport);
		//exit;
		
		$return = array();
		
		foreach($this->arOriginDestination as $key=>$value){
			
			$airPorts = explode('|',$key);
			
			$origin = $airPorts[0];
			$destination = $airPorts[1];
			
			if(!array_key_exists($origin, $return)){
				
				
				
				$tmp = array(
					'latitude'=>$this->arAirport[$origin]['latitude'],
					'longitude'=>$this->arAirport[$origin]['longitude'],
					'info'=>$this->arAirport[$origin]['en_US'],
				'destination' => array(
					$destination => array(
						'latitude'=>$this->arAirport[$destination]['latitude'],
						'longitude'=>$this->arAirport[$destination]['longitude'],
						'info'=>$this->arAirport[$destination]['en_US'],
						'total'=>$value)
				));
				
				$return[$origin] = $tmp;
				
			}else{
				
				if(!array_key_exists($destination, $return[$origin]['destination'])){
					
					$tmp = array(
						'latitude'=>$this->arAirport[$destination]['latitude'],
						'longitude'=>$this->arAirport[$destination]['longitude'],
						'info'=>$this->arAirport[$destination]['en_US'],
						'total'=>$value);
					
					$return[$origin]['destination'][$destination] = $tmp;
					
					
				}else{
					
					$return[$origin]['destination'][$destination]['total'] += $value;
					
					
					
				}
				
				
				
			}
			
		}
		
		return $return;
		
		
	}
}

