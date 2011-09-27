<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexFilterHotelSimple
 *
 * @author david
 */
class PlexFilterHotelSimple extends PlexFilterHotel {
    //put your code here

    
    //Variables for filterFrom
    

    public function  __construct($type, $filename, $page, $filters) {

        parent::__construct($type, $filename, $page, $filters);

        $this->filters = $filters;

        $this->nbrTotalHotels = count($this->arObjs);

        
        if (!empty($filters)) {

            $this->filterDatas($filters);
            $sortCriteria = $filters['sortBy'];
            $this->sortBy($sortCriteria);
        }else{
            $this->filteredObjs = $this->arObjs;
        }

        //$this->nbrHotels = count($this->arObjs);

        if(!is_null($page)){
            $this->paginate($page);
        }
        
    }



    private function filterDatas($filters){

        if (empty($filters)) {
            return true;
        }

        //Replace _ with space
        ob_start();
        //echo "<br /><br /><br /><br /><br /><br /><br /><br /><pre>";
        
        //var_dump($filters);

        $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$this->filename.'.filters';
        //Check filters and filename.filters
        if(file_exists($filename)){
            $content = file_get_contents($filename);
            $arFiltersAr = unserialize($content);
        }else{
            throw new Exception($this->filename.'.filters is missing', 500);
        }

        //Create array to work with and remove hotels from it.
        $objects = $this->arObjs;
        $this->filteredObjs = $this->arObjs;



        //Star rating  -------------------------------------------------------------------------------------
        //
        //If no star rating selected return empty array
        if(!array_key_exists('starRating', $filters)){
            $this->filteredObjs = array();
            $this->arFilterActivated['Star Rating'] = count($this->arObjs) ;
            return $this->filteredObjs;

        }

        //Selecting starRating.
        $arStarRating = $arFiltersAr['starRating'];
        $starToKeep = array_keys(array_intersect_key($arStarRating, $filters['starRating']));

       
        //IMPORTANT - bug regarding type casting
        // --------------------------------------------------------------
        //Change type of values in $starToKeep in for a string type like $hotel->starRating
        foreach ($starToKeep as &$value) {
            $value = (string)$value;
        }

        //Remove hotels if starRating is not defined.
        foreach ($this->filteredObjs as $key=>$hotel) {
            if(!in_array($hotel->starRating, $starToKeep)){
                unset($this->filteredObjs[$key]);
            }
        }        


        //Create yellow filter div
        if(count($this->filteredObjs) <= $this->nbrTotalHotels &&
            count($arStarRating) != count($starToKeep))
        {
            $this->arFilterActivated['Star Rating'] = count($this->filteredObjs) ;
        }

        //Update the number of hotels after previous filtering
        $this->nbrHotels = count($this->filteredObjs);


        //Price slider  -------------------------------------------------------------------------------------

        $arPrices = explode('-', $filters['average_nigthlyRate']);

        $filterMinPrice = trim($arPrices[0]);
        $filterMaxPrice = trim($arPrices[1]);

        

        //If minPrice & maxPrice from slider are identical from original values - no filtering
        if( $filterMinPrice != ((int)$arFiltersAr['prices']['min'])
            || $filterMaxPrice != ceil((float)$arFiltersAr['prices']['max']))
        {
            array_walk($this->filteredObjs, array($this,'filterByPrice'),array('min'=>$filterMinPrice, 'max'=>$filterMaxPrice));
        }


        //Regenerate the arMinMaxPrice
        foreach ($this->filteredObjs as $hotel) {
            $hotel->getMinMaxPrice();
        }

        //Create yellow filter div
        if((count($this->filteredObjs) <= $this->nbrHotels && ($filterMinPrice != ((int)$arFiltersAr['prices']['min']))
            || ($filterMaxPrice != ceil((float)$arFiltersAr['prices']['max']))))
        {
            $this->arFilterActivated['Prices'] = count($this->filteredObjs) ;
        }

        //Update the number of hotels after previous filtering
        $this->nbrHotels = count($this->filteredObjs);
         
        
        //Is Our Pick -------------------------------------------------------------------------------------
        if(array_key_exists('is_our_pick', $filters)){
            array_walk($this->filteredObjs, array($this,'filterIsOurPick'));
        }

        //Create yellow filter div
        if(count($this->filteredObjs) <= $this->nbrHotels && array_key_exists('is_our_pick', $filters)){
            $this->arFilterActivated['Prefered Hotels'] = count($this->filteredObjs) ;
        }

        //Update the number of hotels after previous filtering
        $this->nbrHotels = count($this->filteredObjs);
 

        //Location  -------------------------------------------------------------------------------------

        //No location selected - return empty array
        if(!array_key_exists('location', $filters)){
            $this->filteredObjs = array();
            $this->arFilterActivated['Location'] = 0;
            return $this->filteredObjs;

        }

        $arLocationFilter = array_keys($arFiltersAr['location']);

        $locationToKeep = array_intersect_key(array_flip($arLocationFilter), $filters['location']);
        $locationToKeep = array_flip($locationToKeep);
        
        array_walk($locationToKeep, array($this,'replaceUnderScoreWithSpace'));

        foreach ($this->filteredObjs as $key=>$hotel) {
            if(!in_array($hotel->location, $locationToKeep)){
                unset($this->filteredObjs[$key]);
            }
        }

        //Create yellow filter div
        if(count($this->filteredObjs) < $this->nbrHotels &&
            count($arLocationFilter) != count($locationToKeep)){
            $this->arFilterActivated['Location'] = count($this->filteredObjs) ;
        }

        
        //Chain -------------------------------------------------------------------------------------

        //No chain selected - return empty array
        if(!array_key_exists('chain', $filters)){
            $this->filteredObjs = array();
            $this->arFilterActivated['Hotel chain'] = 0;
            return $this->filteredObjs;

        }

        $arHotelChainFilter = array_keys($arFiltersAr['chain']);
        
        $hotelChainToKeep = (array_intersect_key(array_flip($arHotelChainFilter), $filters['chain']));
        $hotelChainToKeep = array_flip($hotelChainToKeep);
        array_walk($hotelChainToKeep, array($this,'replaceUnderScoreWithSpace'));

        foreach ($this->filteredObjs as $key=>$hotel) {
            if(!in_array($hotel->chain, $hotelChainToKeep)){
                unset($this->filteredObjs[$key]);
            }
        }


        if(count($this->filteredObjs) < $this->nbrHotels &&
            count($arHotelChainFilter) != count($hotelChainToKeep)){
            $this->arFilterActivated['Hotel chain'] = count($this->filteredObjs) ;
        }

        //Update the number of hotels after previous filtering
        $this->nbrHotels = count($this->filteredObjs);

        
        /*
        
        //Generate an array with infos from Hotels filtered to deactivate some checkbox of the filter hotel form
        foreach($objects as $hotel){

            if(!in_array($hotel->starRating, $this->arFilterToDeactivate['starRating'])){
                array_push($this->arFilterToDeactivate['starRating'], $hotel->starRating);
                
            }

            if($this->arFilterToDeactivate['isOurPick'] === false && $hotel->isOurPick == 'Y'){
                $this->arFilterToDeactivate['isOurPick'] = true;
            }

            if(!in_array($hotel->location, $this->arFilterToDeactivate['location'])){
                array_push($this->arFilterToDeactivate['location'], $hotel->location);

            }

            if(!in_array($hotel->chain, $this->arFilterToDeactivate['chain'])){
                array_push($this->arFilterToDeactivate['chain'], $hotel->chain);

            }

            if($key == 0){
                $this->arFilterToDeactivate['price']['min'] = $hotel->minPrice;
                $this->arFilterToDeactivate['price']['max'] = $hotel->maxPrice;
            }else{
                
                $this->arFilterToDeactivate['price']['min'] = min($this->arFilterToDeactivate['price']['min'],$hotel->minPrice);
                $this->arFilterToDeactivate['price']['max'] = max($this->arFilterToDeactivate['price']['max'],$hotel->maxPrice);
                
            }

        }
         *
         */

        //Generate an array with infos from Hotels filtered to deactivate some checkbox of the filter hotel form
       
        //echo "Filtered hotels: ". count($this->filteredObjs);
        //echo "<hr />";
        //$this->filteredObjs = $objects;

        
    }

