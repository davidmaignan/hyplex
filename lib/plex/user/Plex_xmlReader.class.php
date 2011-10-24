<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Plex_xmlReader
 *
 * @author david
 */
class Plex_xmlReader {

    //put your code here
    public $xml;

    public function __construct($url = null) {

        echo 'plex_xmlReader construct'.'<hr />';

        if (null !== $url){
            $this->load($url);
        }
    }

    public function load($url) {
        
        $this->xml = file_get_contents($url);

        $xr = new XMLReader();
        $xr->XML($this->xml);

        $i=0;

        while ($xr->read()) {

            if (XMLReader::ELEMENT == $xr->nodeType) {

                switch ($xr->localName) {

                    case 'HotelInfo':
                        $this->_getHotel($xr);
                }
            }
        }
    }

    
    protected function _getHotel($xr){

        $hotelSimple = new HotelSimpleObj();
        while($xr->read()){

            if (XMLReader::ELEMENT == $xr->nodeType){

                switch ( $xr->localName){

                    case 'RoomResponses':
                        $this->_getRooms($xr);
                        exit;

                        break;

                    default:
                        //echo $xr->localName.': '.$xr->depth;
                        //echo ' | ';
                        //$xr->read();
                        //echo $xr->value;

                        break;



                }

                //echo "<br />";
                
            }
            

        } 

    }

    protected function _getRooms($xr){


        while($xr->read()){

            if (XMLReader::ELEMENT == $xr->nodeType){

                echo $xr->localName.': '.$xr->depth;
                echo ' | ';
                $xr->read();
                echo $xr->value;
                echo "<br />";
                

            }
            
        }


         exit;
    }

    


}

