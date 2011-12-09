<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexFilterFlightOneway
 *
 * @author david
 */
class PlexFilterFlightOneway extends PlexFilterFlight implements PlexFilterInterface {

    //put your code here

    public function __construct($type, $filename, $page, $filters) {

        parent::__construct($type, $filename, $page, $filters);

        //var_dump($this->arObjs[0]);
        //echo 'here';
        //break;
        //Need to know the cheapest price per number of stops
        $this->getFlightStopArray();

        //Create array to infos for the sliders for the filtering form
        //$this->getDatasForFilterForm();
        //break;
        if (!empty($filters)) {

            $this->filterDatas($filters);
            $sortCriteria = $filters['sortBy'];
            $this->sortBy($sortCriteria);
        }else{
            $this->filteredObjs = $this->arObjs;
        }

        //$this->paginate($page);
    }
    

    public function getDatasForFilterForm() {
        $keys = $this->arFormSlidersInfo;
        $values = array_fill(0, count($keys), '');

        $tmp = array_combine($keys, $values);
        $tmp['minPrice'] = $this->arObjs[0]->TotalPrice;
        $tmp['maxPrice'] = $this->arObjs[0]->TotalPrice;
        $tmp['takeoffDepMin'] = Utils::getArrayTimeFromSegments($this->arObjs[0]->SegmentOutbound->Departs);
        $tmp['takeoffDepMax'] = Utils::getArrayTimeFromSegments($this->arObjs[0]->SegmentOutbound->Departs);
        $tmp['minDuration'] = ($this->arObjs[0]->SegmentOutbound->FlightDuration);
        $tmp['maxDuration'] = ($this->arObjs[0]->SegmentOutbound->FlightDuration);

        foreach ($this->arObjs as $object) {
            $tmp['minPrice'] = min($object->TotalPrice, $tmp['minPrice']);
            $tmp['maxPrice'] = max($object->TotalPrice, $tmp['maxPrice']);
            $tmp['takeoffDepMin'] = min(Utils::getArrayTimeFromSegments($object->SegmentOutbound->Departs), $tmp['takeoffDepMin']);
            $tmp['takeoffDepMax'] = max(Utils::getArrayTimeFromSegments($object->SegmentOutbound->Departs), $tmp['takeoffDepMax']);
            $tmp['minDuration'] = min($object->SegmentOutbound->FlightDuration, $tmp['minDuration']);
            $tmp['maxDuration'] = max($object->SegmentOutbound->FlightDuration, $tmp['maxDuration']);
        }

        return $tmp;
        //Define all the variables

        $tmp = array();
    }

    private function getFlightStopArray() {
        $prices = array('0' => array(), '1' => array(), '2' => array());

        foreach ($this->arObjs as $value) {

            //Determine number of stops
            $nbrStops = $value->nbrStopsOutbound;

            //Populate array with the flights and the prices
            switch ($nbrStops) {
                case 0:
                    array_push($this->arStop0, $value);
                    array_push($prices['0'], $value->TotalPrice);
                    break;

                case 1:
                    array_push($this->arStop1, $value);
                    //echo $value->TotalPrice;
                    array_push($prices['1'], $value->TotalPrice);
                    break;

                default:
                    array_push($this->arStop2, $value);
                    array_push($prices['2'], $value->TotalPrice);
                    break;
            }

            //Determine the airlines array, min price for this airlines, number of stops
            //Case 1 $value->$arAirlines has only one entry (one carrier)
            //Case 2 $value->$arAirlines has only more than one entry (multiple airlines)
            //return a multiple associative array
            // key = airlineCode, value = array(stops, price)
            // key = multiple_airlines, value = array(airlines(array), stops, price)

            switch (count($value->arAirlines)) {
                case 1:
                    $tmp = array();
                    $tmp['stops'] = $nbrStops;
                    $tmp['price'] = $value->TotalPrice;
                    $tmp['UniqueReferenceId'] = $value->UniqueReferenceId;
                    //$tmp['']
                    //If not in array add it as a new entry
                    if (!array_key_exists($value->arAirlines[0], $this->arAirlines)) {
                        $this->arAirlines[$value->arAirlines[0]][0] = $tmp;
                    } else {
                        array_push($this->arAirlines[$value->arAirlines[0]], $tmp);
                    }

                    break;

                default:
                    $tmp = array();
                    $tmp['airlines'] = $value->arAirlines;
                    $tmp['stops'] = $nbrStops;
                    $tmp['price'] = $value->TotalPrice;
                    $tmp['UniqueReferenceId'] = $value->UniqueReferenceId;
                    if (!array_key_exists('multi', $this->arAirlines)) {
                        $this->arAirlines['multi'][] = $tmp;
                    } else {
                        array_push($this->arAirlines['multi'], $tmp);
                    }

                    break;
            }
        }

        //Determine the cheapeast flight
        foreach ($prices as $key => $value) {
            if (count($value) > 0) {
                $this->stopsFields['stop' . $key]['price'] = min($value);
                $this->arCheapest['stop' . $key] = min($value);
            }
        }


        ksort($this->arAirlines);

        //echo "<pre>";
        //print_r($this->arAirlines);
        //print_r($this->arCheapest);
        //print_r($this->stopsFields);
        //$keys = array_keys($this->arAirlines);
        //array_merge($this->arFilters, $keys);
        //echo "<pre>";
        //print_r($this->arCheapest);
        //print_r($this->arFilters);
        //break;
    }

