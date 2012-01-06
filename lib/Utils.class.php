<?php

/**
 * Description of Utils
 *
 * @author david
 */
class Utils {

    static $language = array('en_US' => 'english', 'fr_FR' => 'francais', 'zh_CN' => '中文');
    static $languageBackend = array('en' => 'english', 'fr' => 'français', 'zh_CN' => '中文');
	
    /**
     * Replage non word chararacters with a -
     * @param string $text
     */
    static public function slugify($text) {

        if (empty($text)) {
            return 'n-a';
        }

        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);

        // trim and lowercase
        $text = strtolower(trim($text, '-'));

        return $text;
    }

    /**
     * Format Date: Fri, 25 Mar 2011 17:31:23 GMT to 'Y-m-d H:i:s'
     * @param $string Format expected: Date: Fri, 25 Mar 2011 17:31:23 GMT
     * @return date format 'Y-m-d H:i:s'
     */
    static public function formatDateResponse($string) {
        $string = trim(substr($string, strpos($string, ' '), - strpos($string, ' ') + 1));
        $date = new DateTime($string);
        return $date->format('Y-m-d H:i:s');
    }

    /**
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

    /**
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

    /**
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

    /**
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

    /**
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

    /**
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

    /**
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

    /**
     * Retreive parameters $paramFactory
     * @param $filename
     * Open file request, look for the lines where it is saved and unserialize the object
     * @return paramFactory object containing the parameters
     */
    static public function retreiveParameters($filename) {
        $array = explode('/', $filename);

        if (!file_exists(sfConfig::get('sf_user_folder') . '/request')) {
            throw new Exception('No file request exist in the user folder: ' . sfConfig::get('sf_user_folder'));
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

    /**
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

    /**
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

    /**
     * Get Icon Airline
     * @param $key a two letter code specific for each airline, $name optional with name under the icon
     * @return image if file exist or the 2 keys if no airline image
     */
    static public function getAirlineIcon($key, $name = false) {

        if ($name) {
            $airlines = self::createAirlineArray();
            switch ($key) {
                case 'multi':
                    $name = '<br />Multi';
                    break;

                default:
                    $name = '<br />' . $airlines[$key][0];
                    break;
            }
        } else {
            $name = '';
        }

        if ($key == 'multi') {
            return image_tag('airlines/MULT.gif', array('class' => 'airline border')) . $name;
        } else {

            switch (true) {
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $key . '.png')):
                    return image_tag('airlines/' . $key . '.png', array('class' => 'airline border')) . $name;
                    break;
                case (file_exists(sfConfig::get('sf_web_dir') . '/images/airlines/' . $key . '.gif')):
                    return image_tag('airlines/' . $key . '.gif', array('class' => 'airline border')) . $name;
                    break;
                default:
                    return $key . $name;
                    //return image_tag('airlines/no-icon.gif', array('class' => 'airline border'));
                    break;
            }
        }
    }


    static public function getAirlineCode($value){

        $airlines = Utils::createAirlineArray();

        foreach ($airlines as $key=>$airline) {

            if($airline[0] == $value){
                return $key;
            }   
        }

        return null;
    }



    /**
     * Return for matrix link if 2 is true cause it's the cheapest price for the stop
     * @param $data array(0=>price, 1=>uniqueRefId, 2=> true or false)
     * return string
     *
     */
    static public function getMatrixAirlinePriceLink($data) {
        //var_dump($data);

        if ($data[0] == '')
            return '';

        return ($data[2] === TRUE) ?
                "<a href='#{$data[1]}' class='matrix-anchor' >" . format_currency($data[0], 'USD') . "</a>" :
                "<a href='#{$data[1]}' class='matrix-anchor' >" . format_currency($data[0], 'USD') . "</a>";
    }

    /**
     * Create a global array for the airlines
     * Check if global array exist if not check if cache file airlines.yml exits
     * if not query the db to create the file and then the global array
     */
    static public function createAirlineArray() {

        //Avoid recreating this array for each sergment save it in global array to fast access
        if (isset($GLOBALS['airlines'])) {
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
                $data .= $airline['tag'] . ': [ ' . $airline['name'] . ", " . $airline['slug'] . "]\r\n";
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
	
    /**
     * Create a global array for meal preference
     * @param string $culture
     */
    static public function createMealPreferenceArray($culture = 'en_US'){


        if(isset($GLOBALS['mealPreference'])){
            return $GLOBALS['mealPreference'];
        }

        $file = sfConfig::get('sf_data_dir') . '/airline/mealPreference.yml';
        $meals = sfYaml::load($file);
        $GLOBALS['mealPreference'] = $meals[$culture];
        return $meals[$culture];
        
    }
	/**
	 * Create a global array for special services
	 * @param string $culture
	 */
    static public function createSpecialServicesArray($culture = 'en_US'){


        if(isset($GLOBALS['specialServices'])){
            return $GLOBALS['specialServices'];
        }

        $file = sfConfig::get('sf_data_dir') . '/airline/specialServices.yml';
        $array = sfYaml::load($file);
        $GLOBALS['specialServices'] = $array[$culture];
        return $array[$culture];

    }
	
    /**
     * Create a global array for hotel chains
     */
    static public function createHotelchainArray() {

        if (isset($GLOBALS['hotelchain'])) {
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
                $data .= $chain['tag'] . ': [ ' . $chain['name'] . ", " . $chain['slug'] . "]\r\n";
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

    /**
     * Create a javascript file with an array containing the airport info for the autocomplete
     * @param string $culture one of the available culture
     */
    static public function createAirportJavascriptFile($culture, $filename) {
        Doctrine::getConnectionByTableName('City');

        $airports = Doctrine::getTable('City')->getAllByCulture($culture);

        $string = 'var airports = [';
        foreach ($airports as $airport) {
            $string .= '{';
            $string .= 'airportCode: "' . $airport['code'] . '", ';
            $string .= 'airportName: "' . $airport['airport'] . '", ';
            $string .= 'cityCode: "' . $airport['code'] . '", ';
            $string .= 'cityName: "' . $airport['city'] . '", ';
            $string .= 'country: "' . $airport['country'] . '", ';
            $string .= 'state: "' . $airport['state'] . '"}';
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
	
    /**
     * Create javascript array and a file to contains the airlines 
     * @param string $file path for a file to be created
     */
    static public function createAirlineJavascriptFile($file) {

        $airlines = sfYaml::load(sfConfig::get('sf_data_dir') . DIRECTORY_SEPARATOR . 'airline' . DIRECTORY_SEPARATOR . 'airlines.yml');

        //var_dump($airlines);
        //exit;

        $string = 'var airlines = [';
        foreach ($airlines as $key => $airline) {
            $string .= '{';
            $string .= 'value: "' . $key . '", ';
            $string .= 'label: "' . $airline[0] . '", ';
            $string .= 'desc: "' . $airline[0] . '", ';
            $string .= 'icon: "' . $airline[0] . '", ';
            $string .= 'country: "' . $airline[0] . '", ';
            $string .= 'state: "' . $airline[0] . '", ';
            $string .= 'region: "' . $airline[0] . '"}';
            $string .= ',';
        }

        $string .= '];';

        //echo $string;
        //exit;

        file_put_contents($file, $string);
        chmod($file, 0777);
    }

    /**
     * Create a global array for the airlines
     * Check if global array exist if not check if cache file airlines.yml exits
     * if not query the db to create the file and then the global array
     * @return image if file exist or the 2 keys if no airline image
     */
    static public function createAirportArray() {
        
    }

    /**
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

    /**
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

        foreach ($ar as &$value) {
            $value = str_replace($data, "<b>$data</b>", $value);
        }

        foreach ($ar as &$value) {
            $value = str_replace(ucfirst($data), "<b>" . ucfirst($data) . "</b>", $value);
        }
    }

    static function toBoldString(&$string, $data) {

        //$data = ucfirst($data);

        $value = str_replace($data, "<b>$data</b>", $string);
        $value = str_replace(ucfirst($data), "<b>" . ucfirst($data) . "</b>", $value);

        return $value;
    }

    static function lcfirst($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }

    /**
     * Function to return green check mark on yes and red cross on No
     */
    static function getIconCheckCross($value) {
        $string = ($value == 'Yes') ? '24-em-check.png' : '24-em-cross.png';
        return image_tag('icons/' . $string, array('alt' => $value));
    }
	
    /**
     * Check credit card number
     * @param $cardnumber
     * @param $cardname
     * @param $errornumber
     * @param $errortext
     */
    static function checkCreditCard($cardnumber, $cardname, &$errornumber, &$errortext) {

        // Define the cards we support. You may add additional card types.
        //  Name:      As in the selection box of the form - must be same as user's
        //  Length:    List of possible valid lengths of the card number for the card
        //  prefixes:  List of possible prefixes for the card
        //  checkdigit Boolean to say whether there is a check digit
        // Don't forget - all but the last array definition needs a comma separator!

        $cards = array(array('name' => 'American Express',
                'length' => '15',
                'prefixes' => '34,37',
                'checkdigit' => true
            ),
            array('name' => 'Diners Club Carte Blanche',
                'length' => '14',
                'prefixes' => '300,301,302,303,304,305',
                'checkdigit' => true
            ),
            array('name' => 'Diners Club',
                'length' => '14,16',
                'prefixes' => '305,36,38,54,55',
                'checkdigit' => true
            ),
            array('name' => 'Discover',
                'length' => '16',
                'prefixes' => '6011,622,64,65',
                'checkdigit' => true
            ),
            array('name' => 'Diners Club Enroute',
                'length' => '15',
                'prefixes' => '2014,2149',
                'checkdigit' => true
            ),
            array('name' => 'JCB',
                'length' => '16',
                'prefixes' => '35',
                'checkdigit' => true
            ),
            array('name' => 'Maestro',
                'length' => '12,13,14,15,16,18,19',
                'prefixes' => '5018,5020,5038,6304,6759,6761',
                'checkdigit' => true
            ),
            array('name' => 'MasterCard',
                'length' => '16',
                'prefixes' => '51,52,53,54,55',
                'checkdigit' => true
            ),
            array('name' => 'Solo',
                'length' => '16,18,19',
                'prefixes' => '6334,6767',
                'checkdigit' => true
            ),
            array('name' => 'Switch',
                'length' => '16,18,19',
                'prefixes' => '4903,4905,4911,4936,564182,633110,6333,6759',
                'checkdigit' => true
            ),
            array('name' => 'Visa',
                'length' => '13,16',
                'prefixes' => '4',
                'checkdigit' => true
            ),
            array('name' => 'Visa Electron',
                'length' => '16',
                'prefixes' => '417500,4917,4913,4508,4844',
                'checkdigit' => true
            ),
            array('name' => 'LaserCard',
                'length' => '16,17,18,19',
                'prefixes' => '6304,6706,6771,6709',
                'checkdigit' => true
            )
        );

        $ccErrorNo = 0;

        $ccErrors [0] = "Unknown card type";
        $ccErrors [1] = "No card number provided";
        $ccErrors [2] = "Credit card number has invalid format";
        $ccErrors [3] = "Credit card number is invalid";
        $ccErrors [4] = "Credit card number is wrong length";

        // Establish card type
        $cardType = -1;
        for ($i = 0; $i < sizeof($cards); $i++) {

            // See if it is this card (ignoring the case of the string)
            if (strtolower($cardname) == strtolower($cards[$i]['name'])) {
                $cardType = $i;
                break;
            }
        }

        // If card type not found, report an error
        if ($cardType == -1) {
            $errornumber = 0;
            $errortext = $ccErrors [$errornumber];
            return false;
        }

        // Ensure that the user has provided a credit card number
        if (strlen($cardnumber) == 0) {
            $errornumber = 1;
            $errortext = $ccErrors [$errornumber];
            return false;
        }

        // Remove any spaces from the credit card number
        $cardNo = str_replace(' ', '', $cardnumber);

        // Check that the number is numeric and of the right sort of length.
        if (!eregi('^[0-9]{13,19}$', $cardNo)) {
            $errornumber = 2;
            $errortext = $ccErrors [$errornumber];
            return false;
        }

        // Now check the modulus 10 check digit - if required
        if ($cards[$cardType]['checkdigit']) {
            $checksum = 0;                                  // running checksum total
            $mychar = "";                                   // next char to process
            $j = 1;                                         // takes value of 1 or 2
            // Process each digit one by one starting at the right
            for ($i = strlen($cardNo) - 1; $i >= 0; $i--) {

                // Extract the next digit and multiply by 1 or 2 on alternative digits.
                $calc = $cardNo{$i} * $j;

                // If the result is in two digits add 1 to the checksum total
                if ($calc > 9) {
                    $checksum = $checksum + 1;
                    $calc = $calc - 10;
                }

                // Add the units element to the checksum total
                $checksum = $checksum + $calc;

                // Switch the value of j
                if ($j == 1) {
                    $j = 2;
                } else {
                    $j = 1;
                };
            }

            // All done - if checksum is divisible by 10, it is a valid modulus 10.
            // If not, report an error.
            if ($checksum % 10 != 0) {
                $errornumber = 3;
                $errortext = $ccErrors [$errornumber];
                return false;
            }
        }

        // The following are the card-specific checks we undertake.
        // Load an array with the valid prefixes for this card
        $prefix = split(',', $cards[$cardType]['prefixes']);

        // Now see if any of them match what we have in the card number
        $PrefixValid = false;
        for ($i = 0; $i < sizeof($prefix); $i++) {
            $exp = '^' . $prefix[$i];
            if (ereg($exp, $cardNo)) {
                $PrefixValid = true;
                break;
            }
        }

        // If it isn't a valid prefix there's no point at looking at the length
        if (!$PrefixValid) {
            $errornumber = 3;
            $errortext = $ccErrors [$errornumber];
            return false;
        }

        // See if the length is valid for this card
        $LengthValid = false;
        $lengths = split(',', $cards[$cardType]['length']);
        for ($j = 0; $j < sizeof($lengths); $j++) {
            if (strlen($cardNo) == $lengths[$j]) {
                $LengthValid = true;
                break;
            }
        }

        // See if all is OK by seeing if the length was valid.
        if (!$LengthValid) {
            $errornumber = 4;
            $errortext = $ccErrors [$errornumber];
            return false;
        };

        // The credit card is in the required format.
        return true;
    }

    /**
     * Calculate the age of passenger depending on a specific date
     * @param <string> $age dob of the passenger (Y-m-d format)
     * @param <string> $date traveling date (Y-m-d format)
     * @return <int> age of the passenger
     */
    static public function getAge($age, $date){

        list($y1,$m1,$d1) = explode('-', $age);
        list($y2,$m2, $d2) = explode('-',$date);

        return ($m2.$d2< $m1.$d1)? ($y2-$y1)-1 : ($y2-$y1);
        
    }

    static function getAdultChildInfantString($nbrAdults, $nbrChildren, $nbrInfants, $separator = ', '){


        $string = '';

        $string .= format_number_choice( '[0]|[1]1 adult|(1,+Inf]%1% adults',
                                         array('%1%' =>$nbrAdults), $nbrAdults);

        if($nbrChildren){

            $string .= $separator;
            $string .= format_number_choice( '[0]|[1]1 child|(1,+Inf]%1% children',
                                         array('%1%' =>$nbrChildren), $nbrChildren);

        }

        if($nbrInfants){

            $string .= $separator;
            $string .= format_number_choice( '[0]|[1]1 infant|(1,+Inf]%1% infants',
                                         array('%1%' =>$nbrInfants), $nbrInfants);
        }

        return $string;

    }

    /**
     * 
     * @param array 
     * @param <type> $separator
     * @return <type>
     */
    static function getChildrenAgeString($ar, $separator = ', '){

        $totalYears = 0;
        $string = '';

        $tmp = array();

        foreach($ar as $key=>$value){
            array_push($tmp,$value['age']);
            $totalYears += $value['age'];
            //$string .= $separator;
        }

        sort($tmp);

        foreach($tmp as $k=>$v){
            $string .= $v;
            $string .= ($k ==  count($tmp)-2)? __(' and '):$separator;
        }

        $string = substr($string, 0,-2);

        return format_number_choice( '[0]|[1]aged %1% year old|(1,+Inf]aged %1% years old',
                               array('%1%' =>$string),
                               ($totalYears/count($ar)));


    }

    static function getChildrenAgeString2($ar, $separator = ', '){

        sort($ar);

        foreach($ar as $k=>$v){
            $string .= $v;
            $string .= ($k ==  count($tmp)-2)? __(' and '):$separator;
        }

        $string = substr($string, 0,-2);

        return format_number_choice( '[0]|[1]aged %1% year old|(1,+Inf]aged %1% years old',
                               array('%1%' =>$string),
                               (array_sum($ar)/count($ar)));
    }




    static function getChildrenInfantsStringForFlight($ar){

        if(isset($ar['children'])){

            $string = '';

            if($ar['children']){
                $string .= format_number_choice(
                        '[0]|[1]1 child between 2 and 12 years old|(1,+Inf]%1% children between 2 and 12 years old',
                         array('%1%'=>$ar['children']),
                         $ar['children']);
            }

            if($ar['infants']){

                if($string != ''){
                    $string .= __(' and ');
                }

                $string .= format_number_choice(
                            '[0]|[1]1 infant under 2 years old|(1,+Inf]%1% infants under 2 years old',
                         array('%1%'=>$ar['infants']),
                         $ar['infants']);

            }

            return $string;

        }else{

            $stringAged = self::getChildrenAgeString2($ar);
            //echo "<br />";
            //echo $stringAged;

            return format_number_choice(
                        '[0]|[1]1 child %2%|(1,+Inf]%1% children %2%',
                         array('%1%'=>count($ar),
                               '%2%'=> $stringAged),
                         count($ar));

        }

        
    }

    static function getNightString($nbrNights){
        return format_number_choice( '[0]|[1]1 night|(1,+Inf]%1% nights',
                                         array('%1%' =>$nbrNights), $nbrNights);
    }

    static function getNumberRoomsString($nbrRooms){
        return format_number_choice( '[0]|[1]1 room|(1,+Inf]%1% rooms',
                                         array('%1%' =>$nbrRooms), $nbrRooms);
    }


    /**
     * Function to calculate the price depending on a currency and return
     * a priced formatted form a specific culture.
     * @param float $amount
     * @return string
     */
    static function getPrice($amount){        
        $currency = sfConfig::get('app_currency');
        return format_currency($amount, $currency);
    }
    
    /**
     * Create pagination list links
     * @param int $total
     * @param int $page
     */
    static function getPagination($total, $page){
        
        $jeton = 0;
        $totalPerPage = sfConfig::get('totalPerPage');
        $nbrPages = ceil($total / $totalPerPage);
        
        $string = '<ul class="inline right">';
        
        //Prev
        $string .= '<li>';
        $string .= ($page == 1)?'<span class="page-link-prev">&LessLess; Prev</span>': '<a href="" class="page-link" id="prev-'.($page-1).'">&LessLess; Prev</a>';
        $string .= '</li>';
        
        //Always show the first page
        $string .= '<li>';
        $string .= ($page == 1)?'<span class="page-link">1</span>': '<a href="" class="page-link">1</a>';
        $string .= '</li>';
        
        if($page > 1+3){
            
            
            $string .= '<li>';
            $string .= '<span class="page-link-prev"> ...</span>';
            $string .= '</li>';
        }
        
        $start = ($page-2 <= 2)? 2: $page-2;
        
        for($i=$start;$i<$nbrPages;$i++){
            
            if($jeton > 4){
                continue;
            }
            
            $string .= '<li>';
            $string .= ($page == $i)?
                '<span class="page-link">'.$i.'</span>': 
                '<a href="" class="page-link">'.$i.'</a>';
            $string .= '</li>';
            
            $jeton ++;
        }
        
        if($page+3 < $nbrPages){
            $string .= '<li>';
            $string .= '<span class="page-link-prev"> ...</span>';
            $string .= '</li>';
        }

        //Always show the last page
        
        
        
        $string .= '<li>';
        $string .= ($page == $nbrPages)?
                        '<span class="page-link">'.$nbrPages.'</span>':
                        '<a href="" class="page-link">'.$nbrPages.'</a>';
        $string .= '</li>';
        
        //Prev
        $string .= '<li>';
        $string .= ($page == 1)?'<span class="page-link-next">Next &GreaterGreater;</span>': '<a href="" class="page-link" id="next-'.($page+1).'">Next &GreaterGreater;</a>';
        $string .= '</li>';
        
        $string .= '</ul>';
        return $string;
        
    }
    
    /**
     * Return formatted user-agent info from $_REQUEST['user_agent']
     * @param type $string 
     * return array(OS,Browser,Version)
     */
    static function getUserAgent($string = ''){
        
        $ar = array();
        
        //echo $string;
        
        //OS
        switch(true){
            
            case preg_match('#Macintosh#i', $string)>0:
                $ar['os'] = 'Macintosh';
                break;
            
            case preg_match('#Linux#i', $string)>0:
                $ar['os'] = 'Linux';
                break;
            
            case preg_match('#Windows#i', $string)>0:
                $ar['os'] = 'Windows';
                break;
            
            default:
                $ar['os'] = 'undefined';
                break;
            
        }
        
        switch(true){
            
            case preg_match('#MSIE#i', $string)>0:
                $ar['browser'] = 'MSIE';
                break;
            
            case preg_match('#Firefox#i', $string)>0:
                $ar['browser'] = 'Firefox';
                break;
            
            case preg_match('#Chrome#i', $string)>0:
                $ar['browser'] = 'Chrome';
                break;
            
            case preg_match('#Opera#i', $string)>0:
                $ar['browser'] = 'Opera';
                break;
            
            case preg_match('#Safari#i', $string)>0:
                $ar['browser'] = 'Safari';
                break;
            
            default:
                $ar['browser'] = 'undefined';
                break;
            
        }
        
        //Browser + version
        $matchesarray = array();
        switch (true) {
            case preg_match('#MSIE#', $string):
                preg_match_all('#MSIE[0-9. ]+#', $string, $matchesarray);
                $ar['version'] = trim(substr($matchesarray[0][0], 5));
                break;
            
            case preg_match('#Firefox#', $string):
                preg_match_all('#Firefox\/[0-9. ]+#', $string, $matchesarray);
                $ar['version'] = trim(substr($matchesarray[0][0], 8));
                break;
            
            case preg_match('#Chrome#', $string):
                preg_match_all('#Chrome\/[0-9. ]+#', $string, $matchesarray);
                $ar['version'] = trim(substr($matchesarray[0][0], 8));
                break;
            
            case preg_match('#Safari#', $string):
                preg_match_all('#Version\/[0-9. ]+#', $string, $matchesarray);
                $ar['version'] = trim(substr($matchesarray[0][0], 8));
                break;
            
            case preg_match('#Opera#', $string):
                preg_match_all('#Version\/[0-9. ]+#', $string, $matchesarray);
                $ar['version'] = trim(substr($matchesarray[0][0], 8));
                break;

            default:
                break;
        }
        
        return $ar;
    }
    
    /**
     * Return language from a uri
     * @param $string
     */
    static function getLanguage($string){
        
        $value = '';
        
        switch ($string) {
            case preg_match('#en_US#', $string)>0:
                $value = 'en_US';
                break;
            
            case preg_match('#fr_FR#', $string)>0:
                $value = 'fr_FR';
                break;
            
            case preg_match('#zh_CN#', $string)>0:
                $value = 'zh_CN';
                break;

            default:
                break;
        }
        
        
        return $value;
        
    }
    
    /**
     * Return number of seconds for a dateInterval
     * @param type $dateInterval
     * @return type 
     */
    static function getDateIntervalValue($dateInterval){
        
        return ($dateInterval->y * 365 * 24 * 60 * 60) +
               ($dateInterval->m * 30 * 24 * 60 * 60) +
               ($dateInterval->d * 24 * 60 * 60) +
               ($dateInterval->h * 60 *60) +
                $dateInterval->i*60 +
               $dateInterval->s;
        
    }
    
    /**
     * Return minute seconds from a total of seconds
     * @param unknown_type $time
     */
    static function getMinutesSeconds($time){
        
        $m = '';
        
        if($time > 60){
            $m = floor($time/60).' min ';
            $time = $time%60;
        }
        
        return $m.$time.'s';
        
        
    }
 
    /**
     * Convert ip address in it's numeric value (from xx.xx.xx.xx to xxxxxxxx)
     * @param string $ip
     */
    static function convertIpToNumeric($ip){
    	//1.2.3.4 = 4 + (3 * 256) + (2 * 256 * 256) + (1 * 256 * 256 * 256)
    	$ar = explode('.', $ip);
    	return $ar[0]*pow(256, 3)+$ar[1]*pow(256, 2)+$ar[2]*256+$ar[3];
    }

}


