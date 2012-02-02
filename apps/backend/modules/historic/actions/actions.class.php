<?php

require_once dirname(__FILE__) . '/../lib/historicGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/historicGeneratorHelper.class.php';

/**
 * historic actions.
 *
 * @package    hyplexdemo
 * @subpackage historic
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class historicActions extends autoHistoricActions {
	
	
	public function executeTemplate(sfWebRequest $request){
		
	}
	
    public function executeMoveToDB(sfWebRequest $request) {
        //$this->redirect('index');
        //PlexStats::saveInDB();
        //$this->redirect('index');
    }
    
    public function executeUserSessions(sfWebRequest $request){
    	$folder = $request->getParameter('folder');
    	$this->sessions = Doctrine::getTable('historic')->getUserSessions($folder);
    }
    
    public function executeMapSearches(sfWebRequest $request){
    	
    	$searches = Doctrine::getTable('historic')->getSearchesForMap(array('flight','hotel'));
    	
    	$this->searches = json_encode($searches);
    }
    
    public function executeTopSearches(sfWebRequest $request){
    	
    	//$date1 = new DateTime('2011-01-16');
    	//$date2 = $date1->modify('+1 day');
    	
    	//$this->from = $date1;
    	//$this->to = $date2;
    	
    	$from = $request->getParameter('from', date('Y-m-d'));
    	$to = $request->getParameter('to', date('Y-m-d'));
    	
    	$this->topSearches = Doctrine::getTable('historic')->getSearches(array('flight','hotel'));
    	
    	$flight = $this->topSearches['flight'];
    	$hotel = $this->topSearches['hotel'];
    	//var_dump($flight->getArPassengersPieValues());
    	//exit;
    	
    	 //Passengers
        $flightPassengers['values'] =  $flight->getArPassengersPieValues();//Doctrine::getTable('Historic')->getDailyStatsLanguage($todayFormat);
        $flightPassengers['cols'] = array('passengers' => 'string', 'clicks' => 'number');
        $flightPassengers['title'] = array('en_US' => 'Flight passengers', 'fr_FR' => 'Passagers avions', 'zh_CN' => 'Flight Passengers');
        
        $hotelPassengers['values'] = $hotel->getArPassengersPieValues();
        $hotelPassengers['cols'] = array('passengers'=>'string','clicks'=>'number');
        $hotelPassengers['title'] = array('en_US' => 'Number adults / room', 'fr_FR' => 'Nombre adults par chambre', 'zh_CN' => 'Number adults / room');
        
        $hotelChildren['values'] = $hotel->getArPassengersPieValues('children');
        $hotelChildren['cols'] = array('passengers'=>'string','clicks'=>'number');
        $hotelChildren['title'] = array('en_US' => 'Number children / room', 'fr_FR' => 'Nombre enfants par chambre', 'zh_CN' => 'Number children / room');
        
        $searchDates['values'] = Doctrine::getTable('historic')->getSearchesGroupByMonth(array('flight','hotel'));
        $searchDates['cols'] = array('date'=>'string','flight'=>'number','hotel'=>'number');
        $searchDates['title'] = array('en_US'=>'Departure dates','fr_FR'=>'Dates de depart','zh_CN'=>'Departure dates');
        $this->searchDates = $searchDates;
        
        //var_dump($searchDates);
        
        //Browser
        $browserQuery = Doctrine::getTable('Historic')->getDailyStatsBrowser();
        $browser['values'] = $browserQuery;
        
        //var_dump($browserQuery);
        //exit;
        
        $browser['title'] = array('en_US' => 'Browser / OS', 'fr_FR' => 'Navigateur / OS ', 'zh_CN' => 'Browser / OS');
        $browser['cols'] = array('OS'=>'string','Chrome'=>'number','Firefox'=>'number',
                                'MSIE'=>'number','Opera'=>'number','Safari'=>'number');
        $this->statsBrowser = ($browser);
        
        //var_dump($browser);
        
        //exit;
	
        $this->flightPassengers = $flightPassengers;
        $this->hotelPassengers = $hotelPassengers;
        $this->hotelChildren = $hotelChildren;
        //var_dump($flightPassengers);
    	
    }
    
    public function executeDailyUserDetailed(sfWebRequest $request){
    	$session_id = trim($request->getParameter('session_id'));    	
    	$this->historics = Doctrine::getTable('historic')->getUserSessionAnalyzed($session_id);
    }
    
    public function executeDailyUser(sfWebRequest $request){
    	$today = new DateTime();
    	//$today->modify('-1 day');
        $todayFormat = $today->format('Y-m-d');
    	$this->stats = Doctrine::getTable('Historic')->getDailyStatsPerUser($todayFormat);
    }
    
    public function executeDaily(sfWebRequest $request){
    	
    	 //Create arrays
        $today = new DateTime();
        //$today->modify( '-1 day' );
        
        $todayFormat = $today->format('Y-m-d');
        
    	
    	//Hourly stats
    	$this->statsHourly = Doctrine::getTable('Historic')->getDailyStatsPerHour($todayFormat);
        $statsHourly['cols'] = array('hour' => 'string', 'clicks' => 'number');
        $statsHourly['values'] = $this->statsHourly;
        $statsHourly['title'] = array('en_US' => 'Hourly traffic', 'fr_FR' => 'Traffic / heure', 'zh_CN' => 'Hourly clicks');
        $this->statsHourly = ($statsHourly);
    	
        //Language
        $languages['values'] = Doctrine::getTable('Historic')->getDailyStatsLanguage($todayFormat);
        unset($languages['values']['']);
        $languages['cols'] = array('language' => 'string', 'clicks' => 'number');
        $languages['title'] = array('en_US' => 'Language', 'fr_FR' => 'Langues', 'zh_CN' => 'Language');

        $this->languages = ($languages);
        
         //OS
        $this->statsOS = Doctrine::getTable('Historic')->getDailyOSStats($todayFormat);
        $statsOS['cols'] = array('os' => 'string', 'clicks' => 'number');
        $statsOS['values'] = $this->statsOS;
        $statsOS['title'] = array('en_US' => 'Operating system', 'fr_FR' => 'Systeme ', 'zh_CN' => 'Operating system');

        $this->statsOS = ($statsOS);
        
        //Browser
        $browserQuery = Doctrine::getTable('Historic')->getDailyStatsBrowser($todayFormat);
        $browser['values'] = $browserQuery;
        $browser['title'] = array('en_US' => 'Browser / OS', 'fr_FR' => 'Navigateur / OS ', 'zh_CN' => 'Browser / OS');
        $browser['cols'] = array('OS'=>'string','Chrome'=>'number','Firefox'=>'number',
                                'MSIE'=>'number','Opera'=>'number','Safari'=>'number');
        $this->statsBrowser = ($browser);
        
        //Geolocation
        $geoLocationQuery = Doctrine::getTable('Historic')->getDailyGeoLocation($todayFormat);
        $geoLocation['values'] = $geoLocationQuery;
        $geoLocation['title'] = array('en_US' => 'User location', 'fr_FR' => 'Location ', 'zh_CN' => 'User location');
        $geoLocation['cols'] = array('Country' => 'string', 'Popularity' => 'number');
        $this->geoLocation = $geoLocation;
    	
       
        
        $this->stats = Doctrine::getTable('Historic')->getDailyStatsPerUser($todayFormat);
        

        $statsSummary = array();
        $statsSummary['page_visitors'] = 0;
        $statsSummary['time_per_visitor'] = 0;
        $statsSummary['number_searches'] = 0;
        
        //Time per page
        foreach($this->stats as &$stat){
            $statsSummary['page_visitors'] += $stat['total'];
            $date1 = new DateTime($stat['start']);
            $date2 = new DateTime($stat['end']);
            $interval = $date1->diff($date2);
			$stat['time spent'] = Utils::getMinutesSeconds(Utils::getDateIntervalValue($interval));
            $statsSummary['time_per_visitor'] += Utils::getDateIntervalValue($interval);           
            
        }
        $statsSummary['number_searches'] = count($this->searches);
        $statsSummary['page_visitors'] = (count($this->stats) != 0)? ceil($statsSummary['page_visitors']/count($this->stats)) : 0;
        $statsSummary['time_per_visitor'] = (count($this->stats) != 0)? $statsSummary['time_per_visitor']/count($this->stats) :0;       
        $this->statsSummary = $statsSummary;
    }

    public function executeDaily2(sfWebRequest $request) {
        
        $today = new DateTime();
        $todayFormat = $today->format('Y-m-d');
        
        $this->stats = Doctrine::getTable('Historic')->getDailyStatsPerUser($todayFormat);
        $this->searches = Doctrine::getTable('Historic')->getSearches(array('flight','hotel'));
        $this->bookings = Doctrine::getTable('Booking')->getDailyBookings($todayFormat);
        
        
		$this->bookingsSpend = array();
		$total  = 0;
        foreach($this->bookings as $booking){
			$total += $booking['object']->getTotal();
		}	
		$this->bookingsSpend['total'] = $total;
		if(count($this->bookings)){
			$this->bookingsSpend['avg_booking'] = $total/count($this->bookings);
		}else{
			$this->bookingsSpend['avg_booking'] = 0;
		}
		
        //Summary
        $statsSummary = array();
        $statsSummary['page_visitors'] = 0;
        $statsSummary['time_per_visitor'] = 0;
        $statsSummary['number_searches'] = 0;
        //Time per page
        foreach($this->stats as &$stat){
            $statsSummary['page_visitors'] += $stat['total'];
            $date1 = new DateTime($stat['start']);
            $date2 = new DateTime($stat['end']);
            $interval = $date1->diff($date2);
			$stat['time spent'] = Utils::getMinutesSeconds(Utils::getDateIntervalValue($interval));
            $statsSummary['time_per_visitor'] += Utils::getDateIntervalValue($interval);           
            
        }
        $statsSummary['number_searches'] = count($this->searches);
        $statsSummary['page_visitors'] = ceil($statsSummary['page_visitors']/count($this->stats));
        $statsSummary['time_per_visitor'] = $statsSummary['time_per_visitor']/count($this->stats);
        
        
        //$statsSummary['number_search'] /= 2;
        
        $this->statsSummary = $statsSummary;
        
        $this->statsHourly = Doctrine::getTable('Historic')->getDailyStatsPerHour();

        $statsHourly['cols'] = array('hour' => 'string', 'clicks' => 'number');
        $statsHourly['values'] = $this->statsHourly;
        $statsHourly['title'] = array('en_US' => 'Hourly traffic', 'fr_FR' => 'Traffic / heure', 'zh_CN' => 'Hourly clicks');

        $this->statsHourly = ($statsHourly);

        $languages['values'] = Doctrine::getTable('Historic')->getDailyStatsLanguage();
        unset($languages['values']['']);
        $languages['cols'] = array('language' => 'string', 'clicks' => 'number');
        $languages['title'] = array('en_US' => 'Language', 'fr_FR' => 'Langues', 'zh_CN' => 'Language');

        $this->languages = ($languages);

        //OS
        $this->statsOS = Doctrine::getTable('Historic')->getDailyOSStats();
        $statsOS['cols'] = array('os' => 'string', 'clicks' => 'number');
        $statsOS['values'] = $this->statsOS;
        $statsOS['title'] = array('en_US' => 'Operating system', 'fr_FR' => 'Systeme ', 'zh_CN' => 'Operating system');

        $this->statsOS = ($statsOS);
                
        $browserQuery = Doctrine::getTable('Historic')->getDailyStatsBrowser();
        $browser['values'] = $browserQuery;
        $browser['title'] = array('en_US' => 'Browser / OS', 'fr_FR' => 'Navigateur / OS ', 'zh_CN' => 'Browser / OS');
        $browser['cols'] = array('OS'=>'string','Chrome'=>'number','Firefox'=>'number',
                                'MSIE'=>'number','Opera'=>'number','Safari'=>'number');
        $this->statsBrowser = ($browser);
        
        $geoLocationQuery = Doctrine::getTable('Historic')->getDailyGeoLocation();
        $geoLocation['values'] = $geoLocationQuery;
        $geoLocation['title'] = array('en_US' => 'User location', 'fr_FR' => 'Location ', 'zh_CN' => 'User location');
        $geoLocation['cols'] = array('Country' => 'string', 'Popularity' => 'number');
        $this->geoLocation = $geoLocation;
        //exit;
        /*
        $codes = array();
        foreach($this->searches as $data){
        	//var_dump($data->getCodes());
        	$codes = array_merge($codes, $data->getCodes());
        }
        //var_dump($codes);
        //exit;
        $this->cities = Doctrine::getTable('City')->getListAirportByCode($codes);
        
        */
        
    }

}
