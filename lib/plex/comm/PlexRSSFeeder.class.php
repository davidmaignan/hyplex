<?php

/**
 * Description of PlexRSSFeeder
 *
 * @author david
 */
class PlexRSSFeeder {

    private $url;
    private $arItems = array();

    public function  __construct($url) {
        
        if(!$url){
            throw new Exception('You must provide a url');
        }

        $this->url = $url;
        $this->xml = simplexml_load_file($url);
        if($this->xml === false){
            return "Cannot load the datas";
        }

        $this->parseXML();

        return $this->arItems;
    }

    public function parseXML(){

        $xml = $this->xml;
        $arXML = (array)$this->xml->channel;
        
        foreach($arXML as $key=>$item){
            
            if(is_array($item)){
                
                $this->createArItems($item);
            }
        }


    }


    public function createArItems($ar){

        foreach($ar as $item){

            //print_r($item);
            

            $tmp = array();
            $tmp['title'] = (string)$item->title;
            $tmp['link'] = (string)$item->link;
            $tmp['guid'] = (string)$item->link;

            $description = substr((string)$item->description, 0, strpos((string)$item->description, '<'));

            $tmp['description'] = $description;
            $tmp['pubDate'] = (string)$item->pubDate;
            $tmp['source'] = (string)$item->source;
            $tmp2 = (array)$item->enclosure;
            $tmp2 = reset($tmp2);
            $tmp['image'] = $tmp2['url'];

           
            array_push($this->arItems, $tmp);
           
        }

    }

    public function getArItems(){
        return $this->arItems;
    }


}

