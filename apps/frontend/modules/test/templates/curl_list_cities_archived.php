
<option label="Burundi" value="BI">Burundi</option>
<option label="Djibouti" value="DJ">Djibouti</option>
<option label="Eritrea" value="ER">Eritrea</option>
<option label="Ethiopia" value="ET">Ethiopia</option>
<option label="Kenya" value="KE">Kenya</option>
<option label="Rwanda" value="RW">Rwanda</option>
<option label="Somalia" value="SO">Somalia</option>
<option label="Tanzania" value="TZ">Tanzania</option>
<option label="Uganda" value="UG">Uganda</option>

    <?php

    //$countries = array('AO','BW','CM','CF','TD','CG','CD','GQ','GA','LS','MW','MZ','NA','SH','ZA','SD','SZ','ST','ZM','ZW');
    //$countries = array('AF','AM','AZ','BD','BT','CN','GE','HK','IN','JP','KZ','KG','MO','MN','NP','KP','PK','RU','KR','LK','TW','TJ','TM','UZ');
    //$countries = array('BM','PM');
    //$countries = array('AU','PG');
    //$countries = array('AI','AG','AW','BB','BQ','KY','CU','CW','DM','DO','GD','GP','HT','JM','MQ','MS','PR','KN','LC','SX','VC','BS','TT','TC','VG','VI');
    //$countries = array('BZ','CR','SV','GT','HN','NI','PA');
    //$countries = array('BI','DJ','ER','ET','KE','RW','SO','TZ','UG');
    //$countries = array('AL','AD','AT','BY','BE','BA','BG','HR','CY','CZ','DK','EE','FO','FI','FR','DE','GI','GR','GL','HU','IS','IE','IT',
    //        'LV','LI','LT','LU','MK','MT','MD','MC','ME','NL','NO','PL','PT','RO','RU','SM','RS','SK','SI','ES','SE','CH','TR','UA','GB');
    //$countries = array('CX','CC','KM','MG','MV','MU','YT','RE','SC');
    //$countries = array('BH','EG','IR','IQ','IL','JO','KW','LB','OM','PS','QA','SA','SY','TR','AE','YE');
    //$countries = array('DZ','EG','LY','MA','TN');
    //$countries = array('CA','GL','MX','US');
    //$countries = array('GU','KI','MH','FM','NR','MP','PW','UM');
    //$countries = array('AR','BO','BR','CL','CO','EC','FK','GF','GY','PY','PE','SR','UY','VE');
    //$countries = array('AS','CL','CK','FJ','PF','NC','NZ','NU','NF','WS','SB','TO','TV','VU','WF');
    //$countries = array('BN','KH','TL','ID','LA','MY','MM','PH','SG','TH','VN');

    //$countries = array('BJ', 'BF', 'CV', 'GM', 'GH', 'GN', 'GW', 'CI', 'LR', 'ML', 'MR', 'NE', 'NG');
    $countries = array('BI', 'DJ', 'ER', 'ET', 'KE', 'RW', 'SO', 'TZ', 'UG');

    

    function createFile($pays) {

        $post_data['YPS_SID'] = '2011052619343519ravcaecyhkysqlb';
        $post_data['action'] = 'search';
        $post_data['field'] = 'depApt_1';
        //$post_data['action'] = 'search';
        $post_data['searchApt'] = '';
        $post_data['area'] = 'WEAF';
        $post_data['country'] = 'US';

        $url = 'http://flweb34.ypsilon.net/indexAptSearch.php';

        foreach ($post_data as $key => $value) {
            $post_items[] = $key . '=' . $value;
        }

        //create the final string to be posted using implode()
        $post_string = implode('&', $post_items);

        $curl_connection = curl_init($url);

        //set options
        curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
        curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

        //set data to be posted
        curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

        //perform our request
        $result = curl_exec($curl_connection);

        //echo $result;


        $file = sfConfig::get('sf_cache_dir') . '/listing/' . $post_data['area'] . '_' . $post_data['country'] . '.txt';
        file_put_contents($file, $result);
        chmod($file, 0777);

        //show information regarding the request
        //echo "<pre>";
        //print_r(curl_getinfo($curl_connection));
        //echo curl_errno($curl_connection) . '-' . curl_error($curl_connection);
        //close the connection
        curl_close($curl_connection);
    }

    $i = 0;

    //createFile($countries[$i]);
    /*
      while($i<count($countries)){
      createFile($countries[$i]);
      $i++;
      }
     */


    /*

      $africa = array();

      $filename = sfConfig::get('sf_cache_dir').'/listing/countries.txt';


      $handle = fopen($filename, 'r');

      while(!feof($handle)){

      $content = fgets($handle);
      //echo htmlentities($content);
      //echo "<br />";

      $pattern = '#\"[a-zA-Z -./]+\"#';
      preg_match_all($pattern, $content, $matchesarray);
      //print_r($matchesarray);
      //echo "<hr />";

      $africa[substr($matchesarray[0][1], 1, -1)] = substr($matchesarray[0][0], 1, -1);

      }

      fclose($handle);


      var_dump($africa);

      foreach ($africa as $key => $value) {
      $newCountry = new Country();
      $newCountry->setAreaId(17);
      $newCountry->setCode($key);
      $newCountry->setName($value);
      $newCountry->save();
      }

     */


    /*
    //Liste des fichiers

    $finder = sfFinder::type('file');
    $finder = $finder->name('*.txt');
    $files = $finder->in(sfConfig::get('sf_cache_dir') . '/listing/');

    echo "<pre>";

    function saveCities($file) {

        $start = strrpos($file, '_');
        $end = strrpos($file, '.');
        $countryCode = substr($file, $start + 1, ($end - $start) - 1);
        echo $countryCode;

        //Get the id
        $country = Doctrine::getTable('Country')->findOneBy('code', $countryCode);
        $id = $country->getId();

        $content = file_get_contents($file);
        $start = strpos($content, '<option value="Ambriz (AZZ)" >');

        //echo $start;
        //echo '<br />';
        $content = substr($content, $start);
        //echo htmlentities($content);

        $pattern = '#\"[a-zA-Z -./]+\)"#';
        preg_match_all($pattern, $content, $matchesarray);
        //echo "<pre>";
        //print_r($matchesarray);

        $cities = array();

        if (!empty($matchesarray[0])) {

            foreach ($matchesarray[0] as $key => $value) {
                $city_name = trim(substr($value, 1, strpos($value, '(') - 1));
                $city_code = trim(substr($value, strpos($value, '(') + 1, strpos($value, ')') - strpos($value, '(') - 1));
                $cities[$city_code] = $city_name;
            }

            if (array_key_exists('Generic', $cities)) {
                unset($cities['Generic']);
            }

            if (array_key_exists('US', $cities)) {
                unset($cities['US']);
            }

            if (array_key_exists('british', $cities)) {
                unset($cities['british']);
            }


            if (array_key_exists('AU', $cities)) {
                unset($cities['AU']);
            }



            foreach ($cities as $key => $value) {

                if (strlen($key) == 3) {
                    $newCity = new City();
                    $newCity->setCountryId($id);
                    $newCity->setCode($key);
                    $newCity->setName($value);
                    try {
                            $newCity->save();
                    } catch (Doctrine_Exception $e) {
                        
                    }
                }
                //
            }
        }

        print_r($cities);
    }

    echo "Total: " . count($files) . "<hr />";

    for ($i = 200; $i < 233; $i++) {
        echo $i;
        saveCities($files[$i]);
    }


    //saveCities($files[0]);
     * 
     */


    
