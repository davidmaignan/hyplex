<?php

class PlexStatsDetailsFlightResult{
	
	private $values;
	private $filename;
	private $folder;
	private $type = 'flight';
	private $filterDatas;
	
	public function __construct($q){
		$this->values = $q;
		
		//var_dump($q);
		
		$this->filename = unserialize($q['filename']);
		$this->folder = $q['folder'];
		//var_dump($this->filename);
		//exit;
		
		//Get filter datas
		$filename = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.
					$this->type.DIRECTORY_SEPARATOR.$this->filename.DIRECTORY_SEPARATOR.'plexResponse.filters';
					
		
		$content = file_get_contents($filename);
		$this->filterDatas = unserialize($content);
		//var_dump($this->filterDatas);	
					
		//echo $filename;
		//exit;
		
		
	}
	
	public function __toString(){
		
		$string = $this->filterDatas['total'].' flights found ';
		$string .= 'from: '. format_currency($this->filterDatas['price']['min'], '$');
		$string .= ' - ';
		$string .= 'to: '.format_currency($this->filterDatas['price']['max'],'$');

		return $string;
		
		
		return 'PlexStatsDetailsFlightResult';
	}
	
}