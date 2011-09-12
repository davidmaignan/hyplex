<?php

/**
 * searchHotel actions.
 *
 * @package    hypertech_booking
 * @subpackage searchHotel
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchHotelActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        $this->form = new SearchHotelForm();

        if ($this->getRequest()->getRequestFormat() == 'iphone') {
            $this->form = new SearchFlightIphoneForm();
        }
        if ($this->getRequest()->getRequestFormat() == 'ipad') {
            $this->form = new SearchFlightIpadForm();
        }
        //$this->forward('default', 'module');
    }

    public function executeCreate(sfWebRequest $request) {

        //$this->forward404Unless($request->isMethod(sfRequest::POST));
        
        $this->form = new SearchHotelForm();

        if ($this->getRequest()->getRequestFormat() == 'iphone') {
            //$this->form = new SearchFlightIphoneForm();
        }
        if ($this->getRequest()->getRequestFormat() == 'ipad') {
            //$this->form = new SearchFlightIpadForm();
        }
        $this->processForm($request, $this->form);
        $this->setTemplate('index');
        
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();

        $origin = $parameters['search_hotel']['wherebox'];
        $originValidation = MyValidation::validateOriginDest($origin,$this->getRequest(),'wherebox', $this->getUser()->getCulture());


        
        if ($form->isValid() && $originValidation === true) {
            $this->forward('process', 'index');
        }
    }

    /**
     * Ajax called to add extra room / hotel search
     *
     * @param sfRequest $request A request object
     */
    public function executeAddRoomForm(sfWebRequest $request){

        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));

        $form = new SearchHotelForm();
        $form->addRoom($number);
        return $this->renderPartial('addRoom', array('form' => $form, 'num' => $number));
    }

        public function executeAddRoomForm2(sfWebRequest $request){

        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));

        $form = new SearchHotelForm();
        $form->addRoom($number);
        return $this->renderPartial('addRoom2', array('form' => $form, 'num' => $number));
    }

    /**
     * Ajax called to add children age menu / room
     *
     * @param sfRequest $request A request object
     */
    public function executeAddChildrenAge(sfWebRequest $request){

        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));
        $roomNumber = intval($request->getParameter("roomNumber"));
        $form = new SearchHotelForm();
        $form->addChildrenAge($roomNumber, $number);

        return $this->renderPartial('addChildrenAge', array('form' => $form, 'num' => $number, 'roomNumber'=>$roomNumber));
    }

}
