<?php

class PlexStatsDetailsHotelResult{ 
	
	private $values;
	
	public function __construct($q){
		
		$this->values = $q;
		$this->parameters = $q['parameters'];
		$this->type = $q['module'];
		
		//retrieve filterDatas
		$this->filename = unserialize($q['filename']);
		$this->folder = $q['folder'];
		$filename = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.
					$this->type.DIRECTORY_SEPARATOR.$this->filename.DIRECTORY_SEPARATOR.'plexResponse.filters';
					
		
		$content = file_get_contents($filename);
		$this->filterDatas = unserialize($content);
		
		//var_dump($this->filterDatas);
		
		//exit;
		
		
		
	}
	
	public function __toString(){
		
		$filterDatas = $this->filterDatas;
		
		$string = '';
		
		//Nbr of hotels
		
		$total = 0;
		foreach($filterDatas['starRating'] as $key=>$value){
			$total += $value['total'];
		}
		
		$string .= $total. ' hotels found - ';
		
		//Price
		$string .= 'from '. Utils::getPrice($filterDatas['prices']['min']). ' to '.Utils::getPrice($filterDatas['prices']['max']). ' - ';
		
		//Is our pick
		$string .= count($filterDatas['isOurPick']['list']). ' isOurPick - ';
		
		//Chain
		$string .= count($filterDatas['chain']). ' chains - ';
		
		//Location
		$string .= count($filterDatas['location']). ' locations.';
		
		
		
		
		
		
		return $string;
		
	}
	
	
	
}