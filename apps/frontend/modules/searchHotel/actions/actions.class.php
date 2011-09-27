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

    public function executeSearchComplementary(sfWebRequest $request){

        $plexBasket = PlexBasket::getInstance();
        $flightFilame = $plexBasket->getFlightFilename();

        if(is_null($flightFilame)){
            $this->redirect('searchHotel/index');
        }

        $flight = $plexBasket->getFlight();

        //Create parameters for hotelForm
        $hotelParameters = $plexBasket->getHotelComplementaryParameters();


        $this->form = new SearchHotelForm();
        
        $this->form->bind($hotelParameters);

        //var_dump($this->form->isValid());

        if($this->form->isValid()){
            //Form is valid - add parameters to the request and proceed
            $request->setParameter('search_hotel', $hotelParameters);
            $this->forward('process', 'index');
            
        }else{
            $this->getUser()->setFlash('children_age', 'lorem');
        }

        //exit;
        $this->setTemplate('index');

    }

    public function executeModifySearch(sfWebRequest $request){

        $filename = $request->getParameter('filename');

        $parameters = PlexParsing::retreiveParameters($filename);

        $values = $parameters->getParametersArray($this->getUser()->getCulture());
        //var_dump($values);


        $this->form = new SearchHotelForm($parameters->getParametersArray($this->getUser()->getCulture()));

        $rooms = $values['newRooms'];

        foreach($rooms as $key=>$value){
            $this->form->addRoomEdit($key, $value);
        }

        if(isset($values['childrenAge'])){

            $childrenAges = $values['childrenAge'];
            foreach($childrenAges as $key=>$child){
                $datas = explode('_', $key);
                $this->form->addChildrenAgeEdit($datas[0], $datas[1], $child);
            }

        }
        
        $this->setTemplate('index');

    }

    public function executeSearchAgain(sfWebRequest $request){

        $filename = $request->getParameter('filename');
        $parameters = PlexParsing::retreiveParameters($filename);
        $params1 = $parameters->getParametersArray($this->getUser()->getCulture());

        //echo "<pre>";
        //print_r($params1);
        $params1['_csrf_token'] = $this->getUser()->getCSRFToken(new SearchHotelForm());

        //$secret = sfConfig::get('sf_csrf_secret');
        //$csrf_token = md5($secret.session_id().get_class(new SearchFlightForm()));
        //$params['_csrf_token'] = $csrf_token;

        //$this->form = new SearchFlightForm($params);
        //var_dump($this->form->isValid());
        //exit;
        /*
        $params = Array(
            'wherebox' => 'Los Angeles, CA, USA, Los Angeles International (LAX)',
            'checkin_date' => '2011-11-01',
            'checkout_date' => '2011-11-08',
            'newRooms' => Array
                (
                    '1' => Array(
                            'number_adults' => 1,
                            'number_children' => 1,
                        ),

                    '2' => Array(
                            'number_adults' => 2,
                            'number_children' => 0,
                        )

                ),

            'childrenAge' => Array(
                    '1_1' => Array
                        (
                            'age' => 10
                        )

                ),

            'type' => 'hotelSimple',
            '_csrf_token' => '9bfc39fdc2d4ae3004c9c2b5df922daf',
        );

        print_r($params1);
         * 
         */

        //var_dump(array_diff($params1, $params));


        $this->form = new SearchHotelForm();

        /*
        $rooms = $params1['newRooms'];

        foreach($rooms as $key=>$value){
            $this->form->addRoomEdit($key, $value);
        }

        if(isset($params1['childrenAge'])){

            $childrenAges = $params1['childrenAge'];
            foreach($childrenAges as $key=>$child){
                $datas = explode('_', $key);
                $this->form->addChildrenAgeEdit($datas[0], $datas[1], $child);
            }

        }
        */
        //var_dump(array_diff($params1, $params));

        $this->form->bind($params1);

        //var_dump($this->form->isValid());
        //exit;

        
        if($this->form->isValid()){
            //Form is valid - add parameters to the request and proceed
            $request->setParameter('search_hotel', $params1);
            $this->forward('process', 'index');

        }else{
            $this->forward('searchHotel', 'modifySearch');

        }


        $this->setTemplate('index');

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

        //echo "<pre>";
        //print_r($parameters);
        //exit;

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