    protected function filterDatas($filters) {


        //If no filter is passed to the function -> exit straigth away
        if (empty($filters)) {
            return true;
        }

        //Array to hold the FlightObjects which successfully will pass all the filtering criterias
        $objects = array();

        // --------------------------
        //Number of stops (checkboxes)
        //array_key_exists($key, $searcharray)

        if (array_key_exists('stop0', $filters)) {
            $objects = array_merge($objects, $this->arStop0);
        }

        if (array_key_exists('stop1', $filters)) {
            $objects = array_merge($objects, $this->arStop1);
        }

        if (array_key_exists('stop2', $filters)) {
            $objects = array_merge($objects, $this->arStop2);
        }

        //echo count($objects) . '<br />';
        //$this->arObjs = $objects;
        //return true;
        // --------------------------
        // Airlines filtering (checkboxes).
        //Retreives all the airlines passed in the filter
        //and compare them with the arAirlines array of each flight object

        $formKeys = array_keys($filters);                       // Get the all the filtering criteria
        $airLines = array_diff($formKeys, $this->arFilters);    // Remove all the non airlines ones (stops, duration, price ...)
        // We have only the airlines ones now
        //Next loop check intersection between the flightReturnObject arAirlines array
        //and the airLines passed in the filter
        //If the difference return a different arrays -> means that one airline is missing so remove the object
        //echo "<pre>";
        //print_r($formKeys);
        //print_r($airLines);

        $nbrObjects = count($objects);

        foreach ($objects as $key => $obj) {

            $tmp = $obj->arAirlines;

            switch (count($tmp)) {
                //only one airline
                case 1:
                    $diff = (array_intersect($tmp, $airLines));
                    if ($tmp != $diff)
                        unset($objects[$key]);

                    break;
                //Multi airline - check if multi is in array $airLines
                default:
                    if (!in_array('multi', $airLines))
                        unset($objects[$key]);
                    break;
            }

            //$diff = (array_intersect($tmp, $airLines));
            //if ($tmp != $diff) {
            //unset($objects[$key]);
            //}
        }



        //echo "count -> airlines:". count($objects);
        //echo "<hr />";
        // --------------------------
        // Price filtering (slider).
        //$arPrice = Utils::retrievePriceFromSlider($filters['price']);
        //print_r($arPrice);
        //break;


        foreach ($objects as $key => $obj) {
            if ((float) ($obj->TotalPrice) > $filters['price']) {
                unset($objects[$key]);
            }
        }

        //echo "count -> price:". count($objects);
        //echo "<hr />";
        // --------------------------
        // Flight time takeoff_departflight filtering (slider).
        $takeoff_departflight = Utils::retrieveTimeFromSlider($filters['takeoff_departflight']);

        //print_r($takeoff_departflight);
        //break;

        foreach ($objects as $key => $obj) {

            $outboundTime = Utils::getArrayTimeFromSegments($obj->SegmentOutbound->Departs);

            //This needs to be tested
            if (Utils::comparingTimes($takeoff_departflight[0], $outboundTime)
                    ^ Utils::comparingTimes($outboundTime, $takeoff_departflight[1])) {
                unset($objects[$key]);
            }
        }

        //echo "count -> takeoff departflight:". count($objects);
        //echo "<hr />";

        // --------------------------
        // Trip duration (slider).

        $maxDuration = $filters['tripduration'];  //in minutes

        foreach ($objects as $key => $obj) {

            $duration = $obj->SegmentOutbound->FlightDuration;
            if ($duration > $maxDuration) {
                unset($objects[$key]);
            }
            //echo $object->SegmentInbound->Departs;
            //echo "<br /><br />";
        }

        $this->filteredObjs = $objects;
        return true;
        //echo "count -> tripduration:". count($objects);
        //echo "<hr />";
        //break;
        //Pass the tmp array to the final array
        //$this->arObjs = $objects;
    }

