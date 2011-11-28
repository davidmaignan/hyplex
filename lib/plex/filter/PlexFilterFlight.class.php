<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexFilter
 *
 * @author david
 */
class PlexFilterFlight {

    //put your code here

    public $filename;
    public $type;
    public $arObjs = array();

    //put your code here
    protected $stopsFields = array( 'stop0' => array('checkbox', 'Non stop', 1),
                                    'stop1' => array('checkbox', '1 stop', 1),
                                    'stop2' => array('checkbox', '2+ stops', 1));
    protected $flightTimeFields = array('takeoff_departflight' => array('text'));
    protected $flightTimeFields2 = array('takeoff_returnflight' => array('text'));
    protected $flightQuality = array('red_eyes' => array('checkbox', 'Show Overnight flight', 1));
    protected $tripDurationFields = array('tripduration' => array('text'));
    protected $tripPrice = array('price' => array('text'));
    protected $arStop0 = array();
    protected $arStop1 = array();
    protected $arStop2 = array();
    public $arAirlines = array();
    public $arCheapest = array();
    //private $arFilters = array('stop0','stop1','stop2','red_eyes');
    protected $arFilters = array(   'stop0', 'stop1', 'stop2', 'red_eyes', 'filename',
                                    'type', 'tripduration', 'takeoff_departflight',
                                    'takeoff_returnflight', 'price', 'sortBy');
    protected $arSorting = array('sort_airline', 'sort_takeoff', 'sort_landing', 'sort_stops', 'sort_price');
    public $arFormSlidersInfo = array(  'minPrice', 'maxPrice', 'takeoffDepMin', 'takeoffDepMax',
                                        'takeoffRetMin', 'takeoffRetMax', 'minDuration', 'maxDuration');


    public $nbrFlightsToPaginate;
    public $filteredObjs = array();

    public function __construct($type, $filename, $page, $filters) {

        //sfProjectConfiguration::getActive()->loadHelpers(array('Number', 'I18N', 'Url', 'Asset', 'Tag'));

        $this->filename = $filename;
        $this->type = $type;

        //echo $this->getFilameFullPath() . '.plex';
        //break;

        //-----------------------------------------
        //If filename.plex2 - already read one so best price added to request file
        //-----------------------------------------

        $this->arObjs = $this->parseFile($this->getFilameFullPath());
        
        /*
        //Add the best price in the request file same line.
        $bestPrice = $this->arObjs[1];

        $handle = fopen(sfConfig::get('sf_user_folder') . '/request', 'a');
        fseek($handle, filesize($filename));
        fwrite($handle, '|' . serialize($bestPrice));
        fclose($handle);

        //Rename file -
        rename($filename . '.plex', $filename . '.plex2');
        chmod($filename . '.plex2', 0777);
         * 
         */
    }

    protected function getFilameFullPath(){
        return sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.
                'flight'.DIRECTORY_SEPARATOR.
                $this->filename.DIRECTORY_SEPARATOR.'plexResponse.plex';
    }

    protected function parseFile($filename) {


        if ($filename === null || !file_exists($filename)) {
            throw new Exception('You must provide a file in the FilterClass');
        }

        $content = file_get_contents($filename);

        //echo $content;

        $ar = array();

        while ($join = strpos($content, '---')) {
            $obj = unserialize(trim(substr($content, 0, $join)));
            $content = trim(substr($content, $join + 3));
            array_push($ar, $obj);
        }


        $bestPrice = $ar[1];

        //Add the best price in the request file same line.
        $handle = fopen($filename, 'r+');
        fseek($handle, filesize($filename));
        fwrite($handle, serialize($bestPrice));
        fclose($handle);

        //Rename plex


        return $ar;
    }

    protected function paginate($page){

        //$this->nbrFlightsToPaginate = count($this->filteredObjs);

        $first = $page * 10 -10;

        $last = $first +10;

        $this->filteredObjs = array_slice($this->filteredObjs, $first, $last);

    }

