<?php

class PlexStatsDetailsHotel{ 
	
	private $values;
	
	public function __construct($q){
		
		$this->values = $q;
		//var_dump($q);
		
		//Retreive the hotel object
		$folder = $q['folder'];
		$filename = unserialize($q['filename']);
		
		$slug = $q['uri'];
		
		$slug = explode('/', $slug);
		//$slug = end($slug);
		//var_dump($slug);
		
		$filePath = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.
					$filename.DIRECTORY_SEPARATOR.'plexResponse.plex';
					
		//var_dump($filePath);
		$this->hotel = PlexParsing::retreiveHotelFromBackend($filePath, end($slug));	
		//var_dump($this->hotel);
		//exit;
		
	}
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function __toString(){
		
		return $this->hotel->displayParamsStats();
		
	}
	
	
	
}