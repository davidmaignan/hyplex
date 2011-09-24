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

        //var_dump($request->getParameter('test'));
        //break;


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
        //$this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new SearchFlightForm();
        if ($this->getRequest()->getRequestFormat() == 'iphone') {
            $this->form = new SearchFlightIphoneForm();
        }
        if ($this->getRequest()->getRequestFormat() == 'ipad') {
            $this->form = new SearchFlightIpadForm();
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

        //var_dump($parameters);
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
