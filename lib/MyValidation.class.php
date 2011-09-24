<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MyValidation
 *
 * @author david
 */
class MyValidation {
    //put your code here


    public static function validateOriginDest($value,  $request, $way, $culture = 'en_US')
    {

        //Define type of request flight, hotel, package ....
        $typeSearch = 'TobedefinedinMyValidationClassline20';

        switch(true){

            case ($request->hasParameter('search_flight')):
                $typeSearch = 'search_flight';
                break;

            case ($request->hasParameter('search_hotel')):
                $typeSearch = 'search_hotel';
                break;

        }


        $response = array();

        $messageError1 = "$value does not exist and is too short to perform a valid search.";
        $messageError2 = "No result found for $value.";
        $messageSuccess1 = "We have found $value in our system. Is it this one you are looking for?";
        $messageSuccess2 = "We have found a city and an airport code. Please select one.";
        $messageSuccess3 = "We have found some close matches. Please select one.";

        /* String form autocomplete or popup listing -> check existence of () and 3 uppercase letter
         * 2 charaters -> check list city short names if exist return error message (too short for a search)
         * 3 characters: check list city short names
         *    case 1: name exist return array with this name and message saying too short for a search
         *    case 2: no name -> check the code if exist return true (we assumed that's what the client is looking for
         *    case 3: no name and no code ->return error message too short
         *
         * 4 characters and more: query so search matches starting with these characters, return an array
         *
         */


        /*
         * Case 1: if string from autocomplete or popup
         */


        $subject = trim($value);


        $pattern = '#\([A-Z]{3}\)#';
        preg_match_all($pattern, $subject, $matchesarray);


        if (!empty($matchesarray[0])) {
            return true;
        }

        if(strlen($value) == 0){
            return true;
        }


        //1 character
        if(strlen($value) == 1){
            $response['message'] = $messageError1;
            $request->setParameter($way, $response);
            return false;
        }

        //2 characters
        if(strlen($value) == 2){

            $filename = sfConfig::get('sf_data_dir') . '/city/city_shortnames.yml';
            $result = sfYaml::load($filename);

            if(array_key_exists(ucfirst($value), $result['2'])){

                $response['message'] = $messageSuccess1;

                $value= str_replace('matches', 'matches '.$way, $result['2'][ucfirst($value)]);

                $response['matches'] = array($value);

                $request->setParameter($way, $response);
                return false;

            }

            $response['message'] = $messageError1;
            $request->setParameter($way, $response);
            return false;

        }


        if(strlen($value) == 3){

            //Check if city exists.
            $filename = sfConfig::get('sf_data_dir') . '/city/city_shortnames.yml';
            $result = sfYaml::load($filename);

            /*
             *  If a city exists
             */

            if(array_key_exists(ucfirst($value), $result['3'])){

                $response['message'] = $messageSuccess1;
                $response['matches']= array(str_replace('matches', 'matches '.$way, $result['3'][ucfirst($value)]));

                /*
                 * Check if an airport code exist as well and return both.
                 */

                $q = Doctrine::getTable('City')->findOneCodeFormatted($value, $culture, $way, true);

                if($q){

                    //Modify the message to present the two options.
                    $response['message'] = $messageSuccess2;
                    $response['matches'][] = $q;

                    //array_push($tmp, $q);
                }
                $request->setParameter($way, $response);
                return false;

            }
            
            /*
             * Check if only an airport code exists
             */

            $q = Doctrine::getTable('City')->findOneCodeFormatted($value, $culture, $way, false);

            //No airport code send error message (not enough character to perform a search)
            if(!$q){

                $response['message'] = $messageError1;
                $request->setParameter($way, $response);
                return false;
                
            }else{

                //An airport code exists, we can assume that's what he's looking for
                //
                $parameters = $request->getParameter($typeSearch);
                $parameters[$way] = $q;
                $request->setParameter($typeSearch, $parameters);
                return true;
            }

        }

        /*
         * More than 3 characters let's perform a search for matches
         */

        $q = Doctrine::getTable('City')->findCloseMatch($value, $culture, $way);

        if(empty($q)){

            $response['message'] = $messageError2;
            $request->setParameter($way, $response);
            return false;
            
        }else{

            $response['message'] = $messageSuccess3;
            $response['matches'] = $q;

            $request->setParameter($way, $response);
            return false;
        }


    }

}
?>