    public function createArFilterToDeactivate($type){

        $arStarRating = array_keys($this->filters['starRating']);
        foreach($arStarRating as &$value){
            $value = (string)$value;
        }

        $arChains = array_keys($this->filters['chain']);
        array_walk($arChains, array($this,'replaceUnderScoreWithSpace'));

        $arLocations = array_keys($this->filters['location']);
        array_walk($arLocations, array($this,'replaceUnderScoreWithSpace'));

        $arPrices = explode('-', $this->filters['average_nigthlyRate']);

        $arPrices = array_map('trim', $arPrices);
        
        //var_dump($arPrices);

        switch ($type) {
            case 'starRating':

                foreach ($this->arObjs as $hotel) {

                    if((!in_array($hotel->location, $this->arFilterToDeactivate['location'])) &&
                            ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                        (in_array($hotel->starRating, $arStarRating)) && in_array($hotel->chain, $arChains))
                    {
                        array_push($this->arFilterToDeactivate['location'], $hotel->location);
                    }

                    if((!in_array($hotel->chain, $this->arFilterToDeactivate['chain'])) &&
                        ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                        (in_array($hotel->starRating, $arStarRating)) && in_array($hotel->location, $arLocations))
                    {
                        array_push($this->arFilterToDeactivate['chain'], $hotel->chain);
                    }
                }

                unset($this->arFilterToDeactivate['starRating']);

                break;

            case 'location':

                    foreach ($this->arObjs as $hotel) {

                        if((!in_array($hotel->starRating, $this->arFilterToDeactivate['starRating'])) &&
                            ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                            (in_array($hotel->location, $arLocations)) && in_array($hotel->chain, $arChains))
                        {
                            array_push($this->arFilterToDeactivate['starRating'], $hotel->starRating);
                        }

                        if((!in_array($hotel->chain, $this->arFilterToDeactivate['chain'])) &&
                           ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                           (in_array($hotel->location, $arLocations)) && in_array($hotel->starRating, $arStarRating))
                        {
                            array_push($this->arFilterToDeactivate['chain'], $hotel->chain);
                        }

                    }
                
                unset($this->arFilterToDeactivate['location']);
                break;

            case 'chain':
                    foreach ($this->arObjs as $hotel) {

                        if((!in_array($hotel->starRating, $this->arFilterToDeactivate['starRating'])) &&
                            ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                            (in_array($hotel->chain, $arChains)) && in_array($hotel->location, $arLocations))
                        {
                            array_push($this->arFilterToDeactivate['starRating'], $hotel->starRating);
                        }

                        if((!in_array($hotel->location, $this->arFilterToDeactivate['location'])) &&
                           ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                           (in_array($hotel->chain, $arChains)) && in_array($hotel->starRating, $arStarRating))
                        {
                            array_push($this->arFilterToDeactivate['location'], $hotel->location);
                        }

                    }

                unset($this->arFilterToDeactivate['chain']);
               
                break;

            case 'slider':
                    foreach($this->arObjs as $hotel)
                    {

                        //var_dump($hotel->minPrice);
                        //var_dump($arPrices[0]);
                        //var_dump($hotel->maxPrice);
                        //var_dump($arPrices[1]);
                        //exit;

                        if(!in_array($hotel->starRating, $this->arFilterToDeactivate['starRating']) &&
                            ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                             in_array($hotel->location, $arLocations) && in_array($hotel->chain, $arChains))
                        {
                            array_push($this->arFilterToDeactivate['starRating'], $hotel->starRating);
                        }

                        if(!in_array($hotel->location, $this->arFilterToDeactivate['location']) &&
                            ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                             in_array($hotel->starRating, $arStarRating) && in_array($hotel->chain, $arChains))
                        {
                            array_push($this->arFilterToDeactivate['location'], $hotel->location);
                        }
                        
                        if(!in_array($hotel->chain, $this->arFilterToDeactivate['chain']) &&
                            ($hotel->minPrice > $arPrices[0] && $hotel->maxPrice < $arPrices[1]) &&
                             in_array($hotel->starRating, $arStarRating) && in_array($hotel->location, $arLocations))
                        {
                            array_push($this->arFilterToDeactivate['chain'], $hotel->chain);
                        }
                        


                    }

                //unset($this->arFilterToDeactivate['prices']);
            
                break;

            default:
                break;
        }



        //Get min max prices.
        //echo count($this->filteredObjs);
        reset($this->filteredObjs);
        $firstHotel = current($this->filteredObjs);

        //echo $firstHotel;
        

        $this->arFilterToDeactivate['prices']['min'] = $firstHotel->minPrice;

        foreach($this->filteredObjs as $hotel){
            $this->arFilterToDeactivate['prices']['min'] = min($this->arFilterToDeactivate['prices']['min'], $hotel->minPrice);
            $this->arFilterToDeactivate['prices']['max'] = max($this->arFilterToDeactivate['prices']['max'], $hotel->maxPrice);
        }


        return $this->arFilterToDeactivate;
        
    }

