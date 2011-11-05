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
        $this->title = 'Area';
        $this->areas = Doctrine::getTable('area')->findAll();
        $this->setLayout('multidestination');
    }

    
    public function executeAjaxDestination(sfWebRequest $request) {
        $type = $request->getPostParameter('type');
        $id = $request->getPostParameter('value');

        if ($type == 'areaSelect') {

            $this->datas = Doctrine::getTable('country')->findBy('area_id', $id);
            $this->name = 'countrySelect';
            $this->title = 'Country';

        } else if ($type == 'countrySelect') {

            //Check if it's a country working with states/provinces like USA, Canada
            $country = Doctrine::getTable('country')->findOneBy('id', $id);           

            if($country->getState() == true){

                $this->title = 'State / Province';
                $this->datas = Doctrine::getTable('state')->findBy('country_id', $id);
                $this->name = 'stateSelect';

            }else{

                $this->title = 'City';
                $this->datas = Doctrine::getTable('city')->findBy('country_id', $id);
                $this->name = 'citySelect';
            }

            
        }  else if ($type == 'stateSelect') {

            $this->title = 'City';
            $this->datas = Doctrine::getTable('city')->findBy('state_id', $id);
            $this->name = 'citySelect';
        }

        $this->setTemplate('selectMenu');
        sfView::NONE;
    }


}
