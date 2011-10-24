<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HotelGenericObj
 *
 * @author david
 */
class HotelGenericObj {

    private $filename;

    //public
    public $id;
    public $name;
    public $hotelChain;
    public $starRating;
    public $location;
    public $displayPriority;
    public $isOurPick;
    public $baseImageLink;
    public $propertyType;
    public $hotelAddress = array();
    public $hotelFacilities = array();
    public $hotelFullFacilities = array();
    public $arRooms = array();
    public $arRoomsType = array();
    public $arMinMaxPrice = array();
    public $minPrice;
    public $maxPrice;
    public $numRooms = array();
    public $arCoordinates = array();
    public $hotelDescription;
    public $hotelFullDescription;
    
    public function getId(){
        return $this->id;
    }

    public function getAddress(){

        $string = $this->hotelAddress['Street1'];
        $string .= ($this->hotelAddress['Street2'])? ", {$this->hotelAddress['Street2']}": '';

        return $string;

    }


    /**
     * Return address full or half full
     * @param boolean if true return with street otherwise only city, state, country
     * @return string
     */
    public function getFullAddress($bool = true){

        $string = '';

        if($bool){
            $string .= $this->hotelAddress['Street1'].' ';
            $string .= ($this->hotelAddress['Street2'])? ", {$this->hotelAddress['Street2']} ": ', ';
        }

        $string .= $this->hotelAddress['City'];
        $string .= ($this->hotelAddress['StateProvince'])? " [{$this->hotelAddress['StateProvince']}] ": '';

        //Add postcode if full address
        if($bool){
            $string .= ' - '.$this->hotelAddress['PostalCode'];
        }
        
        $string .= ', '.$this->hotelAddress['Country'];

        return $string;

    }





    public static function getStarRating($starRating){

        if(strpos($starRating, 'star')>0){
            return image_tag('icons/'.$starRating.'.png', array('alt'=>$starRating.' stars'));
        }else{
            return image_tag('icons/'.$starRating.'stars.png', array('alt'=>$starRating.' stars'));
        }

        //return image_tag('icons/'.$this->starRating.'.png', array('alt'=>$this->starRating.' stars'));

    }

    public function getFacilities(){

        $arImages = array('Parking'=>'parking','Restaurant'=>'restaurant','Internet Access'=>'internet','Pool'=>'pool','Fitness Center'=>'gym');

        $string = "";
        foreach ($this->hotelFacilities as $key => $value) {
            $val = ($value == 'No')? 'off': 'on';
            $string .= image_tag('icons/'.$arImages[$key].'_'.$val.'.png', array('alt'=>'No '.$key, 'class'=>'facilities-icon'));
        }
        return $string;

    }

    public function getName(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getBaseLinkImage(){
        $filename = strrpos($this->baseImageLink, DIRECTORY_SEPARATOR);
        return '../uploads/'.
                DIRECTORY_SEPARATOR.'hotels'.
                DIRECTORY_SEPARATOR.'baseImage'.DIRECTORY_SEPARATOR.substr($this->baseImageLink, $filename+1);
    }




    public static function formatDescriptionIntoList($string){
        /*
        echo '<hr/>';
        echo $string;
        echo '<hr/>';
        echo htmlentities($string);
        echo '<hr/>';
        echo $string[23];
        echo '<hr />';
        echo strpos($string, '&lt;br&gt;');
        echo "<hr />";
        $pattern = '#(&lt;br&gt;)#';
        echo preg_match($pattern, $string);
        echo preg_match_all($pattern, $string, $matchesarray);
        var_dump($matchesarray);

        $string = str_replace('&lt;br&gt;', '</li><li>', $string);
        echo htmlentities($string);

        break;
        */
        $stringFinal = '<ul class="hotel-desc-list"><li>';
        $string = str_replace('&lt;br&gt;', '</li><li>', $string);
        $stringFinal .= $string;
        $stringFinal .= '</li></ul>';

        return $stringFinal;



    }

    public function getParameters(){

        return PlexParsing::retreiveParameters($this->filename);

    }


}