    private function replaceSpaceWithUnderScore(&$value){
        $value = str_replace(' ', '_', $value);
        
    }

    private function replaceUnderScoreWithSpace(&$value){
        $value = str_replace('_', ' ', $value);
    }

    private function filterIsOurPick($hotel, $key){
        if($hotel->isOurPick == 'N'){
            unset($this->filteredObjs[$key]);
        }
    }

    private function filterByPrice($hotel, $key, $filterPrices){

        $hotel->filterRates($filterPrices);

        //Check if some all the rooms are still available
        $roomsIds = $hotel->getRoomIds();
        $numRooms = $hotel->numRooms;
        $diffRooms = array_diff($numRooms, $roomsIds);
        //var_dump($roomsIds);
        //var_dump($numRooms);

        if(!empty($diffRooms)){
            unset($this->filteredObjs[$key]);
        }else{
            $hotel->getMinMaxPrice();
        }

    }


    private function sortBy($criteria){

        //echo $criteria;
        //exit;

        switch ($criteria) {
            case preg_match('#sort_price#',$criteria) >0:
                //echo 'price';
                uasort($this->filteredObjs, array($this, 'cmpPrice'));
                break;
            case preg_match('#our_pick#',$criteria) >0:
                //echo 'stops';
                uasort($this->filteredObjs, array($this, 'cmpIsOurPick'));
                break;
            case preg_match('#starRating#',$criteria) >0:
                //echo 'airline';
                uasort($this->filteredObjs, array($this, 'cmpStarRating'));
                break;
            case preg_match('#name#',$criteria) >0:
                //echo 'sort_takeoff';
                uasort($this->filteredObjs, array($this, 'cmpName'));
                break;
        }

        if(preg_match('#desc#', $criteria) >0){

            $this->filteredObjs = array_reverse($this->filteredObjs);

        }

    }
    
