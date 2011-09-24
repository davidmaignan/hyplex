<?php

/**
 * multidestination actions.
 *
 * @package    hypertech_booking
 * @subpackage multidestination
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class multidestinationActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        //$this->forward('default', 'module');
        $this->title = 'Area';

        $this->areas = Doctrine::getTable('area')->findAll();
        $this->setLayout('multidestination');
        //return sfView::NONE;
    }

    public function executeAjaxDestination(sfWebRequest $request) {
        $type = $request->getPostParameter('type');
        $id = $request->getPostParameter('value');

        if ($type == 'areaSelect') {
            $this->datas = Doctrine_Query::create()
                            ->from('country a')
                            ->where('a.area_id = ?', $id)
                            ->execute();

            $this->name = 'countrySelect';

            $this->title = 'Country';

        } else if ($type == 'countrySelect') {

            //Check if it's a country working with states/provinces like USA, Canada

            $country = Doctrine::getTable('country')->findOneBy('id', $id);

           

            if($country->getState() == true){

                $this->title = 'State / Province';

                $this->datas = Doctrine_Query::create()
                            ->from('state a')
                            ->where('a.country_id = ?', $id)
                            ->execute();
                $this->name = 'stateSelect';

            }else{
                $this->title = 'City';
                
                $this->datas = Doctrine_Query::create()
                            ->from('city a')
                            ->where('a.country_id = ?', $id)
                            ->execute();

                $this->name = 'citySelect';
            }

            
        }  else if ($type == 'stateSelect') {

            $this->title = 'City';
            $this->datas = Doctrine_Query::create()
                            ->from('city a')
                            ->where('a.state_id = ?', $id)
                            ->execute();

             $this->name = 'citySelect';
        }

        //echo $type . $value;
        $this->setTemplate('selectMenu');
        sfView::NONE;
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
            fwrite($handle, $key.':'.$value."\n");
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

    public function executeTranslation(sfWebRequest $request) {

        $this->datas = Doctrine::getTable('city')->findAll();
        $this->datas = Doctrine_Query::create()
                        ->from('city a')
                        ->where('a.id >= ?', 7467)
                        ->limit(2000)
                        ->execute();
        $this->setLayout('multidestination');
    }


    public function executeCountryComparison(sfWebRequest $request){

        $datas = Doctrine_Query::create()
                        ->select('a.code')
                        ->from('country a')
                        //->leftJoin('a.Translation t')
                        //->where('t.lang = ?', 'en_US')
                        ->orderBy('a.code ASC')
                        ->execute()
                        ->toArray();

        $this->results = $datas;
        
        $this->datas = array();

        foreach ($datas as $value) {
            array_push($this->datas, $value['code']);
        }

        $this->setLayout('multidestination');

        sfConfig::set('sf_escaping_strategy', false);

    }


}