    protected function render($name, $value) {
        
    }

    private function cmpPrice($a, $b) {

        if ($a->TotalPrice == $b->TotalPrice) {
            return 0;
        }
        return ($a->TotalPrice < $b->TotalPrice) ? -1 : 1;
    }

    protected function cmpStops($a, $b) {

        if ($a->nbrStopsOutbound == $b->nbrStopsOutbound
                && $a->nbrStopsInbound == $b->nbrStopsInbound
        ) {
            return 0;
        }
        return ($a->nbrStopsOutbound <= $b->nbrStopsOutbound && $a->nbrStopsInbound <= $b->nbrStopsInbound) ? -1 : 1;
    }

    protected function cmpTakeOff($a, $b) {

        //echo $a->SegmentOutbound->Departs;
        //exit;

        if ($a->SegmentOutbound->Departs == $b->SegmentOutbound->Departs) {
            return 0;
        }
        return ($a->SegmentOutbound->Departs < $b->SegmentOutbound->Departs) ? -1 : 1;
    }

    protected function cmpLanding($a, $b) {

        if ($a->SegmentOutbound->Arrives == $b->SegmentOutbound->Arrives) {
            return 0;
        }
        return ($a->SegmentOutbound->Arrives < $b->SegmentOutbound->Arrives) ? -1 : 1;
    }

    protected function cmpAirline($a, $b) {

        
        $listAirlines = Utils::createAirlineArray();
        //var_dump($listAirlines);

        //print_r($listAirlines);
        //break;

        //If multi airlines add the word multi in front of the others airlines names

        if (count($a->arAirlines) > 1) {
            $airline1 = 'multi_';
            sort($a->arAirlines);
            foreach ($a->arAirlines as $value) {
                $airline1 .= $listAirlines[$value][1];
            }
            //print_r($a->arAirlines);
        } else {
            $airline1 = $listAirlines[$a->arAirlines[0]][1];
            //var_dump($a->arAirlines[0]);
        }

        if (count($b->arAirlines) > 1) {
            $airline2 = 'multi_';
            sort($b->arAirlines);
            foreach ($b->arAirlines as $value) {
                $airline2 .= $listAirlines[$value][1];
            }
            //print_r($a->arAirlines);
        } else {
            $airline2 = $listAirlines[$b->arAirlines[0]][1];
        }

        if ($airline1 == $airline2) {
            return 0;
        }

        if ($airline1 < $airline2) {
            return -1;
        } else {
            return 1;
        }

        //exit;

        if (count($a->arAirlines) == count($b->arAirlines) && $airline1 == $airline2) {
            return 0;
        }

        if (count($a->arAirlines) == count($b->arAirlines) && $airline1 < $airline2) {
            return -1;
        } else {
            return 1;
        }

        if (count($a->arAirlines) < count($b->arAirlines)) {
            return -1;
        } else {
            return 1;
        }

        //return ($a->TotalPrice < $b->TotalPrice) ? -1 : 1;
    }

    protected function sortBy($criteria) {

        //echo "Sort by:";
        //echo "<br />";
        //echo $criteria;
        //exit;
        //echo count($this->arObjs);

        //echo preg_match('#takeoff#', $criteria);
        //exit;

        switch (true) {
            case (preg_match('#price#', $criteria)>0):
                //echo 'price';
                uasort($this->filteredObjs, array($this, 'cmpPrice'));
                break;
            case (preg_match('#stops#', $criteria)>0):
                //echo 'stops';
                uasort($this->filteredObjs, array($this, 'cmpStops'));
                break;
            case (preg_match('#airline#', $criteria)>0):
                //echo 'airline';
                uasort($this->filteredObjs, array($this, 'cmpAirline'));
                break;
            case (preg_match('#takeoff#', $criteria)>0):
                //echo 'sort_takeoff';
                uasort($this->filteredObjs, array($this, 'cmpTakeOff'));
                break;
            case (preg_match('#landing#', $criteria)>0):
                //echo 'sort_landing';
                uasort($this->filteredObjs, array($this, 'cmpLanding'));
                break;
        }

        //echo preg_match('#desc#', $criteria);
        //exit;

        if(preg_match('#desc#', $criteria) == 1){
            $this->filteredObjs = array_reverse($this->filteredObjs);
        }


        //echo "<pre>";
        //print_r($this->arObjs);
        //break;
    }

