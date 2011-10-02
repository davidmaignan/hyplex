<?php

/**
 * test actions.
 *
 * @package    hypertech_booking
 * @subpackage test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
      //$request->setRequestFormat('iphone');
      //$this->setLayout('iphone');
      //$promotionalBanners = Doctrine::getTable('PromotionalBanner')->findAll()->toArray();
      //$this->promotionalBanners = json_encode($promotionalBanners);
      //echo htmlentities($this->promotionalBanners);
      //break;

     
      
      //$promotionalBanners = Doctrine::getTable('PromotionalBanner')->getActivePromotions($this->getUser()->getCulture())->execute()->toArray();
      
      //$this->promotionalBanners = json_encode($promotionalBanners);

  }

  public function executeTest(sfWebRequest $request)
  {
      //$culture = $this->getUser()->getCulture();
      //$this->airports = Doctrine::getTable('Airport')->getListAirportByCode(array('AKL','SYD','JFK','SFO','LAX'));
      //sfConfig::set('sf_escaping_strategy', false);
              /*
      $airports = Doctrine_Query::create()
                        ->select('a.code AS code, t.name AS name, t.city_name AS city_name, t.country AS country, t.region AS region')
                        ->from('Airport a')
                        ->leftJoin('a.Translation t')
                        ->andwhere('t.lang = ?',$culture)
                        ->execute()
                        ->toArray();
      //echo "<pre>";
      //print_r($airports);
      $this->airports = json_encode($airports);
      //break;
               * 
               */

      sfConfig::set('sf_escaping_strategy', false);
      
  }

  public function executeHarvest(sfWebRequest $request)
  {
      
  }

  public function executeNew(sfWebRequest $request)
  {
      //$this->getUser()->setCredentials('manager');
  }

  public function executeAjaxTranslation(sfWebRequest $request) {

        //return $this->renderText('test');

        $culture = $this->getUser()->getCulture();
        $parameters = $request->getPostParameters();

        //$start = 100;
        //$end = 200;

        //$output = array_slice($parameters, $start, $end, true);

        //return $this->renderText($output);

        //$ids = array_keys($output);


        $filename = sfConfig::get('sf_cache_dir').'/city/city_'.$culture.'.txt';

        $handle = fopen($filename, 'a+');

        foreach ($parameters as $key => $value) {
            //fwrite($handle, $key.':'.$value."\n");
            //fwrite($handle, "\n\r");
        }
        chmod($filename, 0777);

        fclose($handle);


        /*$datas = Doctrine_Query::create()
                        ->from('city a')
                        ->whereIn('a.id', $ids)
                        ->execute();


        //var_dump(count($datas));

        foreach ($datas as $key => $data) {

            //echo $data->getName();

            $data->setName($output[$key + $start + 1], $culture);
            echo $output[$key + $start + 1];
            echo '<br />';
            //$data->save();
        }*/


        return $this->renderText('done');
        //exit;

        //$area = $data[0];
        //$area->setName('Afrique','fr_FR');
        //$area->save();
    }

    public function executeCreateImage(sfWebRequest $request){
        
    }

    public function executeAutoComplete(sfWebRequest $request){
        
    }

    public function executeAutoComplete2(sfWebRequest $request){
        
    }

    public function executeSearchAirportComplete(sfWebRequest $request){


        //Retreive the parameter
        $search = $request->getParameter('name_startsWith');
        $culture = $this->getUser()->getCulture();

        //Assume it's on field even for mulitple words (like New York, or Charles de Gaulle)
        $value1 = '%'. $search.'%';

        //Two arrays to hold the query and the values
        $valeurs = array();
        $arQuery = array();

        //Code
        //$tmpQuery = '(a.code LIKE ?) OR (a.airport LIKE ?) OR (t.name LIKE ?) OR (u.name LIKE ?)';
        $tmpQuery = '(a.code LIKE ?) OR (a.airport LIKE ?) OR (t.name LIKE ?)';
        array_push($arQuery, $tmpQuery);
        array_push($valeurs, $value1);
        array_push($valeurs, $value1);
        array_push($valeurs, $value1);
        //array_push($valeurs, $value1);

        $query = implode(' OR ', $arQuery);

        $this->datas = Doctrine::getTable('City')
                        ->createQuery('a')
                        ->select('a.code, a.airport AS airport, t.name AS name, b.id,  u.name AS country')
                        ->leftJoin('a.Translation t')
                        ->leftJoin('a.Country b')
                        ->leftJoin('b.Translation u')
                        ->andWhere('t.lang = ?',$culture)
                        ->andWhere('u.lang = ?',$culture)
                        //->andWhere($string,$values)
                        ->andWhere($query,$valeurs)
                        ->andWhere('a.cache = ?', true)
                        ->andWhere('a.archived = ?', false)
                        ->limit(25)
                        ->addOrderBy('name')
                        ->execute()
                        ->toArray();

        $results = array();

        foreach($this->datas as &$data){
            unset($data['Translation']);
            unset($data['Country']);
            unset($data['country_id']);
            unset($data['cache']);
            unset($data['state_id']);
            unset($data['metropolitan']);
            unset($data['archived']);
            $tmp = array(   'airport'=>$data['airport'],
                            'name'=>$data['name'],
                            'country'=>$data['country'],
                            'code'=>$data['code']);
            //$string  = $data['name'].', '.$data['country'].' ('.$data['code'].') '. $data['airport'];
            array_push($results, $tmp);
        }

        $resultJSON = json_encode(array('values'=>array($search),'results'=>$results));

        return $this->renderText($resultJSON);


        //$stringSearch = '%Lon%';
        //var_dump($request->getParameter('q'));
        //var_dump($q);
        //exit;

        //$string = '(a.code LIKE ?) OR (a.airport like ? AND a.airport LIKE ?) OR (t.name LIKE ? AND t.name LIKE ?)';

        //$values = array('%Lon%','%Lond%','%Hea%', '%Lond%', '%Hea%');


        /*
        $this->datas = Doctrine::getTable('City')
                        ->createQuery('a')

                        ->leftJoin('a.Translation t')
                        ->leftJoin('a.Country b')
                        ->leftJoin('b.Translation u')
                        ->andWhere('t.lang = ?',$culture)
                        ->andWhere('u.lang = ?',$culture)
                        ->andWhere('a.code LIKE ?',$stringSearch)
                        ->andWhere('u.name LIKE ?',$stringSearch)
                        ->limit(10)
                        ->execute()
                        ->toArray();
         * 
         */

        //$case = 2;


        /*
        $value1 = '%lh%';
        $value2 = '%l%';
        $this->q1 = substr($value1 , 1, -1);
        $this->q2 = substr($value2 , 1, -1);
         * 
         */
        $valeurs = array();
        $arQuery = array();

        //$q = trim($request->getParameter('text'));
        //$arValues = explode(' ', $q);

        $arValues = explode(' ', $search);

        $case = count($arValues);

        //var_dump($case);
        //exit;

        if($case == 1){

            $value1 = '%'. $arValues[0].'%';

            //Code
            $tmpQuery = '(a.code LIKE ?) OR (a.airport LIKE ?) OR (t.name LIKE ?) OR (u.name LIKE ?)';
            array_push($arQuery, $tmpQuery);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);
            array_push($valeurs, $value1);
            
        }else if($case == 2){
            
            $value1 = '%'. $arValues[0].'%';
            $value2 = '%'. $arValues[1].'%';

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
  
        }else if($case == 3){

            $value1 = '%'. $arValues[0].' '.$arValues[1].'%';
            $value2 = '%'. $arValues[2].'%';

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


            $value1 = '%'. $arValues[0].'%';
            $value2 = '%'.$arValues[1]. ' ' .$arValues[2].'%';

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


        $query = implode(' OR ', $arQuery);

        $this->datas = Doctrine::getTable('City')
                        ->createQuery('a')
                        ->select('a.code, a.airport AS airport, t.name AS name, b.id,  u.name AS country')
                        ->leftJoin('a.Translation t')
                        ->leftJoin('a.Country b')
                        ->leftJoin('b.Translation u')
                        ->andWhere('t.lang = ?',$culture)
                        ->andWhere('u.lang = ?',$culture)
                        //->andWhere($string,$values)
                        ->andWhere($query,$valeurs)
                        ->andWhere('a.cache = ?', true)
                        ->andWhere('a.archived = ?', false)
                        ->limit(25)
                        //->addOrderBy('a.code')
                        ->execute()
                        ->toArray();

        $results = array();
        
        foreach($this->datas as &$data){
            unset($data['Translation']);
            unset($data['Country']);
            unset($data['country_id']);
            unset($data['cache']);
            unset($data['state_id']);
            unset($data['metropolitan']);
            unset($data['archived']);
            $tmp = array(   'airport'=>$data['airport'],
                            'name'=>$data['name'],
                            'country'=>$data['country'],
                            'code'=>$data['code']);
            //$string  = $data['name'].', '.$data['country'].' ('.$data['code'].') '. $data['airport'];
            array_push($results, $tmp);
        }

        $resultJSON = json_encode(array('values'=>$arValues,'results'=>$results));

        return $this->renderText($resultJSON);

        if(!$request->isXmlHttpRequest()){
            $this->setTemplate('tmpAutoComplete');
        }
        
        

       

        //return json_encode($datas);


        //$datas =

    }

    public function executeSearchAirportComplete2(sfWebRequest $request){

        $search = $request->getParameter('name_startsWith');

        $q = Doctrine::getTable('city')->searchAutoComplete($search);

        $resultJSON = json_encode(array('values'=>$search,'results'=>$q));

        return $this->renderText($resultJSON);

        
    }

}
