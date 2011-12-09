<?php

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

        $filename = PlexParsing::getFullPathToFolder('flight', $filename, 'plex');
        
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

        $filename = PlexParsing::getFullPathToFolder('flight', $filename, 'plex');
        
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

        $file = PlexParsing::getFullPathToFolder('hotel', $filename, 'plex');

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

    /**
     * Function to return the appropriate path depending on the type of search (hotel, flight ....)
     * @param <type> $type
     * @param <type> $filename
     *
     * @return string
     */
    public static function getFullPathToFolder($type, $filename, $file = ''){

        $path = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.
        $type.DIRECTORY_SEPARATOR.$filename.
        DIRECTORY_SEPARATOR;

        switch ($file) {
            case 'plex':
                $file = 'plexResponse.plex';
                break;

            case 'raw':
                $file = 'plexResponse.raw';
                break;

            case 'xml':
                $file = 'plexResponse.xml';
                break;

            case 'filters':
                $file = 'plexResponse.filters';
                break;

            case 'markers':
                $file = 'plexResponse.markers';
                break;


            default:
                $file = null;
                break;
        }

        $path .= $file;

        

        if(!file_exists($path)){
            throw new Exception('PlexParsing getFullPathToFolder function. File not exist: '.$path , 500);
        }

        return $path;

    }


    public static function getBookingData($bookingId){

        
        $filename = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'booking-'.$bookingId.'.plex';

        if(file_exists($filename)){
            $content = file_get_contents($filename);
        }else{
            throw new Exception($bookingId.' file not found in PlexParsing getBookingData function');
        }

        return unserialize($content);

    }

    /**
     * Rewrite the filename string / Remove sensitive info to return only the path of the file from the cache array
     * Used in sfErrorLogger, saved in db filename = /cache/sf_user_folder/...
     * @param string $filename
     * @param string $level -choose which level you want the filepath (e.g. cache, sf_user_folder, flight, hotel ....)
     * @return string
     */
    public static function splitFilename($filename, $level = 'cache'){

        $values = explode('/', $filename);

        foreach ($values as $key=>$value) {

            if($value != 'cache'){
                unset($values[$key]);
                //break;
                //echo $value;
                
            }else{
                unset($values[$key]);
                break;
            }

        }

        return implode('/', $values);

    }

}

