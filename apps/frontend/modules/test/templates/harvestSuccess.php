<?php
/*

$countries = array('SN', 'SL', 'TG');



    function createFile($pays) {

        $post_data['YPS_SID'] = '2011053016260072oywmvxsxxolwvdl';
        $post_data['action'] = 'search';
        $post_data['field'] = 'depApt_1';
        //$post_data['action'] = 'search';
        $post_data['searchApt'] = '';
        $post_data['area'] = 'WEAF';
        $post_data['country'] = $pays;

        $url = 'http://flweb30.ypsilon.net/indexAptSearch.php';

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
    
      while($i<count($countries)){
        createFile($countries[$i]);
        $i++;
      }
     */

    

 //Liste des fichiers

    $finder = sfFinder::type('file');
    $finder = $finder->name('WEAF_TG.txt');
    $files = $finder->in(sfConfig::get('sf_cache_dir') . '/listing/');

    //var_dump($files);
    //break;

    echo "<pre>";

    function saveCities($file) {

        $start = strrpos($file, '_');
        $end = strrpos($file, '.');
        $countryCode = substr($file, $start + 1, ($end - $start) - 1);
        echo $countryCode;

        //Get the id
        $country = Doctrine::getTable('Country')->findOneBy('code', $countryCode);
        $id = $country->getId();

        echo "id: $id";

        $content = file_get_contents($file);
        $start = strpos($content, '<option value="Ambriz (AZZ)" >');

        //echo $start;
        //echo '<br />';
        $content = substr($content, $start);
        //echo htmlentities($content);

        $pattern = '#\"[a-zA-Z -./]+\)"#';
        preg_match_all($pattern, $content, $matchesarray);
        echo "<pre>";
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

    for ($i = 0; $i < count($files); $i++) {
        echo $i;
        saveCities($files[$i]);
    }


    //saveCities($files[0]);

     

?>
