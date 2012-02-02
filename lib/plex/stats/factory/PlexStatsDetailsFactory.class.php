<?php

class PlexStatsDetailsFactory {
	
	public static $details;
	
	public static function &factory($q){
		
		//if(!is_object(self::$details)){
			
			switch(true){
				
				case($q['module'] == 'searchFlight' && $q['action'] == 'create'):
					self::$details = new PlexStatsDetailsSearch($q);
					break;
					
				case($q['module'] == 'flight' && $q['action'] == 'flightResult'):
					self::$details = new PlexStatsDetailsFlightResult($q);
					break;
					
				case($q['module'] == 'flight' && $q['action'] == 'filterFlight'):
					self::$details = new PlexStatsDetailsFlightFilter($q);
					break;
				
				case($q['module'] == 'flight' && $q['action'] == 'selected'):
					self::$details = new PlexStatsDetailsSelected($q);
					break;
					
				case($q['module'] == 'basket' && $q['action'] == 'remove'):
					self::$details = new PlexStatsDetailsRemoved($q);
					break;
					
				case($q['module'] == 'searchHotel' && $q['action'] == 'searchAgain'):
					self::$details = new PlexStatsDetailsSearch($q);
					break;
					
				case($q['module'] == 'searchHotel' && $q['action'] == 'create'):
					self::$details = new PlexStatsDetailsSearch($q);
					break;
					
				case($q['module'] == 'hotel' && $q['action'] == 'hotelResult'):
					self::$details = new PlexStatsDetailsHotelResult($q);
					break;
				
				case($q['module'] == 'hotel' && $q['action'] == 'hotelDetail'):
					self::$details = new PlexStatsDetailsHotel($q);
					break;
					
				case($q['module'] == 'hotel' && $q['action'] == 'selected'):
					self::$details = new PlexStatsDetailsSelected($q);
					break;
					
				case($q['module'] == 'hotel' && $q['action'] == 'filterHotel'):
					self::$details = new PlexStatsDetailsHotelFilter($q);
					break;
					
			    default:
			    	self::$details = null;
					
			}
			
			return self::$details;
			
		//}
		
	}
	
	
	/**
	 * Return an array with number of module/action dones
	 * @param reference $array
	 * @param array $q
	 */
 	static function getUserActionStats(&$array, $q){
    	
    	switch(true){
    		
    		case($q['module'] == 'searchFlight'):
					$array['searches']++;
					$array['flight']++;
					break;
					
    		case($q['module'] == 'searchHotel'):
    			$array['searches']++;
    			$array['hotel']++;
    			break;
    				
    		case(preg_match('#filter#i', $q['action'])>0):
    			$array['filter']++;
    			break;

    		case($q['action'] == 'selected'):
    			$array['addBasket']++;
    			break;
    				
    		case($q['module'] == 'basket' && $q['action'] == 'remove'):
    			$array['removeBasket']++;
    			break;
    				
    		default:
    			break;
					
    	}
    	
    }
	
}