    private function cmpPrice($a, $b) {

        if ($a->minPrice == $b->minPrice) {
            return 0;
        }
        return ($a->minPrice < $b->minPrice) ? -1 : 1;
    }

    private function cmpIsOurPick($a, $b){
        
        if($a->isOurPick == $b->isOurPick){
            return 0;
        }

        return ($a->isOurPick > $b->isOurPick)? -1 : 1;

    }

    private function cmpStarRating($a,$b){
        
        if ($a->starRating == $b->starRating) {
            return 0;
        }
        return ($a->starRating < $b->starRating) ? -1 : 1;

    }

    private function cmpName($a,$b){

        if ($a->name == $b->name) {
            return 0;
        }
        return ($a->name < $b->name) ? -1 : 1;

    }


    private function paginate($page){

        //Create array for gMapFilteredHotels
        $this->filteredObjGmap = $this->createArGmapFilteredHotels();

        $this->nbrHotelsToPaginate = count($this->filteredObjs);
        $first = $page * 10 -10;
        $last = $first +10;
        $this->filteredObjs = array_slice($this->filteredObjs, $first, $last);
        
        //Save hotel thumbnails
        foreach ($this->arObjs as $hotel) {
            $hotelThumb = new PlexImage($hotel->baseImageLink);
        }
    }

    protected function createArGmapFilteredHotels(){

        $tmp = array();
        foreach($this->filteredObjs as $obj){
            array_push($tmp , $obj->id);
        }

        return $tmp;
    }





