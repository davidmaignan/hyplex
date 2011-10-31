<?php

/**
 * CityTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class CityTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object CityTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('City');
    }

    public function applyNameFilter($query, $value) {

        $query->leftJoin($query->getRootAlias() . '.Translation t')
                ->addWhere('t.name like \'%' . $value['text'] . '%\'');
    }

    public function addRank($values){

       
        foreach($values as $value){

            $q = Doctrine_Query::create()
                    ->update('city')
                    ->set('rank','rank + 1')
                    ->where('code = ?', $value)
                    ->execute();


        }

    }

    public function getAllByCulture($culture) {
        $q = Doctrine::getTable('City')
                        ->createQuery('a')
                        ->select('a.id, a.code, a.airport, t.name as city, b.id, u.name as country, c.code as state')
                        ->leftJoin('a.Translation t')
                        ->andWhere('t.lang = ?', $culture)
                        ->leftJoin('a.Country b')
                        ->leftJoin('b.Translation u')
                        ->andWhere('u.lang = ?', $culture)
                        ->leftJoin('a.State c')
                        ->execute()
                        ->toArray();

        return $q;
    }

    /*
     * Return an array for paramFactory to handle multi language info
     * about airport / city origin and destination
     * @param code - string 3 letters IATA code
     * @array with code, airport name, country and state in all languages following this example
     */

    /*
     * Array(
      [code] => DFW
          [airport] => Dallas Metropolitan Area
              [zh_CN] => Array
                  (
                  [name] => 达拉斯
                  [state] => Array
                  (
                  [code] => TX
                  [name] => 德州
                  )
              )
              [fr_FR] => Array
                  (
                  [name] => Dallas
                  [state] => Array
                  (
                  [code] => TX
                  [name] => Texas
                  )
              )
              [en_US] => Array
                  (
                  [name] => Dallas
                  [state] => Array
                  (
                  [code] => TX
                  [name] => Texas
              )
          )
      )
     */

    public function getCityAllCulture($code) {

        $languages = sfConfig::get('app_languages_available');

        $q = Doctrine::getTable('City')
                        ->createQuery('a')
                        ->andWhere('a.code = ?', $code)
                        ->leftJoin('a.Translation')
                        ->leftJoin('a.State b')
                        ->leftJoin('b.Translation')
                        ->leftJoin('a.Country c')
                        ->leftJoin('c.Translation')
                        ->execute()
                        ->toArray();


        $ar = array();
        $ar['id'] = $q[0]['id'];
        $ar['code'] = $q[0]['code'];
        $ar['airport'] = $q[0]['airport'];
        $ar['metropolitan'] = $q[0]['metropolitan'];

        foreach ($languages as $language) {
            $tmp = array();
            $tmp['name'] = $q[0]['Translation'][$language]['name'];
            $tmp['country'] = $q[0]['Country']['Translation'][$language]['name'];

            if (array_key_exists('State', $q[0])) {
                $tmp['state']['code'] = $q[0]['State']['code'];
                $tmp['state']['name'] = $q[0]['State']['Translation'][$language]['name'];
            }
            $ar[$language] = $tmp;
        }

        return $ar;
    }

    /*
     * Return multidimentional array
     * @param $codes array with list of code for airport
     * @return array('airport_code'=>array('city_code','state',
     *                                     array(lang=>'name','city_name','country','region')
     * [AKL] => Array
      (
      [city_code] => AKL
      [state] =>
      [zh_CN] => Array
      (
      [name] => 奥克兰 国际
      [city_name] => 奥克兰
      [country] => 新西兰
      [region] => 新西兰
      )

      [fr_FR] => Array
      (
      [name] => Auckland International
      [city_name] => Auckland
      [country] => Nouvelle-Zélande
      [region] => Nouvelle-Zélande
      )

      [en_US] => Array
      (
      [name] => Auckland International
      [city_name] => Auckland
      [country] => New Zealand
      [region] => New Zealand
      )

      )
      [JFK] => Array
      ...
     */

    public static function getListAirportByCode($codes) {

        $languages = sfConfig::get('app_languages_available');

        $q = Doctrine_Query::create()
                        ->from('City a')
                        ->whereIn('a.code', $codes)
                        ->leftJoin('a.Translation')
                        ->leftJoin('a.Country b')
                        ->andWhere('a.country_id = b.id')
                        ->leftJoin('b.Translation')
                        ->leftJoin('a.State')
                        ->execute()
                        ->toArray();

        $ar = array();

        foreach ($q as $value) {
            $tmp = array();
            $tmp['city_code'] = $value['code'];
            if (array_key_exists('State', $value)) {
                $tmp['state'] = $value['State']['code'];
            } else {
                $tmp['state'] = '';
            }

            foreach ($languages as $language) {
                //unset($value['Translation'][$language]['lang']);
                //unset($value['Translation'][$language]['id']);
                //$tmp[$language] = $value['Translation'][$language];
                $tmp[$language]['name'] = $value['airport'];
                $tmp[$language]['city_name'] = $value['Translation'][$language]['name'];
                $tmp[$language]['country'] = $value['Country']['Translation'][$language]['name'];
            }
            $ar[$value['code']] = $tmp;
        }

        return $ar;
    }

    public static function findCloseMatch($data, $culture, $way) {

        sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Tag'));

        //$data = 'Rome';

        $q = Doctrine_Query::create()
                        ->from('City a')
                        //->select('a.code, b.name')
                        ->leftJoin('a.Translation b')
                        ->where('b.name LIKE ?', "$data%")
                        //->where('b.name LIKE :name', array(':name'=>'%'.$value.'%'))
                        ->andWhere('b.lang = ?', $culture)
                        ->leftJoin('a.Country c')
                        ->leftJoin('c.Translation d')
                        ->andWhere('d.lang = ?', $culture)
                        ->leftJoin('a.State')
                        ->orderBy('d.name ASC')
                        ->addOrderBy('b.name')
                        //->leftJoin('e.Translation f')
                        //->andWhere('f.lang = ?', 'en_US')
                        ->execute()
                        ->toArray();

        //echo "<pre>";
        //print_r($q);


        $ar = array();

        foreach ($q as $value) {
            $tmp = array();
            $tmp['city_code'] = $value['code'];
            if (array_key_exists('State', $value)) {
                $tmp['state'] = $value['State']['code'];
            } else {
                $tmp['state'] = '';
            }

            //foreach ($languages as $language) {
            //unset($value['Translation'][$language]['lang']);
            //unset($value['Translation'][$language]['id']);
            //$tmp[$language] = $value['Translation'][$language];
            $tmp[$culture]['name'] = $value['airport'];
            $tmp[$culture]['city_name'] = $value['Translation'][$culture]['name'];
            $tmp[$culture]['country'] = $value['Country']['Translation'][$culture]['name'];
            $tmp['country_code'] = $value['Country']['code'];

            //}
            $ar[$value['code']] = $tmp;
        }

        $result = array();

        foreach ($ar as $key => $value) {
            $string = '<a href="#" onclick="return false;" class="matches '.$way.'">';
            $string .= $value[$culture]['city_name'] . '';
            $string .= isset($value[$culture]['state']) ? ' [' . $value[$culture]['state']['code'] . ']' : '';
            $string .= ', ' . $value[$culture]['country'] . ', ';
            $string .= $value[$culture]['name'] . '';
            $string .= ' (' . $key . ') ';
            $string .= '</a>';
            $string .= image_tag('icons/flag/' . $value['country_code'] . '.gif');

            array_push($result, $string);
        }

        //Utils::toBold($result, $data);


        return $result;
    }

    public static function findOneCodeFormatted($value, $culture, $way, $linked) {

        sfProjectConfiguration::getActive()->loadHelpers(array('Asset', 'Tag'));

        $value = strtoupper($value);

        $q = Doctrine_Query::create()
                        ->from('City a')
                        //->select('a.code, b.name')
                        ->leftJoin('a.Translation b')
                        ->where('a.code = ?', $value)
                        ->andWhere('b.lang = ?', $culture)
                        ->leftJoin('a.Country c')
                        ->leftJoin('c.Translation d')
                        ->andWhere('d.lang = ?', $culture)
                        ->leftJoin('a.State')
                        ->execute()
                        ->toArray();
        //echo "<pre>";
        //print_r($q);
        //break;

        if (count($q) == 0) {
            return null;
        }

        $result = array();

        if ($linked) {
            $string = '<a href="#" onclick="return false;" class="matches '.$way.'">';
            $string .= $q[0]['Translation'][$culture]['name'] . '';
            $string .= isset($q[0]['state']) ? ' [' . $q[0]['state']['code'] . ']' : '';
            $string .= ', ' . $q[0]['Country']['Translation'][$culture]['name'] . ', ';
            $string .= $q[0]['airport'] . '';
            $string .= ' (' . $q[0]['code'] . ') ';
            $string .= '</a>';
            $string .= image_tag('icons/flag/' . $q[0]['Country']['code'] . '.gif');
        } else {
            $string = '';
            $string .= $q[0]['Translation'][$culture]['name'] . '';
            $string .= isset($q[0]['state']) ? ' [' . $q[0]['state']['code'] . ']' : '';
            $string .= ', ' . $q[0]['Country']['Translation'][$culture]['name'] . ', ';
            $string .= $q[0]['airport'] . '';
            $string .= ' (' . $q[0]['code'] . ') ';

        }

        return $string;

        return Utils::toBoldString($string, $value);

    }

    public function searchAutoComplete($search = 'new york jfk'){

        $culture = sfContext::getInstance()->getUser()->getCulture();

        $valeurs = array();
        $arQuery = array();

        $arSearch = explode(' ',$search);



        if(count($arSearch) <=1){

            $value = $arSearch[0];

            //Code
            $tmpQuery = '(a.code LIKE ?) OR (a.airport LIKE ?) OR (t.name LIKE ?) OR (u.name LIKE ?)';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, "$value%");
            array_push($valeurs, "$value%");
            array_push($valeurs, "$value%");
            array_push($valeurs, "$value%");
        }else if(count($arSearch) == 2){

            $value1 = $arSearch[0].'%';
            $value2 = $arSearch[1].'%';

            $tmpQuery = '((a.code LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value1);
            array_push($valeurs, $value2);
            array_push($valeurs, $value2);
            array_push($valeurs, $value2);

            $tmpQuery = '((a.code LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            //without code

            $tmpQuery = '((a.airport LIKE ?) AND (t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            $tmpQuery = '((t.name LIKE ?) AND (a.airport LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            $tmpQuery = '((u.name LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            $tmpQuery = '(a.code LIKE ?) OR (a.airport LIKE ?) OR (t.name LIKE ?) OR (u.name LIKE ?)';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, "%$search%");
            array_push($valeurs, "%$search%");
            array_push($valeurs, "%$search%");
            array_push($valeurs, "%$search%");

        }else if(count($arSearch >= 3)){

            $value1 = $arSearch[0].' '.$arSearch[1].'%';
            $value2 = $arSearch[2].'%';

            //code
            $tmpQuery = '((a.code LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value1);
            array_push($valeurs, $value2);
            array_push($valeurs, $value2);
            array_push($valeurs, $value2);

            $tmpQuery = '((a.code LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            //without code

            $tmpQuery = '((a.airport LIKE ?) AND (t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            $tmpQuery = '((t.name LIKE ?) AND (a.airport LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            $tmpQuery = '((u.name LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);


            $value1 = $arSearch[0].'%';
            $value2 = $arSearch[1]. ' ' .$arSearch[2].'%';

            //code
            $tmpQuery = '((a.code LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value1);
            array_push($valeurs, $value2);
            array_push($valeurs, $value2);
            array_push($valeurs, $value2);

            $tmpQuery = '((a.code LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            //without code

            $tmpQuery = '((a.airport LIKE ?) AND (t.name LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            $tmpQuery = '((t.name LIKE ?) AND (a.airport LIKE ? OR u.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

            $tmpQuery = '((u.name LIKE ?) AND (a.airport LIKE ? OR t.name LIKE ?))';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value2);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);

        }
        
        /*
        foreach ($arSearch as $value) {
            $tmpQuery = '(a.CODE LIKE ? OR a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?)';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, "%$value%");
            array_push($valeurs, "%$value%");
            array_push($valeurs, "%$value%");
            array_push($valeurs, "%$value%");
        }
         * 
         */
        
        /*
        $tmpQuery = '(a.CODE LIKE ? OR a.airport LIKE ? OR t.name LIKE ? OR u.name LIKE ?)';
        array_push($arQuery, $tmpQuery);
        array_push($valeurs, $value1);
        array_push($valeurs, $value1);
        array_push($valeurs, $value1);
        array_push($valeurs, $value1);
        */

        $query = implode(' OR ', $arQuery);

        $q = Doctrine::getTable('city')
                ->createQuery('a')
                ->select('a.code as code, a.airport AS airport, t.name AS name, u.name AS country')
                ->leftJoin('a.Translation t')
                ->leftJoin('a.Country b')
                ->leftJoin('b.Translation u')
                ->andWhere('t.lang = ?', $culture)
                ->andWhere('u.lang = ?', $culture)
                ->andWhere($query,$valeurs)
                ->andWhere('a.cache = ?', true)
                ->andWhere('a.archived = ?', false)
                ->orderBy('a.rank DESC, t.name ASC')
                ->limit(20)
                ->execute(array(), Doctrine_Core::HYDRATE_SCALAR);
                //->toArray();
        
        return $q;


    }

}