    public function getMatrix() {

        $datas = $this->arAirlines;
        $prices = $this->arCheapest;

        //var_dump($prices);

        $result = array();

        //Need to return an multidimentionnal array with x number or entries of 6 results
        //and each result is ann index of an airline code (or multi):
        //each has 1,2,3 entries for 0, 1, 2+ stops, the cheapest one and the unique reference

        /*
         * array(0=>array('airline1'=>array(0=>array(price,unique ref)
         *                                  1=>array(price,unique ref)
         *                                  2=>array(price,unique ref))
         *                'airline2'=>array(1=>array(price,unique ref)))
         * ....
         *
         */

        //Chunk the array if more than 6 cies
        $datas = array_chunk($datas, 5, true);

        //echo "<pre>";
        //$tmp = array();

        for ($j = 0; $j < count($datas); $j++) {


            $ar = $datas[$j];
            $tmp2 = array();

            for ($i = 0; $i <= 2; $i++) {

                $tmp = array();

                foreach ($ar as $key => $value) {
                    $val = $this->retreiveCheapestPerStop($value, $i);
                    $tmp[$key] = $val;
                }

                $tmp2[$i] = $tmp;
            }

            //print_r($tmp2);
            $result[$j] = $tmp2;
        }

        return $result;

        /*
          for($i=0;$i<count($datas);$i++){

          $ar = $datas[$i];
          $tmp = array();

          foreach ($ar as $key => $value) {
          //echo "Airline $key: 0 Stop:<br />";
          $val = $this->retreiveCheapestPerStop($value, 0);
          //print_r($val);
          $tmp[$key][0] = $val;
          //echo "<br />";
          //echo "Airline $key: 1 Stop:<br />";
          $val = $this->retreiveCheapestPerStop($value, 1);
          //print_r($val);
          $tmp[$key][1] = $val;
          //echo "<br />";
          //echo "Airline $key: 2 Stop:<br />";
          $val = $this->retreiveCheapestPerStop($value, 2);
          //print_r($val);
          $tmp[$key][2] = $val;
          //echo "<hr />";
          }

          $result[$i]= $tmp;
          }
          print_r($result);
         *
         */

    }

    protected function retreiveOnlyOne($ar) {

        if (count($ar) == 1) {
            return $ar[0];
        }

        $ar1 = array();
        $ar2 = array();

        foreach ($ar as $value) {
            array_push($ar1, $value['price']);
            array_push($ar2, $value['stops']);
        }

        array_multisort($ar1, $ar2);

        return array('stops' => $ar2[0], 'price' => $ar1[0]);
    }

    protected function retreiveCheapestPerStop($array, $stop) {

        //Check if at least one flight with the number of stops
        $tmp = array();

        //Prices
        $prices = $this->arCheapest;

        //For less than 2 stops

        if ($stop < 2) {

            foreach ($array as $value) {
                if ($value['stops'] == $stop) {
                    array_push($tmp, $value);
                }
            }
        } else {
            foreach ($array as $value) {
                if ($value['stops'] >= $stop) {
                    array_push($tmp, $value);
                }
            }
        }


        if (empty($tmp)) {
            return array('', '', false);
        }

        //Return the cheapest one
        $minPrice = $tmp[0];

        foreach ($tmp as $value) {
            $minPrice = ($minPrice['price'] < $value['price']) ? $minPrice : $value;
        }

        //break;

        $cheapest = ($minPrice['price'] == $prices['stop' . $stop]) ? true : false;

        return array($minPrice['price'], $minPrice['UniqueReferenceId'], $cheapest);
    }


}