    private function loadFilterFile(){



    }

    public function displayFilterForm(){

        //Load datas 
        $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$this->filename.'.filters';

        if(file_exists($filename)){
            $content = file_get_contents($filename);
        }else{
            $message = "Filter file for {$this->filename} does not exists. Pb when parsing the plex response (probably).";
            throw new Exception($message, 500);
        }
        
        
        $content = file_get_contents($filename);
        $arFilterDatas = unserialize($content);

        //echo "<pre>";
        //print_r($arFilterDatas);
        //break;


        $frm = new HTML_Form();
        $frmStr = $frm->startForm(url_for('@filter_hotel_form'), 'post', 'filterForm',
                        array('class' => 'filterForm'));
        $frmStr .= $frm->addInput('hidden', 'filename', $this->filename);
        $frmStr .= $frm->addInput('hidden', 'type', $this->type);

        
        //Map link
        //$frmStr .= '<div class="box-11">';
        //$frmStr .= "<h4>" . __("Map") . "</h4></div>";
        //$frmStr .= '<div class="box-2">';
        //$frmStr .= '<a href="#" class="hotelResult-tabs" id="gmapLink">';
        //$frmStr .= $this->getGmapImageStatic();
        //$frmStr .= '</a>';
        //$frmStr .= '<p><a href="#" class="resetGmap">'.__('Reset map').'</a>';
        //$frmStr .= '</div>';


       

        //Star rating
        $frmStr .= '<div class="box-1">';
        $frmStr .= '<h4 style="float: left;" id="star_rating">' . __("Star rating") . '</h4>';
        $frmStr .= '<a href="" class="remove-small right reset-star hide">reset</a></div>';
        $frmStr .= '<div class="box-2">';
        $frmStr .= '<table style="width: 100%;">';
        $frmStr .= '<thead><tr>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">min</th>
                    <th style="text-align: right;">max</th>
                    </thead>';
        foreach($arFilterDatas['starRating'] as $key=>$value){

            $frmStr .= '<tr style="font-size: 90%; " class="starRating_tr" id="starRating_'.$key.'_tr"><td>';
            $frmStr .= $frm->addInput('checkbox', 'starRating['.$key.']', 1, array('checked' => 'checked', 'class' => 'filterHotelCheckbox starRatingCheckbox', 'id' => 'starRating_'.$key));
            $frmStr .= '<label for=starRating_' . $key . '>' . HotelGenericObj::getStarRating($key) . '</label>';
            $frmStr .= '</td>';
            $frmStr .= '<td style="text-align: center;"><a href="'.  url_for('filter_hotel_form').'" id="filter-star-link-'.$key.'" class="filter-star-link">'.$value['total'].'</a></td>';
            //$frmStr .= '</tr><tr style="background-color: #eee;">';
            $frmStr .= '<td style="text-align: right;">'.
                        $this->getLinkAccordingToNumberOfResponse($value['min']).
                        '</td><td style="text-align: right;">'.
                        $this->getLinkAccordingToNumberOfResponse($value['max']).
            '</td>';
            $frmStr .= '</tr>';
            $frmStr .= '<tr></tr>';

        }
        $frmStr .= "</table>";
        $frmStr .= '</div>';


        //Average nightlyRate
        $frmStr .= '<div class="box-1">';
        $frmStr .= '<h4 style="float: left;" id="average_nightly_rate">' . __("Average Nightly Rate") . '</h4>';
        $frmStr .= '<a href="" class="remove-small right reset-slider  hide">reset</a></div>';
        $frmStr .= '<div class="box-2">';

        $key     = 'average_nigthlyRate';
        //$frmStr .= '<p id="slider_minmaxPrice"><span id="slider_minPrice"></span><span id="slider_maxPrice"></span></p>';
        $frmStr .= "<div id=slider_$key ></div><br />";
        $frmStr .= "<div id=info_$key class=slider_info ></div>";
        $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
        $frmStr .= '</div>';

        //Is our pick
        $frmStr .= '<div class="box-1">';
        $frmStr .= '<h4 style="float: left;" id="is_our_pick">' . __("Is our pick") . '</h4>';
        $frmStr .= '<a href="" class="remove-small right reset-pick  hide">reset</a></div>';
        $frmStr .= '<div class="box-2">';
        $frmStr .= '<table style="width: 100%"><thead><tr>
                    <th></th>
                    <th style="text-align: right;">min</th>
                    <th style="text-align: right;">max</th>
                    </thead>';
        $frmStr .= '<tr  style="font-size: 90%; "><td>';
        $frmStr .= $frm->addInput('checkbox', 'is Our pick', 1, array('class' => 'filterHotelCheckbox isOurPickCheckbox', 'id' => 'isOurPick'));
        //$frmStr .= '<label for="isOurPick">Our selection</label>';
        $frmStr .= '<span>'.count($arFilterDatas['isOurPick']['list']).' '.__('hotels').'</span></td>';
        $frmStr .= '<td  style="text-align: right;">'.
                    $this->getLinkAccordingToNumberOfResponse($value['min']).
                    '</td><td  style="text-align: right;">'.
                    $this->getLinkAccordingToNumberOfResponse($value['max']).
                    '</<td></tr></table>';
        $frmStr .= '</div>';

        //Location
        $frmStr .= '<div class="box-1">';
        $frmStr .= '<h4 style="float: left;" id="location" >' . __("Location") . '</h4>';
        $frmStr .= '<a href="" class="remove-small right reset-location  hide">reset</a></div>';
        $frmStr .= '<div class="box-2">';
        $frmStr .= '<table style="width: 100%">';
        $frmStr .= '<thead><tr>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">min</th>
                    <th style="text-align: right;">max</th>
                    </thead>';
        $frmStr .= '<tbody>';
        $jeton = 0;
        foreach($arFilterDatas['location'] as $key=>$value){
            $frmStr .= '<tr class="'.(($jeton > 10)?'location2':'' ).' location_tr" id="location_'.$key.'_tr" >';
            $frmStr .= '<td>';
            $frmStr .= $frm->addInput('checkbox', 'location['.$key.']', 1, array('checked' => 'checked', 'class' => 'filterHotelCheckbox locationCheckbox', 'id' => 'location_'.$key));
            $frmStr .= '<label for=location_' . $key . '>'.str_replace('_', ' ', $key).'</label></td>';
            $frmStr .= '<td  style="font-size: 90%; "><a href="'.  url_for1('filter_hotel_form').'" id="filter-location-link-'.$key.'" class="filter-location-link" >'.count($value['list']).'</a></td>';
            $frmStr .= '<td  style="text-align: right;font-size: 90%; ">'.
                        $this->getLinkAccordingToNumberOfResponse($value['min']).
                        '</td><td  style="text-align: right;font-size: 90%; ">'.
                        $this->getLinkAccordingToNumberOfResponse($value['max']).
            '</td>';
            $frmStr .= '</tr>';
            $jeton++;
        }
        if($jeton > 10){
            $frmStr .= '<tr>
                        <td style="padding-top: 8px;" colspan="2">
                        <a class="link-arrow-left show-location" href="#">'. __('View more'). '</td>
                        </tr>';
        }
        $frmStr .= '</tbody></table>';
        $frmStr .= '</div>';


        //hotelChain
        //var_dump($arFilterDatas['chain']);
        

        $frmStr .= '<div class="box-1">';
        $frmStr .= '<h4 style="float: left;" id="chain">' . __("Hotel chain") . '</h4>';
        $frmStr .= '<a href="" class="remove-small right reset-chain hide">reset</a></div>';
        $frmStr .= '<div class="box-2">';
        $frmStr .= '<table style="width: 100%">';
        $frmStr .= '<thead><tr>
                    <th></th>
                    <th></th>
                    <th style="text-align: right;">min</th>
                    <th style="text-align: right;">max</th>
                    </thead>';
        $frmStr .= '<tbody>';
        $jeton = 0;
        foreach($arFilterDatas['chain'] as $key=>$value){
            $frmStr .= '<tr class="'.(($jeton > 10)?'chain2':'').' chain_tr" id="chain_'.$key.'_tr" >';
            $frmStr .= '<td>';
            $frmStr .= $frm->addInput('checkbox', 'chain['.$key.']', 1, array('checked' => 'checked', 'class' => 'filterHotelCheckbox chainCheckbox', 'id' => 'chain_'.$key));
            $frmStr .= '<label for=location_' . $key . '>'.str_replace('_', ' ', $key).'</label></td>';
            $frmStr .= '<td  style="font-size: 90%; "><a href="'.  url_for1('filter_hotel_form').'" id="filter-chain-link-'.$key.'" class="filter-chain-link" >'.count($value['list']).'</a></td>';
            $frmStr .= '<td  style="text-align: right;font-size: 90%; ">'.
                        $this->getLinkAccordingToNumberOfResponse($value['min']).
                        '</td><td  style="text-align: right;font-size: 90%; ">'.
                        $this->getLinkAccordingToNumberOfResponse($value['max']).
            '</td>';
            $frmStr .= '</tr>';
            $jeton++;
        }
        if($jeton > 10){
            $frmStr .= '<tr>
                        <td style="padding-top: 8px;" colspan="2">
                        <a class="link-arrow-left show-chain" href="#">'. __('View more'). '</td>
                        </tr>';
        }



        $frmStr .= '</tbody></table>';
        $frmStr .= '</div>';

         //Name contains
        $frmStr .= '<div class="box-1">';
        $frmStr .= "<h4>" . __("Name contains") . "</h4></div>";
        $frmStr .= '<div class="box-2">';
        $frmStr .= $frm->addInput('text', 'hotelName', 'name',
                    array('id'=>'hotelName', 'class'=> 'span-5') );
        $frmStr .= '<a href="#" class="search-magnifier">'. __('search') .'</a>';
        $frmStr .= '</div>';

        //Reset filter contains
        $frmStr .= '<div class="box-1">';
        $frmStr .= "<h4>" . __("Narrow results") . "</h4></div>";
        $frmStr .= '<div class="box-2">';
        $frmStr .= '<p id="infoFilterResult">'.$this->nbrTotalHotels. __(' hotels found').'</p>';
        $frmStr .= '<a href="'.$_SERVER['PHP_SELF'].'"  class="remove none" id="clearFiltersAll">'. __('Clear selected filter').'</a>';
        $frmStr .= '</div>';



        $frm->endForm();
        $frmStr .= '</form>';

        return $frmStr;

    }

