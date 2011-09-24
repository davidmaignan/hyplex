<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RoomTypeObj
 *
 * @author david
 */
class RoomTypeObj {


    public  $type;
    public  $description;
    private $arSimpleKeys = array('RoomType', 'RoomDescription');
    public  $arRates = array();


    public function  __construct($data, $roomNumber) {

        foreach ($data->children() as $key => $value) {

            switch ($key) {
                   case in_array($key, $this->arSimpleKeys):
                           $keyModified = $this->renameXMLTag($key);
                           $this->$keyModified = trim((string)$value);
                       break;

                   case('RateTypeInfos'):

                       foreach($value->{'RateTypeInfo'} as $v){

                           $this->arRates[(string)$v->{'RateType'}] = $this->buildArray($v, $roomNumber);

                           //array_push($this->arRates, $this->buildArray($v));
                       }


                   break;


                   default:
                       break;
               }
            

        }

        unset($this->arSimpleKeys);

    }

    

    protected function renameXMLTag($name){

        if(strpos($name, 'Room')>-1){
            $name = substr($name , 4);
        }

        return Utils::lcfirst($name);
    }

    private function buildArray($data, $roomNumber){
       
        $tmp = array();

        $tmp['RateDescription'] = (string)$data->{'RateDescription'};

        $tmp['termsConditionId'];

        $tmp2 = array();
        foreach ($data->children() as $key => $value) {

            $tmp2[(string)$key] = Utils::lcfirst((string)$value);

            if((string)$key == 'UniqueReferenceId'){
                $tmp['termsConditionId'] = (string)$value;
            }
        }

        unset($tmp2['RateType']);
        unset($tmp2['RateDescription']);

        $tmp[$roomNumber] = $tmp2;

        return $tmp;


    }

    public function addRoom($data, $roomNumber){
        //print_r($this);
        //echo "<hr />";
        //print_r($data);
        //break;

        foreach ($data->{'RateTypeInfos'}->children() as $value) {

            //if rate already in arRates add roomNumber and info price, unique id
            $rateType = (string)$value->{'RateType'};
            //var_dump($rateType);
            if(array_key_exists($rateType, $this->arRates)){
                
                $this->arRates[$rateType][$roomNumber] = $this->createArrayRoomInfo($value);

            }else{

                $this->arRates[(string)$value->{'RateType'}] = $this->buildArray($value, $roomNumber);
            }


        }

        //print_r($this);

        //break;
        
    }

    protected function createArrayRoomInfo($data){
        
        //var_dump($data);

        $tmp = array();
        foreach ($data->children() as $key => $value) {

            $tmp[(string)$key] = Utils::lcfirst((string)$value);
        }

        unset($tmp['RateType']);
        unset($tmp['RateDescription']);
        
        return $tmp;
        
        //break;
    }

    public function filterRates($filterPrices){

        foreach($this->arRates as $key=>$rates){

            foreach ($rates as $k=>$value) {

                if((is_array($value) && $value['AvgPricePerNight'] > $filterPrices['max']) ||
                        (is_array($value) && $value['AvgPricePerNight'] < $filterPrices['min']))
                {
                    unset($this->arRates[$key][$k]);
                }
            }
        }

        foreach($this->arRates as $k=>$rate){
            if(count($rate) == 1){
                unset($this->arRates[$k]);
            }
        }

        if(empty($this->arRates)){
            unset($this->arRates);
        }

        

    }

    public function cleanRates($values){


        foreach($this->arRates as $key=>$rates){

            foreach ($rates as $k=>$value) {
                if(is_array($value) && !in_array($value['UniqueReferenceId'], $values))
                {
                    unset($this->arRates[$key][$k]);
                }
            }
            
        }

        foreach($this->arRates as $k=>$rate){
            if(count($rate) == 2){
                unset($this->arRates[$k]);
            }
        }

        if(empty($this->arRates)){
            unset($this->arRates);
        }


        
    }

}

