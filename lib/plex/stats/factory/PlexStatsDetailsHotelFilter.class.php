<?php

class PlexStatsDetailsHotelFilter{ 
	
	private $values;
	
	public function __construct($q){
		
		$this->values = $q;
		
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
		
		
		
		//var_dump($this->filterDatas, $q);
		
	}
	
	public function __toString(){
		
		$arContainer = array();
		
		$arFiltersAr = $this->filterDatas;
		$filters = $this->parameters;
		
		//var_dump($filters);
		
		$arStarRating = $arFiltersAr['starRating'];
        $starToKeep = array_keys(array_intersect_key($arStarRating, $filters['starRating']));
		
		//var_dump($starToKeep);
		
		$arContainer['starRating'] = $starToKeep;
		
		
		//Price
		$arPrices = explode('-', $filters['average_nigthlyRate']);

        $filterMinPrice = trim($arPrices[0]);
        $filterMaxPrice = trim($arPrices[1]);
		
        if ($filterMinPrice != ((int) $arFiltersAr['prices']['min'])
                || $filterMaxPrice != ceil((float) $arFiltersAr['prices']['max'])) {
            $arContainer['price'] = array('min'=>$filterMinPrice, 'max'=>$filterMaxPrice);    	
                	
       	}
		
		//Is our pick to implement
       	
       	//Location
       	$arLocationFilter = array_keys($arFiltersAr['location']);

        $locationToKeep = array_intersect_key(array_flip($arLocationFilter), $filters['location']);
        $locationToKeep = array_flip($locationToKeep);
        
        //var_dump($locationToKeep);
        
        $arContainer['location'] = $locationToKeep;
       	
       	
       	//Chains
       	$arHotelChainFilter = array_keys($arFiltersAr['chain']);

        $hotelChainToKeep = (array_intersect_key(array_flip($arHotelChainFilter), $filters['chain']));
        $hotelChainToKeep = array_flip($hotelChainToKeep);
       	
		//var_dump($hotelChainToKeep);
		
		$arContainer['chain'] = $hotelChainToKeep;
		
		//Sort
		$sortBy = $filters['sortBy'];
		
		if($sortBy != 'our_pick_asc'){
			$arContainer['sortBy'] = $sortBy;
		}
		
		//Page
		$page = $filters['page'];
		if($page != 1){
			$arContainer['page'] = $page;
		}
		
		//var_dump($arContainer);
		
		//Create string
		
		$string = '';
		
		foreach($arContainer as $key=>$value){
			
			switch($key){
				
				case 'starRating':
					$string .= '<span class="label">Star rating</span><span class="filter-data">'.$this->arrayToString($value).'</span>';
					break;
				
				case 'price':
					$string .= '<span class="label">Price</span><span class="filter-data">'.$value['min']. ' to '. $value['max'].'</span>';
					break;
					
				case 'chain':
					$string .= '<span class="label">Chain</span><span class="filter-data">' . count($value). ' kept</span>';
					break;
					
				case 'location':
					$string .= '<span class="label">Location</span><span class="filter-data">' . count($value). ' kept</span>';
					break;
				
				case 'sortBy':
					$sorting = explode('_', $value);
					$string .= '<span class="label">sortBy</span><span class="filter-data">' . ucfirst($sorting[1]). ' '.strtoupper($sorting[2]). '</span>';
					break;
					
				case 'page':
					$string .= '<span class="label">Page</span><span class="filter-data">' . $value. '</span>';
					break;
					
				default:
					break;
				
			}
			
			
			
		}
		
		
		return $string;
		
		//exit;
		
	}
	
	protected function arrayToString($array){
		
		$return = '';
		foreach($array as $key=>$value){
			$return .= $value.', ';
		}
		
		
		return substr($return, 0, -2);
		
	}
	
}