    private function getGmapImageStatic(){

        $filename = $this->getFilameFullPath();
        $content = file_get_contents($filename.'.markers');
        $arMarkers = unserialize($content);


        $url        = 'http://maps.googleapis.com/maps/api/staticmap';
        $center     = 'center='.$arMarkers['latitude'].','.$arMarkers['longitude'];
        $zoom       = 'zoom=15';
        $size       = 'size=250x150';
        $maptype    = 'maptype=roadmap&sensor=false';
        $markers    = 'markers=color:red|size:small|'.$arMarkers['latitude'].','.$arMarkers['longitude'];
        
        foreach($arMarkers['hotels'] as $hotel){
            $markers .= '|'.$hotel['latitude'].','.$hotel['longitude'];
        }

        //$url .= '?'.$center.'&'.$zoom.'&'.$size.'&'.$maptype.'&'.$markers;

        $url .= '?'.$size.'&'.$maptype.'&'.$markers;

        return image_tag($url , array('absolute'=>true));

    }

    private function getLinkAccordingToNumberOfResponse($datas){

        $link = '';

        //var_dump($datas);

        switch(count($datas['list'])){

            case 0:
                return null;
                break;


            case 1:
                $value = array_values($datas['list']);
                $link = link_to2(format_currency($datas['price'], sfConfig::get('app_currency')), 'hotel_detail',  array('slug'=>  $value[0]), array('class'=>'hotelDetailAjaxLink'));
                
                break;
            default:
                $value = array_values($datas['list']);
                $link = link_to2(format_currency($datas['price'], sfConfig::get('app_currency')), 'filter_hotel_form',  array('slug'=>  array_values($datas['list'])), array('class'=>'hotelDetailAjaxLink'));

                break;
        }

        return $link;

    }

}
?>
