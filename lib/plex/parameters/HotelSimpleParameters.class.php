<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexHotelSimpleParameters
 *
 * @author david
 */
class HotelSimpleParameters extends PlexHotelParameters {

    //put your code here

    public  function  __construct($type, $params, $culture) {

        parent::__construct($type, $params, $culture);

        //Create $arParams used to generate the edit sfForm
        //$this->arParams = $params['search_flight'];
        //Retreive origin and destination code.

        $this->whereboxCode = $this->getWhereBox();
        
        //Overide the value from the form.
        $this->type = $type;

        $this->getRoomsArray();
        
    }

    /*
     * @param $ar array with info: name, state, country, state code
     * @param $culture the $sf_user->getCulture();
     *
     * return string formatted like Denver [CO], USA, Denver Metropolitan Area (DEN)
     */
    public function getWhereBox() {

        if (!isset($this->wherebox)) {
            throw new Exception('PlexFlightParameters: you must define an origin');
        }

        $subject = $this->wherebox;

        $pattern = '#\([A-Z]+\)#';
        preg_match_all($pattern, $subject, $matchesarray);

        if (empty($matchesarray[0])) {

            $this->problemWithCode = true;

            return $this->wherebox;
        }


        $this->arWhere = Doctrine::getTable('City')->getCityAllCulture(substr($matchesarray[0][0], 1, -1));

        return substr($matchesarray[0][0], 1, -1);

    }

    protected function getRoomsArray(){

        foreach($this->newRooms as $key=>$value){

            $tmp = array();
            $tmp['number_adults'] = $value['number_adults'];
            $tmp['number_children'] = $value['number_children'];
            $tmp['children_age'] = array();
            
            if($value['number_children'] > 0){
                for($i=1;$i<=$value['number_children'];$i++){
                    array_push($tmp['children_age'], $this->childrenAge[$key.'_'.$i]);
                }
            }
            
            array_push($this->arRooms, $tmp);
        }

        //unset($this->newRooms);
        //unset($this->childrenAge);

    }

    public function getWhereBoxCode(){

        return $this->whereboxCode;

    }

    public function getType(){
        return $this->type;
    }

    public function getWhereBoxResultPage($culture = 'en_US'){
        $string = $this->arWhere['code'];
        $string .= (isset($this->arWhere['airport']) && $this->arWhere['airport'] != '')? ' ('.$this->arWhere['airport'].')': '';
        $string .= ', '.$this->arWhere[$culture]['name'];
        $string .= isset($this->arWhere[$culture]['state'])? ' ['.$this->arWhere[$culture]['state']['code'].'] ': '';
        $string .= ', '.$this->arWhere[$culture]['country'];
        return $string;
    }
   
    public function getWhereBoxBasketPage($culture = 'en_US'){
        $string = '';
        //$string = $this->arWhere['code'];
        //$string .= (isset($this->arWhere['airport']) && $this->arWhere['airport'] != '')? ' ('.$this->arWhere['airport'].')': '';
        $string .= $this->arWhere[$culture]['name'];
        $string .= ' ('.$this->arWhere['code'].')';
        $string .= isset($this->arWhere[$culture]['state'])? ' ['.$this->arWhere[$culture]['state']['code'].'] ': '';
        $string .= ', '.$this->arWhere[$culture]['country'];
        return $string;
    }
    
}
