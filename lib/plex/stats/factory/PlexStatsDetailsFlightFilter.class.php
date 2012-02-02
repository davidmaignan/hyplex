<?php

class PlexStatsDetailsFlightFilter{
	
	private $values;
	private $parameters;
	private $filterDatas;
	private $folder;
	private $filename;
	private $type;
	
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
		
		//ob_start();
		//var_dump($this->parameters, $this->filterDatas);
		//exit;

	}
	
	public function __toString(){
		
		$arContainer = array();
		
		$string = '';
		
		//Stops
		$stops = array_keys($this->parameters);
		$stops = array_intersect(array('stop0','stop1','stop2'), $stops);
		
		$stopsFilterDatas = $this->filterDatas['stop'];
		
		foreach($stopsFilterDatas as $key=>$stopFilter){
			$tmp = '';
			if(!in_array('stop'.$key, $stops)){
				$tmp .= $key.',';
			}
			
			$tmp = substr($tmp, 0, -1);
			
			if($tmp != ''){
				$string = '<span class="label">Stop</span><span class="filter-data">'.$tmp.'</span>';
			}
			
			$arContainer['stop'] = $string;
			
		}
		
		$string = '';
		//Airline difference
		$airLineDiff = array_diff_key($this->filterDatas['airlines'], $this->parameters);
		if(!empty($airLineDiff)){
			
			$string .= '<span class="label">Airline</span><span class="filter-data">';
			
			foreach($airLineDiff as $key=>$airline){
				
				$string .= $key .', ';
				
			}
			$string = substr($string, 0, -2);
			$string .= '</span>';
			
			$arContainer['airline'] = $string;
		}
		
		$string = '';
		
		
		
		//Flight Times
		$takeOffDepartInit = $this->filterDatas['takeoffDep'];
		$takeOffDepartFiltered = Utils::retrieveTimeFromSlider($this->parameters['takeoff_departflight']);
		//var_dump($takeOffDepartInit, $takeOffDepartFiltered);
		
		//var_dump(Utils::comparingTimes($takeOffDepartFiltered[0],$takeOffDepartInit['min']));
		//var_dump(Utils::comparingTimes($takeOffDepartInit['max'],$takeOffDepartFiltered[1]));
		
		if(!Utils::comparingTimes($takeOffDepartFiltered[0],$takeOffDepartInit['min']) ||
		   !Utils::comparingTimes($takeOffDepartInit['max'],$takeOffDepartFiltered[1])
		){
			$string .= '<span class="label">TakeOffDepart</span><span class="filter-data">'. Utils::returnStringTimeFromarray($takeOffDepartFiltered[0]).
			' - '.Utils::returnStringTimeFromarray($takeOffDepartFiltered[1]). '</span>';
			
			$arContainer['takeOffDepart'] = $string;
			
		}
		
		$string = '';
		
		$takeOffReturnInit = $this->filterDatas['takeoffRet'];
		$takeOffReturnFiltered = Utils::retrieveTimeFromSlider($this->parameters['takeoff_returnflight']);
		
		if(!Utils::comparingTimes($takeOffReturnFiltered[0],$takeOffReturnInit['min']) ||
		   !Utils::comparingTimes($takeOffReturnInit['max'],$takeOffReturnFiltered[1])
		){
			$string .= '<span class="label">TakeOffReturn</span><span class="filter-data">'. Utils::returnStringTimeFromarray($takeOffReturnFiltered[0]).
			' - '.Utils::returnStringTimeFromarray($takeOffReturnFiltered[1]). '</span>';
			$arContainer['takeOffReturn'] = $string;
		}
		
		$string = '';
		
		//Price
		$priceInit = $this->filterDatas['price'];
		$priceSlider = $this->parameters['price'];
		
		if(ceil($priceInit['max']) > (int)$priceSlider){
			$string .= '<span class="label">Price</span><span class="filter-data">'. $priceSlider. '</span>';
			$arContainer['price'] = $string;
		}
		
		$string = '';
		//Sorting
		$sorting = $this->parameters['sortBy'];
		if($sorting != 'sort_price_asc'){
			$sorting = explode('_', $sorting);
			$string .= '<span class="label">Sort</span><span class="filter-data">'.ucfirst($sorting[1]). ' '.strtoupper($sorting[2]). '</span>';
			$arContainer['sorting'] = $string;
		}
		
		$string = '';
		//Pagination
		$page = $this->parameters['page'];
		if($page != 1){
			$string .= '<span class="label">Page</span><span class="filter-data">'. $page. '</span>';
			$arContainer['page'] = $string;
		}
		
		$string = '';
		//Trip duration
		$duration = $this->parameters['tripduration'];
		
		if($duration < $this->filterDatas['duration']['max']){
			$string .= '<span class="label">Duration</span><span class="filter-data">'. $duration. '</span>';
			$arContainer['duration'] = $string;
		}
		
		
		$string = '';
		
		ksort($arContainer);
		
		foreach($arContainer as $value){
			$string .= $value;
		}
		
		return $string;
		
	}
	
	
}