    /*
     * Filter form
     */

    public function displayFilterForm_html5() {
        
        $frm = new HTML_Form();
        $frmStr = $frm->startForm(url_for('@filter_flight_form'), 'post', 'filterForm',
                        array('class' => 'filterForm'));
        $frmStr .= '<fieldset><legend></legend>';
        
        //Hidden fields
        $frmStr .= $frm->addInput('hidden', 'filename', $this->filename);
        $frmStr .= $frm->addInput('hidden', 'type', $this->type);
        
        //Stops
        $frmStr .= "<h4>" . __("Stops") . "</h4>";
        $frmStr .= '<div class="box-content">';
        $frmStr .= '<ul>';
        foreach ($this->stopsFields as $key => $value) {
            if($value['price']){
                $frmStr .= '<li><span class="span-4 last">';
                $frmStr .= $frm->addInput($value[0], $key, 1, array('checked' => 'checked', 'class'=>'FilterCheckbox','id' => $key));
                $frmStr .= '<label for="' . $key . '">' . __($value[1]) . '</label>';
                $frmStr .= '</span>';
                $frmStr .= '<span class="min"><a>'. Utils::getPrice($value['price']) .'</a></span>';
                $frmStr .= '</li>';
            }
        }
        $frmStr .= '</ul>';
        $frmStr .= '</div>';
        
        //Flight times
        $frmStr .= "<h4>" . __("Flight Times") . "</h4>";
        $frmStr .= '<div class="box-content">';
        $frmStr .= '<ul><li><span class="span-4 last bold">';
        $frmStr .= __('Take-off').'</span><span class="min">'.__('depart').'</span>';
        $frmStr .= '</li></ul>';
        
        foreach ($this->flightTimeFields as $key => $value) {
            $frmStr .= '<div id="slider_'.$key.'" class="slider" ></div>';
            $frmStr .= '<div id="info_'.$key.'" class="slider-info append-bottom" ></div>';
            $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
        }
        
        $frmStr .= '</div>';
        
        //Airlines
        $arAirlines = Utils::createAirlineArray();
        $frmStr .= "<h4>" . __("Airlines") . "</h4>";
        $frmStr .= '<div class="box-content">';
        $frmStr .= '<ul>';
        foreach ($this->arAirlines as $key => $value) {
            $tmp = $this->retreiveOnlyOne($value);
            $frmStr .= '<li><span class="span-4 last">';
            $frmStr .= $frm->addInput('checkbox', $key, 1, array('checked' => 'checked', 'class' => 'FilterCheckbox', 'id' => $key));
            $frmStr .= '<label for=' . $key . '>' . truncate_text($arAirlines[$key][0], 20) . '</label>';
            $frmStr .= '</span>';
            $frmStr .= '<span class="min"><a>'.Utils::getPrice($tmp['price']) .'</a></span>';
            $frmStr .= '</li>';
        }
        $frmStr .= '</ul>';
        $frmStr .= '</div>';
        
        
        //Direct flights
        //Flight times
        $frmStr .= "<h4>" . __("Flight quality") . "</h4>";
        $frmStr .= '<div class="box-content">';
        $frmStr .= '<ul>';
        
        foreach ($this->flightQuality as $key => $value) {
             $frmStr .= '<li><span class="span-4 last">';
             $frmStr .= $frm->addInput($value[0], $key, $key, array('checked' => 'checked', 'id' => $key));
             $frmStr .= '<label for=' . $key . '>' . __($value[1]) . '</label>';
             $frmStr .= '</span></li>';
        } 
        $frmStr .= '</ul></div>';
        
        
        $frmStr .= "<h4>" . __("Trip duration") . "</h4>";
        $frmStr .= '<div class="box-content">';
        foreach ($this->tripDurationFields as $key => $value) {
            $frmStr .= '<ul><li><span class="span-4 last">'.__('min').'</span><span class="min">'.__('max').'</span></li></ul>';
            $frmStr .= '<div id="slider_'.$key.'" class="slider" ></div>';
            $frmStr .= "<div id=info_$key class=slider-info></div>";
            $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
            $frmStr .= "</div>";
        }
        
        $frmStr .= "<h4>" . __("Price") . "</h4>";
        $frmStr .= '<div class="box-content">';
        foreach ($this->tripPrice as $key => $value) {
            $frmStr .= '<ul><li><span class="span-4 last">'.__('min').'</span><span class="min">'.__('max').'</span></li></ul>';
            $frmStr .= '<div id="slider_'.$key.'" class="slider" ></div>';
            $frmStr .= "<div id=info_$key class=slider-info></div>";
            $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
            $frmStr .= "</div>";
        }
        
        return $frmStr;
    }

    
    
