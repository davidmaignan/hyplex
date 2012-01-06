<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexSearchHotelStat
 *
 * @author david
 */
class PlexSearchHotelStat implements PlexSearchStatInterface {

    private $arWhere = array();

    public function  __construct() {
        
    }

    public function  parseData($data) {
        


    }

    public function addWhere($value){

        if(array_key_exists($value, $this->arWhere)){

            $this->arWhere[$value]++;

        }else{
            $this->arWhere[$value] = 1;
        }

    }
	
    
    public function getCodes(){
    	return array();
    }
}

