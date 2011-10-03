<?php

/**
 * Description of Utils
 *
 * @author david
 */

class Utils {

    static $language = array('en_US' => 'english', 'fr_FR' => 'francais', 'zh_CN' => '中文');
    static $languageBackend = array('en' => 'english', 'fr' => 'français', 'zh_CN' => '中文');


    static public function slugify($text){

        if (empty($text))
        {
            return 'n-a';
        }

        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);

        // trim and lowercase
        $text = strtolower(trim($text, '-'));

        return $text;
    }



    /*
     * Format Date: Fri, 25 Mar 2011 17:31:23 GMT to 'Y-m-d H:i:s'
     * @param $string Format expected: Date: Fri, 25 Mar 2011 17:31:23 GMT
     * @return date format 'Y-m-d H:i:s'
     */
    
    static public function formatDateResponse($string) {
        $string = trim(substr($string, strpos($string, ' '), - strpos($string, ' ') + 1));
        $date = new DateTime($string);
        return $date->format('Y-m-d H:i:s');
    }

    /*
     * Retrieve prices from slider
     * @param $string Format expected: $750 to $1750
     * @return array(price1, price2)
     */

    static public function retrievePriceFromSlider($string) {
        $data = explode('$', $string);
        unset($data[0]);
        $data[1] = substr($data[1], 0, -strpos($data[1], ' '));
        return array((int) $data[1], (int) $data[2]);
    }

    /*
     * Retrieve time from slider
     * @param $string format expected: 6:00 - 21:00
     * @return array(array('hour'=>value, 'min'=>value),array('hour'=>value, 'min'=>value))
     */

    static public function retrieveTimeFromSlider($string) {
        //Format expected: 6:00 - 21:00
        $data = explode('-', $string);
        $d = explode(':', trim($data[0]));
        $d2 = explode(':', trim($data[1]));
        $keys = array('hour', 'min');

        return array(array_combine($keys, $d), array_combine($keys, $d2));
    }

    /*
     * Return array time from a string
     * @param $string format expected 2011-04-01 06:30
     * @return array('hour'=>value, 'min'=>value)
     */

    static public function getArrayTimeFromSegments($string) {
        //2011-04-01 06:30 -> // mktime is as follows (hour, minute, second, month, day, year)

        $data = explode(' ', $string);
        $d = explode(':', $data[1]);
        $keys = array('hour', 'min');
        return array_combine($keys, $d);
    }

    /*
     * Return array date from a string
     * @param $string format expected 2011-04-01 06:30
     * @return array('year'=>value, 'month'=>value,'day'=>value)
     */

    static public function getArrayDateFromSegments($string) {
        //2011-04-01 06:30 -> // mktime is as follows (hour, minute, second, month, day, year)
        $data = explode(' ', $string);
        $d = explode('-', $data[0]);
        $keys = array('year', 'month', 'day');

        return array_combine($keys, $d);
    }
    
    /*
     * Compare 2 times
     * @param time1 array('hour','min')
     * @param time2 array('hour','min')
     * @return bool true if time2 > time1
     */

    static public function comparingTimes($time1, $time2) {
        $time1 = mktime($time1['hour'], $time1['min']);
        $time2 = mktime($time2['hour'], $time2['min']);
        return ($time1 > $time2) ? false : true;
    }

    /*
     * Get number of minutes between 2 dates
     * @param time1 format expected: 2011-04-01 06:30
     * @param time2 format expected: 2011-04-01 08:26
     * @return bool true if time2 > time1
     */

    static public function getMinutesBetweenDates($time1, $time2) {
        //2011-04-01 06:30
        //2011-04-01 08:26

        $date1 = self::getArrayDateFromSegments($time1);
        //print_r($date1);
        $hour1 = self::getArrayTimeFromSegments($time1);
        $date2 = self::getArrayDateFromSegments($time2);
        $hour2 = self::getArrayTimeFromSegments($time2);

        // mktime is as follows (hour, minute, second, month, day, year)
        $time1 = mktime($hour1['hour'], $hour1['min'], 0, $date1['month'], $date1['day'], $date1['year']);
        $time2 = mktime($hour2['hour'], $hour2['min'], 0, $date2['month'], $date2['day'], $date2['year']);

        $diff = ($time2 - $time1) / 60;

        return floor($diff);
    }

    /*
     * Retreive previous searches and add new ones to sfUser prevSearch attribute
     * @param sfUser
     *
     * Open file request, create an array('date','file','parameters'=>'type search')
     * compare with existing array in prevSearch attribute
     * add new ones
     *
     * @return nothing
     */

    static public function retreivePrevSearch(sfUser $user) {

        $value = $user->getAttribute('prevSearch');
        $user->setAttribute('prevSearch', $value++);

        $searches = array();

        $filename = sfConfig::get('sf_user_folder') . '/request';
        if (file_exists($filename)) {
            $handle = fopen($filename, 'r');
            while (!feof($handle)) {

                $content = explode('|', fgets($handle));

                if (count($content) > 1) {
                    $tmp = array();
                    $tmp['date'] = $content[0];
                    $tmp['file'] = $content[1];
                    $tmp['parameters'] = $content[2];
                    array_push($searches, $tmp);
                }
            }
            fclose($handle);
        }

        //Add to the previous one
        $prevSear = $user->getAttribute('prevSearch');
        
        //var_dump($prevSear);
        if (is_array($prevSear)) {
            $searches = array_merge($prevSear, $searches);
        }
        $user->setAttribute('prevSearch', $searches);

        sfContext::getInstance()->getLogger()->alert('retreivePrevSearch called');
    }


    /*
     * Retreive parameters $paramFactory
     * @param $filename
     * Open file request, look for the lines where it is saved and unserialize the object
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

    /*
     * Create an array for 24 hours
     * @return array with 24 keys and 24:00 values
     */

    static public function generateTimeArray() {
        $keys = range(0, 24);
        $values = range(0, 24);

        foreach ($values as &$value) {
            $value = $value . ':00';
        }

        return array_combine($keys, $values);
    }

    /*
     * Calculate the number of days between 2 dates
     * Loop that check day by day and substract (or add) until it reach the same date
     * @param $date1, $date2 prefered format YYYY-MM-DD but any format should work
     * @return format_number_choice to handle 1 and more day (plural and multilangual version)
     * see I18n file for other languages
     */

    static public function calculateNbrDays($date1, $date2) {

        $sStartDate = date("Y-m-d", strtotime($date1));
        $sEndDate = date("Y-m-d", strtotime($date2));

        $aDays = array();

        // Start the variable off with the start date
        // $aDays[] = $sStartDate;
        // Set a 'temp' variable, sCurrentDate, with the start date - before beginning the loop
        $sCurrentDate = $sStartDate;

        if ($sCurrentDate < $sEndDate) {

            // While the current date is less than the end date
            while ($sCurrentDate < $sEndDate) {
                // Add a day to the current date
                $sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));

                // Add this new day to the aDays array
                $aDays[] = $sCurrentDate;
            }

            // Once the loop has finished, return the array of days.
            if (!empty($aDays))
                return format_number_choice(
                        '[1] (+1day)|(1,+Inf] (+%count%day)',
                        array('%count%' => count($aDays) . '</strong>'),
                        count($aDays)
                );
        }else {

            while ($sEndDate < $sCurrentDate) {
                // Add a day to the current date
                $sCurrentDate = date("Y-m-d", strtotime("-1 day", strtotime($sCurrentDate)));

                // Add this new day to the aDays array
                $aDays[] = $sCurrentDate;
            }

            // Once the loop has finished, return the array of days.
            if (!empty($aDays))
                return format_number_choice(
                        '[1] (-1day)|(-1,-Inf] (+%count%day)',
                        array('%count%' => count($aDays) . '</strong>'),
                        count($aDays)
                );
        }
    }

    /*
     * Get time from a number of minutes
     * @param $minutes int
     * @return paramFactory object containing the parameters
     */
    
    static public function getHourMinutes($minutes) {
        if ($minutes > 60) {
            $hours = floor($minutes / 60);
            $minutes = $minutes - ($hours * 60);
            $minutes = ($minutes < 10) ? '0' . $minutes : $minutes;
            //return format_date($hours.':'.$minutes, 'q');
            return $hours . __('h ') . $minutes . __('min');
        } else {
            //return format_date('0:'.$minutes, 'q');
            return $minutes . __('min');
        }
    }


    /*
     * Get Icon Airline
     * @param $key a two letter code specific for each airline, $name optional with name under the icon
     * @return image if file exist or the 2 keys if no airline image
     */
    static public function getAirlineIcon($key, $name = false) {

        if($name){
            $airlines = self::createAirlineArray();
            switch ($key) {
                case 'multi':
                    $name = '<br />Multi';
                    break;

                default:
                    $name = '<br />'.$airlines[$key][0];
                    break;
            }
            
        }else{
            $name = '';
        }

        if ($key == 'multi') {
            return image_tag('airlines/MULT.gif', array('class' => 'airline border')).$name;
        } else {

            switch (true) {
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $key . '.png')):
                    return image_tag('airlines/' . $key . '.png', array('class' => 'airline border')).$name;
                    break;
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $key . '.gif')):
                    return image_tag('airlines/' . $key . '.gif', array('class' => 'airline border')).$name;
                    break;
                default:
                    return $key.$name;
                    //return image_tag('airlines/no-icon.gif', array('class' => 'airline border'));
                    break;
            }
        }
    }

    /*
     * Return for matrix link if 2 is true cause it's the cheapest price for the stop
     * @param $data array(0=>price, 1=>uniqueRefId, 2=> true or false)
     * return string
     *
     */

    static public function getMatrixAirlinePriceLink($data)
    {
        //var_dump($data);

        if($data[0] == '')
            return '';

        return ($data[2] === TRUE)?
                    "<a href='#{$data[1]}' class='matrix-anchor' >".format_currency($data[0],'USD')."</a>":
                    "<a href='#{$data[1]}' class='matrix-anchor' >".format_currency($data[0],'USD')."</a>";
    }

    /**
     * Create a global array for the airlines
     * Check if global array exist if not check if cache file airlines.yml exits
     * if not query the db to create the file and then the global array
     */
    static public function createAirlineArray() {

        //Avoid recreating this array for each sergment save it in global array to fast access
        if(isset($GLOBALS['airlines'])){
            return $GLOBALS['airlines'];
            //echo 'here';
        }

        $fileAirline = sfConfig::get('sf_data_dir') . '/airline/airlines.yml';
        if (file_exists($fileAirline)) {

            $airlines = sfYaml::load($fileAirline);
            $GLOBALS['airlines'] = $airlines;
            return $airlines;
            
        } else {
            //Create file, query db
            $airlines = Doctrine::getTable('Airline')->findAll()->toArray();
            $data = '';

            foreach ($airlines as $airline) {
                $data .= $airline['tag'] . ': [ ' . $airline['name'] . ", ".$airline['slug'] ."]\r\n";
            }
            
            file_put_contents($fileAirline, $data);
            chmod($fileAirline, 0777);

            $airlines = sfYaml::load($fileAirline);
            if (is_null($airlines)) {
                $airlines = array();
            }

            $GLOBALS['airlines'] = $airlines;
            return $airlines;
        }
    }


    static public function createHotelchainArray(){

        if(isset($GLOBALS['hotelchain'])){
            return $GLOBALS['hotelchain'];
        }

        $fileHotelChains = sfConfig::get('sf_data_dir') . '/hotel/hotelChains.yml';

        if (file_exists($fileHotelChains)) {

            $hotelChains = sfYaml::load($fileHotelChains);
            $GLOBALS['hotelchain'] = $hotelChains;
            return $hotelChains;

        } else {
            //Create file, query db
            $hotelChains = Doctrine::getTable('HotelChain')->findAll()->toArray();
            $data = '';

            //var_dump($hotelChains);

            foreach ($hotelChains as $chain) {
                $data .= $chain['tag'] . ': [ ' . $chain['name'] . ", ".$chain['slug'] ."]\r\n";
            }

            file_put_contents($fileHotelChains, $data);
            chmod($fileHotelChains, 0777);
            

            $hotelChains = sfYaml::load($fileHotelChains);
            if (is_null($hotelChains)) {
                $hotelChains = array();
            }

            $GLOBALS['hotelchain'] = $hotelChains;
            return $hotelChains;
        }


    }


    /*
     * Create a javascript file with an array containing the airport info for the autocomplete
     * @param $culture one of the available culture
     *
     * @return nothing
     *
     */

    static public function createAirportJavascriptFile($culture, $filename)
    {
        Doctrine::getConnectionByTableName('City');
        
        $airports = Doctrine::getTable('City')->getAllByCulture($culture);

        $string = 'var airports = [';
        foreach($airports as $airport)
        {
            $string .= '{';
            $string .= 'airportCode: "'. $airport['code'] .'", ';
            $string .= 'airportName: "'. $airport['airport'] .'", ';
            $string .= 'cityCode: "'. $airport['code'] .'", ';
            $string .= 'cityName: "'. $airport['city'] .'", ';
            $string .= 'country: "'. $airport['country'] .'", ';
            $string .= 'state: "'. $airport['state'] .'"}';
            $string .= ',';
        }
        $string .= '];';

        file_put_contents($filename, $string);

        /*
        $airports = Doctrine::getTable('Airport')->getAllByCulture($culture);
        $string = 'var airports = [';
        foreach($airports as $airport)
        {
            $string .= '{';
            $string .= 'airportCode: "'. $airport['code'] .'", ';
            $string .= 'airportName: "'. $airport['Translation'][$culture]['name'] .'", ';
            $string .= 'cityCode: "'. $airport['city_code'] .'", ';
            $string .= 'cityName: "'. $airport['Translation'][$culture]['city_name'] .'", ';
            $string .= 'country: "'. $airport['Translation'][$culture]['country'] .'", ';
            $string .= 'state: "'. $airport['state'] .'", ';
            $string .= 'region: "'. $airport['Translation'][$culture]['region'] .'"}';
            $string .= ',';
        }
        $string .= '];';

        file_put_contents($filename, $string);
         *
         *
         */

    }

    static public function createAirlineJavascriptFile($file){


        $airlines = sfYaml::load(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'airline'.DIRECTORY_SEPARATOR.'airlines.yml');

        //var_dump($airlines);

        //exit;

        $string = 'var airlines = [';
        foreach($airlines as $key=>$airline)
        {
            $string .= '{';
            $string .= 'value: "'. $key .'", ';
            $string .= 'label: "'. $airline[0] .'", ';
            $string .= 'desc: "'. $airline[0] .'", ';
            $string .= 'icon: "'. $airline[0] .'", ';
            $string .= 'country: "'. $airline[0] .'", ';
            $string .= 'state: "'. $airline[0] .'", ';
            $string .= 'region: "'. $airline[0] .'"}';
            $string .= ',';
        }

        $string .= '];';

        //echo $string;
        //exit;

        file_put_contents($file, $string);
        chmod($file, 0777);
    }

    /*
     * Create a global array for the airlines
     * Check if global array exist if not check if cache file airlines.yml exits
     * if not query the db to create the file and then the global array
     * @return image if file exist or the 2 keys if no airline image
     */

    static public function createAirportArray(){
        
    }

    /*
     * Get User infos from the request
     * @param $request sfWebRequest
     * @return array(ip,culture,userAgent,date,folder)
     */

    static function retreiveUserInfos($request) {
        $path = $request->getHttpHeader('info', 'path');
        $path = explode('/', $path);
        $userCulture = $path[1];

        $tmp = array();
        $tmp['ip'] = $request->getHttpHeader('addr', 'remote');
        $tmp['culture'] = $userCulture;
        $tmp['userAgent'] = $request->getHttpHeader('user-Agent');
        $tmp['date'] = $request->getHttpHeader('Date');
        $tmp['folder'] = $request->getCookie('hypertech_user_folder');

        return $tmp;
    }

    /*
     * Get header from plex response
     * @param $filename raw response from Plex
     * @return array(code, date, server, raw)
     */
    static function getHeader($filename) {

        //Check the header response and choose the action depending on the status of the response.
        //Temp ---------------------------------
        $filename = sfConfig::get('sf_user_folder') . '/' . $filename;
        $response = file_get_contents($filename);
        //--------------------------------------
        //$response = $this->response;
        $pattern = '#charset=utf-8#';
        $responseSplit = preg_split($pattern, $response);

        //$header = $responseSplit[0].'charset=utf-8';
        $header = preg_split('#(\r\n|\n)#', $responseSplit[0]);

        $tmp = array();
        $tmp['code'] = explode(' ', $header[0]);
        $tmp['date'] = Utils::formatDateResponse($header[1]);
        $tmp['server'] = trim(substr($header[2], strpos($header[2], ' ') + 1));
        $tmp['raw'] = $responseSplit[0];
        return $tmp;
    }

    static function toBold(&$ar, $data) {

        foreach($ar as &$value){
            $value = str_replace($data, "<b>$data</b>", $value);
        }

        foreach($ar as &$value){
            $value = str_replace(ucfirst($data), "<b>".ucfirst($data)."</b>", $value);
        }

    }
    
    static function toBoldString(&$string, $data){

        //$data = ucfirst($data);
        
        $value = str_replace($data, "<b>$data</b>", $string);
        $value = str_replace(ucfirst($data), "<b>".ucfirst($data)."</b>", $value);

        return $value;
        
        
    }


    static function lcfirst($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }

    /*
     * Function to return green check mark on yes and red cross on No
     */
    static function getIconCheckCross($value){
        $string = ($value == 'Yes')? '24-em-check.png':'24-em-cross.png';
        return image_tag('icons/'.$string,array('alt'=>$value));
    }


}

?>
