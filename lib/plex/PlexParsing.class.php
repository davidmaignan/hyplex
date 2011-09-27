<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlexParsing
 *
 * @author david
 */
class PlexParsing {



    /**
     * Retreive parameters $paramFactory
     * @param $filename
     * 
     * @return paramFactory object containing the parameters
     */
    static public function retreiveParameters($filename) {
        $array = explode('/', $filename);

        if(!file_exists(sfConfig::get('sf_user_folder') . '/request')){
            throw new Exception('No file request exist in the user folder: '.sfConfig::get('sf_user_folder'));
        }

        $handle = fopen(sfConfig::get('sf_user_folder') . '/request', 'rb');
        while (!feof($handle)) {
            $content = fgets($handle);
            $value = strpos($content, $filename);

            if (is_int($value)) {
                $data = $content;
            }
        }
        fclose($handle);

        $data = explode('|', $data);
        $data = unserialize($data[3]);

        //var_dump($data);
        //break;

        return $data;
    }



    /**
     * Find one flight object in the provided file
     *
     * @param filename: the file to search in
     *
     * @return an array of flight objects 
     */
    static function retreiveFlights($filename){

        $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.$filename;
        
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
        
        return $ar;
        
    }

    /**
     * Find one flight object in the provided file
     *
     * @param filename: the file to search in
     * @param uniqueReferenceId: the flight reference
     *
     * @return a flight object or null if nothing is found
     */
    static function retreiveFlight($filename, $uniqueReferenceId){

        $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.$filename.'.plex';

        if ($filename === null || !file_exists($filename)) {
            throw new Exception('You must provide a file in the FilterClass');
        }

        $content = file_get_contents($filename);        

        while ($join = strpos($content, '---')) {
            $obj = unserialize(trim(substr($content, 0, $join)));

            if($obj->UniqueReferenceId == $uniqueReferenceId){
                return $obj;
            }

            $content = trim(substr($content, $join + 3));
            //array_push($ar, $obj);
        }

        return null; //No hotel found

    }

    /**
     * Find one hotel object in the provided file
     *
     * @param filename: the file to search in
     * @param slug: the hotel name slugify
     *
     * @return a hotel object or null if nothing is found
     */
    static function retreiveHotel($filename, $slug){

        $file = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'hotel'.DIRECTORY_SEPARATOR.$filename.'.plex';

        $handle = fopen($file , 'r');
        while(!feof($handle)){

            $content = fgets($handle);
            if(strpos($content , '---') === false){
                $hotel = unserialize($content);
                if(Utils::slugify($hotel->name) == $slug){
                    return $hotel;
                }
            }
        }

        return null; //No hotel found
    }

    static function moveSearchToTheEnd(sfUser $user, $filename){

        $prevSearches = $user->getAttribute('prevSearch');

        //var_dump($prevSearches);
        //var_dump($filename);

        foreach($prevSearches as $key=>$prevSearch){

            if($prevSearch['filename'] == $filename){

                $tmp = $prevSearch;
                unset($prevSearches[$key]);
                break;

            }

        }

        array_push($prevSearches, $tmp);
        
        $user->setAttribute('prevSearch', $prevSearches);

    }


    /**
     *
     * @param <string> $filename
     * @param <string> $type
     * @param <plexParametersObject> $parameters
     */
    static function addNewRequest($filename, $type, $parameters){

        $date = date('Y-m-d H:i:s');

        $file = sfConfig::get('sf_user_folder') . '/request';
        $handle = fopen($file, 'ab');
        fwrite($handle, $date . '|' . $filename . '|' . $type . '|' . serialize($parameters)."\r\n");
        fclose($handle);
        chmod($file, 0777);

        $user = sfContext::getInstance()->getUser();

        $tmp = array();
        $tmp['date'] = $date;
        $tmp['filename'] = $filename;
        $tmp['type'] = substr($filename , 0, strpos($filename, '-'));

        $searches = $user->getAttribute('prevSearch');

        if(is_array($searches)){
            array_push($searches, $tmp);
        }else{
            $searches = array($tmp);
        }

        $user->setAttribute('prevSearch', $searches);

    }


    static function retreivePrevSearches($type = false){

        $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'request';

        if(!file_exists($filename)){
            return null;
        }

        $searches = array();

        $handle = fopen($filename, 'r');
            while (!feof($handle)) {

                $content = explode('|', fgets($handle));

                if (count($content) > 1) {
                    $tmp = array();
                    $tmp['date'] = $content[0];
                    $tmp['file'] = $content[1];
                    $tmp['type'] = $content[2];
                    $tmp['parameters'] = unserialize($content[3]);


                    if($type !== false && preg_match('#'.$type.'#', $tmp['type'])> 0){
                        array_push($searches, $tmp);
                    }else if($type === false){
                        array_push($searches, $tmp);
                    }
                    
                }
            }
        fclose($handle);


        //Filter by type
        
        return array_reverse($searches);


    }

}

