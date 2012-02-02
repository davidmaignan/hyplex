<?php

class PlexStatsDetailsSelected{ 
	
	private $values;
	private $folder;
	private $uniqueReference;
	private $type;
	private $filename;
	private $object;
	private $rooms = array();
	
	public function __construct($q){
		
		//var_dump($q);
		
		
		$this->values = $q;
		$this->uniqueReference = $q['parameters']['uniqueReferenceId'];
		$this->type = $q['module'];
		$this->filename = $q['parameters']['filename'];
		$this->folder = $q['folder'];
		
		switch($this->type){
			
			case 'hotel':
				$this->object = $this->getHotel();
				break;
			
			case 'flight':
				$this->object = $this->getFlight();
				break;
			
			default:
				$this->object = null;
				break;			
			
			
		}
	
		//Create rooms array for hotel oject
		if($this->type == 'hotel' && is_object($this->object) && !is_null($this->object)){
			
			foreach($q['parameters'] as $key=>$param){
				
				if(preg_match('#room#i', $key)){
					$this->rooms[$key] = $param;
					//$this->rooms[$key] = (float)$this->object->getRoomPrice($key, $param);
				}
			}
		}
		
	}
	
	public function __toString(){
		
		$string = '';
		
		//Pass parameter array rooms for displaying rates info instead of hotel info
		//Will do nothing for a flight
		$string .= $this->object->displayParamsStats($this->rooms);
		
		/*
		if(empty($this->rooms)){
			return $string;
		}
		
		foreach($this->rooms as $key=>$room){
			$string .=	$key.': '.Utils::getPrice($room).' - ';
		}
		*/
		
		return $string;
		
	}
	
	public function getFlight(){
		$filename = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.
					$this->type.DIRECTORY_SEPARATOR.$this->filename;
		
		return PlexParsing::retreiveFlightFromBackendPerspective($filename, $this->uniqueReference);
		
	}
	
	public function getHotel(){
		
		//slug
		$slug = $this->values['parameters']['slug'];
		
		$filePath = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.
					$this->filename.DIRECTORY_SEPARATOR.'plexResponse.plex';
		
		//var_dump($filePath);
		return PlexParsing::retreiveHotelFromBackend($filePath, $slug);	
		
	}
	
	
}