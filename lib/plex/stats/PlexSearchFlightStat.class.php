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
    private $arDestination = array();
    private $arOriginDestination = array();
    private $arDepartDate = array();
    private $arDepartTime = array();
    private $arReturnTime = array();
    private $arReturnDate = array();
    private $arCabin = array();
    private $arTypes = array('return'=>0, 'oneway'=>0);
    private $arPassengers = array('adults'=>0,'children'=>0,'infants'=>0);

    public function __construct(){
        
    }
	
    /**
     * (non-PHPdoc)
     * @see plex/stats/PlexSearchStatInterface::parseData()
     */
    public function  parseData($data) {
    	
    	//var_dump($data);
    	//exit;

        switch ($data['action']) {
            case 'create':
                $this->parseParameters($data['parameters']['search_flight']);
                break;
			
            case 'searchAgain':
            	$this->parseParameters($data['parameters']['search_flight']);
                break;
            default:
                break;
        }

    }
	
	/**
	* Function to parse parameters
	* @param $params 
	*/
    private function parseParameters($params){

        //Type of flight
        $this->addType($params['oneway']);
        $this->addOrigin($params['origin']);
        $this->addDestination($params['destination']);
        $this->addOriginDestination($params['origin'],$params['destination']);
        $this->addDepartDate($params['depart_date']);
        $this->addReturnDate($params['return_date']);
        $this->addDepartTime($params['depart_time']);
        $this->addReturnTime($params['return_time']);
        $this->addCabin($params['cabin']);
        $this->addPassengers($params['number_adults'],'adults');
        $this->addPassengers($params['number_children'],'children');
        $this->addPassengers($params['number_infants'],'infants');
        //var_dump($this);
        //var_dump($params);
        //exit;
    }
	
    /**
     * Add passengers to arPassengers
     * @param $data
     * @param $type
     */
	private function addPassengers($data, $type){
		$this->arPassengers[$type] = $this->arPassengers[$type] + (int)$data;
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
    public function addDepartDate($value){

        if(array_key_exists($value, $this->arDepartDate)){
            $this->arDepartDate[$value]++;
        }else{
            $this->arDepartDate[$value] = 1;
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
    

}

