<?php

/**
 * main actions.
 *
 * @package    hypertech_booking
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        
        //throw new Exception('Only for test, don\'t forget to remove it!');

        $this->flightForm = new SearchFlightForm();
        $this->hotelForm = new SearchHotelForm();
        $this->carForm = new SearchCarForm();
        //$this->packageForm = new SearchPackageForm();

        //$promotionalBanners = Doctrine::getTable('PromotionalBanner')->findAll()->toArray();
        //$promotionalBanners = Doctrine::getTable('PromotionalBanner')->getActivePromotions($this->getUser()->getCulture())->execute()->toArray();
        //$this->promotionalBanners = json_encode($promotionalBanners);

        if($request->getRequestFormat() == 'iphone' || $request->getRequestFormat('ipad'))
        {
            $this->setLayout('layout');
            
            //$this->form = new sfFormLanguage($this->getUser(), array('languages' => array('en', 'fr','zh')));
            //$this->flightForm = new SearchFlightIpadForm();
        }
        
        
    }

    public function executeChangeLanguage($request) {


        $this->form = new sfFormLanguage($this->getUser(), array('languages' => array('en', 'fr','zh')));

        if ($request->isMethod('post')) {
            $this->form->process($request);

            return $this->redirect('@homepage');
        }

        // the form is not valid (can't happen... but you never know)
        return $this->redirect('@homepage');
    }

    public function executeReset(sfWebRequest $request){

        $this->getUser()->setAttribute('prevSearch', null);
        $this->getUser()->setAttribute('sTId', null);
        $this->getUser()->setAttribute('sTId_time', null);
        $this->getUser()->setAttribute('first_request', null);

        $basket = PlexBasket::getInstance();
        $basket->reset();

        $this->redirect('main/index');


    }

}
