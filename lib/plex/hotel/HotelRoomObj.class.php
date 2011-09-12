<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HotelRoomObj
 *
 * @author david
 */
class HotelRoomObj {

    private $arSimpleKeys = array('RoomType', 'RoomDescription');
    public  $arRates = array();
    public  $arMinMaxPrice = array();

    public function  __construct($datas) {
           //print_r($datas);

           foreach ($datas->children() as $key=>$value) {

               switch ($key) {
                   case in_array($key, $this->arSimpleKeys):
                           $keyModified = $this->renameXMLTag($key);
                           $this->$keyModified = trim((string)$value);
                       break;

                   case('RateTypeInfos'):

                       foreach($value->{'RateTypeInfo'} as $v){
                           array_push($this->arRates, $this->buildArray($v));
                       }


                   break;


                   default:
                       break;
               }


           }
           //foreach()
           unset($this->arSimpleKeys);

           $this->arMinMaxPrice = $this->getMinMax();

    }

    private function buildArray($data){

        $tmp = array();
        foreach ($data->children() as $key => $value) {
            $tmp[(string)$key] = (string)$value;
        }

        return $tmp;


    }

    protected function renameXMLTag($name){

        if(strpos($name, 'Room')>-1){
            $name = substr($name , 4);
        }

        return Utils::lcfirst($name);
    }


    /*
     * create array arMinMaxPrice inside the arRates / will be used in the getMinMaxPrice function in HotelSimpleObj
     *
     * return array(min,max,minTotal,maxTotalL) values
     */
    protected function getMinMax(){

        $datas = $this->arRates;

        $tmp = array();

        reset($datas);
        $first = current($datas);

        $tmp['min'] = $first['AvgPricePerNight'];
        $tmp['max'] = $first['AvgPricePerNight'];

        $tmp['minTotal'] = $first['TotalPrice'];
        $tmp['maxTotal'] = $first['TotalPrice'];

        foreach($datas as $data){
            $tmp['min'] = min($data['AvgPricePerNight'], $tmp['min']);
            $tmp['max'] = max($data['AvgPricePerNight'], $tmp['max']);
            $tmp['minTotal'] = min($data['TotalPrice'], $tmp['minTotal']);
            $tmp['maxTotal'] = max($data['TotalPrice'], $tmp['maxTotal']);
        }



        return $tmp;
        
    }

    

    public function filterRates($filterPrices){

        

        foreach ($this->arRates as $key=>$value) {
            if($value['AvgPricePerNight'] > $filterPrices['max'] || $value['AvgPricePerNight'] < $filterPrices['min']){
                unset($this->arRates[$key]);
            }else{
                $this->arMinMaxPrice = $this->getMinMax();
            }

        }
        //exit;
        //var_dump($this->arRates);

        if(empty($this->arRates)){
            unset($this->arRates);
            unset($this->arSimpleKeys);
            unset($this->arMinMaxPrice);
            unset($this->type);
            unset($this->description);
        }

        //Regenerate the MinMax array
        
        
    }


}
?>
