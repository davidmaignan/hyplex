<?php

/**
 * HistoricTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HistoricTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object HistoricTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Historic');
    }
    
    public function getUserSessions($folder){
    	
    	$q = Doctrine::getTable('historic')
    			->createQuery('a')
    			->select('a.folder, a.ip, a.os, a.browser, a.session_id,  
                		  a.version, MIN(a.date) AS start, MAX(a.date) AS end, 
                		  count(a.id) AS total')
                ->addSelect('(SELECT count(b.id) FROM Historic b WHERE (b.module LIKE "search%" AND b.session_id = a.session_id)) as totalSearch')
    			->where('a.folder = ?', $folder)
    			->groupBy('a.session_id')
    			->orderBy('start DESC')
    			->fetchArray();
    			
    	return ($q);
    	
    	exit;
    	
    }
    
   
    /**
     * Get all request for a session
     * @param $session_id
     */
    public function getUserSessionAnalyzed($session_id){
    	
    	sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'Date','Text', 'Url'));
    	
    	$results = array();
    	
    	$q = Doctrine_Query::create()
    				->from('historic a')
    				->where('a.session_id = ?', $session_id)
    				->orderBy('a.date')
    				->fetchArray();

    				$results['infos']['ip'] = $q[0]['ip'];
    				$results['infos']['folder'] = $q[0]['folder'];
    				$results['infos']['language'] = $q[0]['language'];
    				$results['infos']['os'] = $q[0]['os'];
    				$results['infos']['browser'] = $q[0]['browser'];
    				$results['infos']['version'] = $q[0]['version'];
    				$results['infos']['language'] = $q[0]['language'];

    					
    	
    	$total = count($q);
    	
    	$startTime = new DateTime($q[0]['date']);
    	$endTime = new DateTime($q[$total-1]['date']);
    	
    	$interval = $startTime->diff($endTime);
    	
       	
    	$results['summary']['session'] = $session_id;
    	$results['summary']['start'] = $q[0]['date'];
    	$results['summary']['end'] = $q[$total-1]['date'];
    	$results['summary']['duration'] =  $interval->format('%hh %imin %ss');
    	$results['summary']['totalAction'] = count($q);
    	$results['summary']['timePerAction'] = round(Utils::getTimeIn($interval)/count($q),2).' seconds';
    	
    	$results['searches']['searches'] = 0;
    	$results['searches']['flight'] = 0;
    	$results['searches']['hotel'] = 0;
    	$results['searches']['addBasket'] = 0;
    	$results['searches']['removeBasket'] = 0;
    	$results['searches']['filter'] = 0;
    	
    	
       	foreach($q as $key=>$value){
       		
       		PlexStatsDetailsFactory::getUserActionStats($results['searches'], $value);
       		
       		$tmp = array();
       		$tmp['color'] = Utils::getModuleActionColored($value['module'], $value['action']);
       		
       		$tmp['number'] = ++$i;
       		$tmp['module'] = $value['module'];
       		$tmp['action'] = $value['action'];
       		$tmp['module'] = $value['module'];
       		$tmp['tsop'] = $value['tsop'];
       		
       		$tmp['parameters'] = PlexStatsDetailsFactory::factory($value);

       		
       		$results[] = $tmp;
       		
       	}

       return $results;

    }
    
    /**
     * Return Geolocation of the users
     * @param string $start
     * @param string $end
     */
    public function getDailyGeoLocation($start = null, $end = null){
    	
    	$culture = sfContext::getInstance()->getUser()->getCulture();
    	
    	if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
    	
    	$q = Doctrine_Query::create()
				->select('a.id, t.name as name, b.id, count(a.session_id) as total')
                ->from('historic a')
                ->leftJoin('a.Country b')
                ->leftJoin('b.Translation t')
                ->where('t.lang = ?', $culture)
                ->andWhere('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
				->groupBy('a.country_id, a.session_id')
				->orderBy('t.name')
                ->fetchArray();
                
        $return = array();
        foreach($q as $value){
        	$return[$value['name']] = (int)$value['total'];
        }        
                
        return $return;
    }
    
    /**
     * Retreive Country_id for IP's number
     */
    public function getIPsWithCountryIdNull(){
    	
    	$q = Doctrine_Query::create()
    		->select('DISTINCT (c.ip) as ip')
    		->from('Historic c')
    		->fetchArray();

    	
    	$result = array();
    	
    	foreach($q as $value){
    		
    		if(!in_array($value['ip'], $result)){
    			array_push($result,$value['ip']);
    		}
    		//echo $value['ip'];
    	}
    	
    	return $result;

    }
    
    
    /**
     * Return historic with country null
     */
    public function getByCountryIsNULL($value = NULL){
    	
    	$q = Doctrine_Query::create()
    				->from('historic a')
    				->where('a.country_id is NULL')
    				->execute();
    				//->toArray();
    				
    	return $q;
    	
    }
    
    
    /**
     * Retrieves searches group by month
     * @param unknown_type $type
     * @param unknown_type $start
     * @param unknown_type $end
     */
 	public function getSearchesGroupByMonth($type, $start = null, $end = null){
    	
 		if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
 		
 		$q = Doctrine_Query::create()
 				->from('historic a')
 				->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->andwhere('a.module LIKE ?', "%search%")
                ->fetchArray();
        
        /*
         * Need to return an array structured
         * array('month'=>array('flight'=>xx numbers, 'hotel'=>xx numbers, 'car'=> xx times, 'packages'=>xx),
         * 	     'month2'=>array('flight' .....
         */        
        
        $return = array();
                
                
        foreach($q as $value){
        	
        	//check if parameters exists
        	
        	
        	
        	if(array_key_exists('search_flight', $value['parameters'])){
        		$type = 'flight';
        		$date = new DateTime($value['parameters']['search_flight']['depart_date']);
        		$dateFormat = $date->format('m-y');
        		
        	}else if(array_key_exists('search_hotel', $value['parameters'])){
        		$type = 'hotel';
        		$date = new DateTime($value['parameters']['search_hotel']['checkin_date']);
        		$dateFormat = $date->format('m-y');
        	}
        	
        	
        	//$date = new DateTime($value['parameters']['search_flight']['depart_date']);
        	//$dateFormat = $date->format('m-y');
        	//var_dump($dateFormat);
        	
        	if(!array_key_exists($dateFormat, $return)){
        		$return[$dateFormat] = array('flight'=>0,'hotel'=>0);
        		$return[$dateFormat][$type]++;
        	}else{
        		$return[$dateFormat][$type]++;
        	}
        	
        }        
		
        ksort($return);
        
        //var_dump($return);
        //exit;
        
        return $return;
        
        //var_dump($return);
                
    }
    
    /**
     * @param $type
     * @param $start datetime
     * @param $end datetime
     */
    public function getSearchesForMap($type, $start = null, $end = null){
    	
    	if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        $q = Doctrine_Query::create()
                ->from('historic a')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->andwhere('a.module LIKE ?', "%search%")
                ->fetchArray();
        
        //Retreive datas
         //Flight / Hotel
        $flight = new PlexSearchFlightStat();
        $hotel = new PlexSearchHotelStat();
        
        if($q){
        	
        	foreach($q as $data){

	            switch ($data['module']) {
	
	                case 'searchFlight':
	                    $flight->parseData($data);
	                    break;
	
	                case 'searchHotel':
	                    $hotel->parseData($data);
	                    break;
	
	                default:
	                    break;
	            }
	
	        }
	        	
        	$flight->getAirportNames();
        	$hotel->getAirportNames();
        	
        }
        
        $arFlights = $flight->getGmapDatas();
        
        //echo "<pre>";
        //print_r($arFlights);
        
        //exit;
        
        return array('flight'=>$arFlights);
        
        return array('flight'=>
        	array('BOS'=>
        		array(
	        		'latitude'=>42.407210700000000,
	        		'longitude'=>-71.382437400000000,
	        		'desination'=>array(
        				'DXB'=> array('latitude'=>25.252778000000000, 'longitude'=>55.364444000000000,'total'=>3)
        			)
	        	)
	        )	
        );
        
        var_dump($flight);
        exit;
        
        return array('flight'=>$flight,'hotel'=>$hotel);
        
    }
    
    
    
    /**
     * Retrieve searches request: module LIKE %search%
     * @param $type
     * @param $start datetime
     * @param $end datetime
     */
    public function getSearches($type, $start = null, $end = null){
        
        if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        
        $q = Doctrine_Query::create()
                ->from('historic a')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->andwhere('a.module LIKE ?', "%search%")
                ->execute()
                ->toArray();   
                
        //exit;
                
        //Flight / Hotel
        $flight = new PlexSearchFlightStat();
        $hotel = new PlexSearchHotelStat();
        
        if($q){
        	
        	foreach($q as $data){

            switch ($data['module']) {

                case 'searchFlight':
                    $flight->parseData($data);
                    break;

                case 'searchHotel':
                    $hotel->parseData($data);
                    break;

                default:
                    break;
            }

        }
        
        	
        	$flight->getAirportNames();
        	$hotel->getAirportNames();
        	
        }
	

        
        
        
        return array('flight'=>$flight,'hotel'=>$hotel);
        

    }
    
    /**
     * Get Browser stats
     * @param type $start
     * @param DateTime $end
     * @return type 
     */
    public function getDailyStatsBrowser($start = null, $end = null){
        
        if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        
        $q = Doctrine_Query::create()
                ->from('historic a')
                ->select('count(a.id) AS total, a.browser, a.os')
                ->groupBy('a.browser, a.os')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->execute()
                ->toArray();
        
        $ar = array('os', 'browser','total');
        
        self::cleanDatas($q, $ar);
        
        $browser = array('Chrome'=>0,'Firefox'=>0,'MSIE'=>0,'Opera'=>0,'Safari'=>0);
        $OS = array('Macintosh','Linux','Windows','Iphone');
        
        $result = array();
        
        foreach ($OS as $value) {
            $result[$value] = $browser;
        } 
        
        foreach($q as $key=>$value){
            $result[$value['os']][$value['browser']] = (int)$value['total'];
        }
        
        return $result;
    }
    
    public function getDailyStatsPerUserList($start = null, $end = null){
        
        if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        $q = Doctrine_Query::create()
                ->from('historic a')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->execute()
                ->toArray();
        
        $ar = array('ip','folder','os','browser','version','start','end','total');
        
        
        
        
        self::cleanDatas($q, $ar);
        
        var_dump($q);
        
        exit;
        
    }
    
    
    /**
     * Get Operating System stats
     * @param type $start
     * @param DateTime $end
     * @return type 
     */
    public function getDailyOSStats($start = null, $end = null){
        
        if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        
        $q = Doctrine_Query::create()
                ->from('historic a')
                ->select('count(a.id) AS total, a.os')
                ->groupBy('a.os')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->execute()
                ->toArray();
        
        $ar = array('os','total');
        
        self::cleanDatas($q, $ar);
        
        $datas = array();
        
        foreach($q as $v){
            $datas[$v['os']] = (int)$v['total'];
        }
        
        return ($datas);
    }
    
    /**
     * Get Stats per User
     * @param type $start
     * @param DateTime $end
     * @return type 
     */
    public function getDailyStatsPerUser($start = null, $end = null){
        
        if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        
        
        $q = Doctrine_Query::create()
                ->select('a.folder, a.ip, a.os, a.browser, a.session_id,  
                		  a.version, MIN(a.date) AS start, MAX(a.date) AS end, 
                		  count(a.id) AS total')
                ->addSelect('(SELECT count(b.id) FROM Historic b WHERE (b.module LIKE "search%" AND b.session_id = a.session_id)) as totalSearch')
                ->from('historic a')
                ->groupBy('a.session_id, DATE_FORMAT(a.date,"%Y-%m-%d")')
                ->orderBy('total desc')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->fetchArray();
                
        //var_dump($q[0]);
        //exit;
                
        return $q;
                
        
    }
    
    
    /**
     * Get Stats per hour
     * @param type $start
     * @param DateTime $end
     * @return type 
     */
    public function getDailyStatsPerHour($start = null, $end = null){
        
        if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        
        $q = Doctrine_Query::create()
                ->from('historic a')
                ->select('DATE_FORMAT(a.date,"%H") as date, count(a.id) AS total')
                ->groupBy('DATE_FORMAT(a.date,"%Y-%m-%d %H")')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->orderBy('a.date asc')
                ->execute()
                ->toArray();
        
        $ar = array('date','total');
        self::cleanDatas($q, $ar);
        
        //Build hourly array
        $keys = range(0,24);
        $values = array_fill(0, 24, 0);
        
        foreach ($q as $value) {
            $values[(int)$value['date']] = $value['total'];
        }
        
        return ($values);   
    }
    
    
    public function getDailyStatsLanguage($start = null, $end = null){
        
        if(is_null($start)){
           $start = new DateTime();
        }else{
           $start = new DateTime($start);
        }
        
        if(is_null($end)){
            $end = new DateTime($start->format('Y-m-d H:i:s'));
            $end->modify('+1 day');
        }
        
        
        $q = Doctrine_Query::create()
                ->from('historic a')
                ->select('a.language, count(a.id) AS total')
                ->groupBy('a.language')
                ->where('a.date > ?', $start->format('Y-m-d'))
                ->andWhere('a.date < ?', $end->format('Y-m-d'))
                ->orderBy('a.date asc')
                ->execute()
                ->toArray();
        
        $ar = array('language','total');
        self::cleanDatas($q, $ar);
        
        $keys = sfConfig::get('app_languages_available');
        $final = array_fill(0, count($keys), 0);
        
        $final = array_combine($keys, $final);
        
        foreach($q as $key=>$value){
            $final[$value['language']] = (int)$value['total'];   
        }
        
        return $final;
    }
    
    
    static public function cleanDatas(&$datas, $ar){
        
        
        foreach($datas as &$data){
            
            foreach($data as $k=>$d){
                if(!in_array($k, $ar)){
                    unset($data[$k]);
                }
            }
            
        }

        
        return $datas;
    }
    
    
    
    
}