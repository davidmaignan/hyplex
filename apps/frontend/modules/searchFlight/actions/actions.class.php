<?php

/**
 * searchFlight actions.
 *
 * @package    hypertech_booking
 * @subpackage searchFlight
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchFlightActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function preExecute() {
        parent::preExecute();

        if ($this->getRequest()->getRequestFormat() == 'iphone') {
            $this->setLayout('layout');
        }
    }

    public function executeModifySearch(sfWebRequest $request){

        $filename = $request->getParameter('filename');
        $parameters = PlexParsing::retreiveParameters($filename);
        $this->form = new SearchFlightForm($parameters->getParametersArray($this->getUser()->getCulture()));

        $this->setTemplate('index');

    }

    /**
     * Function to perform a search from previous search parameters
     * @param sfWebRequest $request
     */

    public function executeSearchAgain(sfWebRequest $request){

        $filename = $request->getParameter('filename');
        $parameters = PlexParsing::retreiveParameters($filename);
        $params1 = $parameters->getParametersArray($this->getUser()->getCulture());

        //Replace csrf_token with a valid on
        $token = PlexBasket::getInstance()->getCSRFToken(new SearchFlightForm());
        $params1['_csrf_token'] = $token;

        //$secret = sfConfig::get('sf_csrf_secret');
        //$csrf_token = md5($secret.session_id().get_class(new SearchFlightForm()));
        //$params['_csrf_token'] = $csrf_token;
        
        //$this->form = new SearchFlightForm($params);
        //var_dump($this->form->isValid());
        //exit;
        /*
        $params = array('oneway' => 0,
                        'origin' => 'Los Angeles, CA, USA, Los Angeles International (LAX)',
                        'destination' => 'Dallas, TX, USA, Dallas Metropolitan Area (DFW)',
                        'depart_date' => '2011-11-01',
                        'depart_time' => '8',
                        'return_date' => '2011-11-08',
                        'return_time' => '8',
                        'cabin' => 'Economy',
                        'number_adults' => '1',
                        'number_children' => '0',
                        'number_infants' => '0',
                        'type' => 'flightReturn',
                        '_csrf_token' => '38f9fedaf302832104cefca0e8f677c9');
         * 
         */

        //print_r($params);

        //var_dump(array_diff($params1, $params));


        $this->form = new SearchFlightForm();
        $this->form->bind($params1);
        
        if($this->form->isValid()){
            //Form is valid - add parameters to the request and proceed
            $request->setParameter('search_flight', $params1);
            $this->forward('process', 'index');

        }else{
            $this->forward('searchFlight', 'modifySearch');

        }

        $this->setTemplate('index');

    }

    

    public function executeIndex(sfWebRequest $request) {

        if($request->hasParameter('search_flight')){
            $parameters = $request->getParameter('search_flight');
        }else{
            $parameters = null;
        }

        if($request->hasParameter('matches')){
            $this->matches = $request->getParameter('matches');
            //var_dump($this->matches);
            //break;
        }

        $this->form = new SearchFlightForm($parameters);

        if ($this->getRequest()->getRequestFormat() == 'iphone') {
            $this->form = new SearchFlightIphoneForm();
        }
        if ($this->getRequest()->getRequestFormat() == 'ipad') {
            $this->form = new SearchFlightIpadForm();
        }
        //$this->forward('default', 'module');
    }

    public function executeCreate(sfWebRequest $request) {


        //Search from a previous one
        if($request->hasParameter('filename')){

            $filename = $request->getParameter('filename');
            $parameters = PlexParsing::retreiveParameters($filename);
            $params = ($parameters->getParametersArray($this->getUser()->getCulture()));
            $this->form = new SearchFlightForm();
            $this->form->bind($params);


        }else{

            $this->form = new SearchFlightForm();
            if ($this->getRequest()->getRequestFormat() == 'iphone') {
                $this->form = new SearchFlightIphoneForm();
            }
            if ($this->getRequest()->getRequestFormat() == 'ipad') {
                $this->form = new SearchFlightIpadForm();
            }

        }
       
        $this->processForm($request, $this->form);

        $this->setTemplate('index');
    }

    public function executeMultipleDestination(sfWebRequest $request) {
        $this->form = new MultiFlightCollectionForm();
    }

    public function executeAddPicForm($request) {
        
        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));

        
        $form = new MultiFlightCollectionForm();
        $form->addPicture($number);

        return $this->renderPartial('addSegment', array('form' => $form, 'num' => $number));
    }

    public function executeCreate2(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new MultiFlightCollectionForm();     
        $this->process2Form($request, $this->form);
        $this->setTemplate('multipleDestination');
    }

    protected function process2Form(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            
            $name = $form->getName();
            $parameters = $request->getPostParameters();
            
            echo "<pre>";
            print_r($parameters);
            //$type = $parameters[$name]['type'];
            //echo $type;
            break;

            $this->forward('process', 'index');
        }
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();
        $origin = $parameters['search_flight']['origin'];
        $destination = $parameters['search_flight']['destination'];

        //echo "<pre>";
        //print_r($parameters);
        //exit;
        //echo $origin;
        //echo $destination;
        //break;

        //Language issue - validation can't both ways english vs chinese

        $culture = $this->getUser()->getCulture();


        if($culture == 'zh_CN'){

            if ($form->isValid()) {
                $name = $form->getName();
                $type = $parameters[$name]['oneway'];
                $this->forward('process', 'index');
            }

        }else{

            //Validation Origin and Destination

            $originValidation = MyValidation::validateOriginDest($origin,$this->getRequest(),'origin', $this->getUser()->getCulture());
            $destinationValidation = MyValidation::validateOriginDest($destination, $this->getRequest(),'destination', $this->getUser()->getCulture());

            //var_dump($originValidation);
            //var_dump($destinationValidation);
            //break;

            //ob_start();
            //echo "<pre>";
            //print_r($this->getRequest()->getParameterHolder());

            if($form->isValid() && $originValidation === true && $destinationValidation === true){

                //$name = $form->getName();
                //$type = $parameters[$name]['oneway'];
                $this->forward('process', 'index');
            }
        }
        
    }

    public function executeResult(sfWebRequest $request) {
        $this->parameters = $request->getPostParameters();
    }

}