    public function displayFilterForm() {

        //print($this->filename);

        $frm = new HTML_Form();
        $frmStr = $frm->startForm(url_for('@filter_flight_form'), 'post', 'filterForm',
                        array('class' => 'filterForm'));
        $frmStr .= $frm->addInput('hidden', 'filename', $this->filename);
        $frmStr .= $frm->addInput('hidden', 'type', $this->type);

        $frmStr .= '<div class="box-1">';
        //Add stop checkboxes
        $frmStr .= "<h4>" . __("Stops") . "</h4></div>";
        $frmStr .= '<div class="box-2">';
        //var_dump($this->stopsFields);
        foreach ($this->stopsFields as $key => $value) {
            if (!isset($value['price'])) {
                continue;
            }
            $frmStr .= $frm->addInput($value[0], $key, 1, array('checked' => 'checked', 'class' => 'FilterCheckbox', 'id' => $key));
            $frmStr .= '<label for="' . $key . '">' . __($value[1]) . '</label>';
            $frmStr .= '<span class=" price right blue" >' . format_currency($value['price'], 'USD') . '</span><br />';
        }

        $frmStr .= "</div>";
        $frmStr .= '<div class="box-11">';
        $frmStr .= "<h4>" . __("Flight Times") . "</h4></div>";
        $frmStr .= '<div class="box-2">';
        $frmStr .= '<h3>' . __("Take-off") . '<span class="small right">' . __("Depart flight") . '</span></h3>';
        foreach ($this->flightTimeFields as $key => $value) {

            $frmStr .= "<div id=slider_$key ></div>";
            $frmStr .= "<div id=info_$key class=slider_info ></div>";
            $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
        }
        /*
          $frmStr .= '<h3>' . __("Take-off") . '<span class="small right">' . __("Return flight") . '</span></h3>';
          foreach ($this->flightTimeFields2 as $key => $value) {

          $frmStr .= "<div id=slider_$key ></div>";
          $frmStr .= "<div id=info_$key class=slider_info ></div>";
          $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
          }
         *
         */

        $frmStr .= "</div>";
        $frmStr .= '<div class="box-11">';
        $frmStr .= "<h4>" . __("Airlines") . "</h4>";
        $frmStr .= '</div>';
        $frmStr .= '<div class="box-2">';
        $frmStr .= "<ul>";

        foreach ($this->arAirlines as $key => $value) {
            $tmp = $this->retreiveOnlyOne($value);
            $frmStr .= "<li>";
            $frmStr .= $frm->addInput('checkbox', $key, 1, array('checked' => 'checked', 'class' => 'FilterCheckbox', 'id' => $key));
            $frmStr .= '<label for=' . $key . '>' . $key . '</label>';
            //$frmStr .= '<a href=3 class="only">'.__("only").'</a>';
            $frmStr .= '<span class="price blue">' . format_currency($tmp['price'], 'USD') . '</span>';
            $frmStr .= '<span class="stop">' . $tmp['stops'] . ' stop</span>';
            $frmStr .= "</li>";
        }
        $frmStr .= "</ul></div>";


        $frmStr .= '<div class="box-11">';

        $frmStr .= "<h4>" . __("Flight quality") . "</h4>";
        $frmStr .= '</div>';
        $frmStr .= '<div class="box-2">';

        foreach ($this->flightQuality as $key => $value) {
            $frmStr .= $frm->addInput($value[0], $key, $key, array('checked' => 'checked', 'id' => $key));
            $frmStr .= '<label for=' . $key . '>' . __($value[1]) . '</label>';
        }
        $frmStr .= '</div>';
        $frmStr .= '<div class="box-11">';
        $frmStr .= "<h4>" . __("Trip duration") . "</h4></div>";
        $frmStr .= '<div class="box-2">';
        foreach ($this->tripDurationFields as $key => $value) {
            $frmStr .= "<div id=slider_$key ></div>";
            $frmStr .= "<div id=info_$key class=slider_info></div>";
            $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
        }
        $frmStr .= '</div>';
        $frmStr .= '<div class="box-11">';
        $frmStr .= "<h4>" . __("Price") . "</h4></div>";
        $frmStr .= '<div class="box-2">';
        foreach ($this->tripPrice as $key => $value) {
            $frmStr .= "<div id=slider_$key ></div>";
            $frmStr .= "<div id=info_$key class=slider_info></div>";
            $frmStr .= $frm->addInput('hidden', $key, '', array('id' => $key));
        }

        $frm->endForm();

        $frmStr .= '</form></div>';

        return $frmStr;
    }

}

?>
