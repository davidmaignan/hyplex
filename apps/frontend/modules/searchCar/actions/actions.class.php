<?php

/**
 * searchCar actions.
 *
 * @package    hyplexdemo
 * @subpackage searchCar
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchCarActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        $this->form = new SearchCarForm();

        /* if ($this->getRequest()->getRequestFormat() == 'iphone') {
            $this->form = new SearchFlightIphoneForm();
        }
        if ($this->getRequest()->getRequestFormat() == 'ipad') {
            $this->form = new SearchFlightIpadForm();
        }
        */
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

            $this->form = new SearchCarForm();
            /*if ($this->getRequest()->getRequestFormat() == 'iphone') {
                $this->form = new SearchFlightIphoneForm();
            }
            if ($this->getRequest()->getRequestFormat() == 'ipad') {
                $this->form = new SearchFlightIpadForm();
            }*/

        }

        $this->processForm($request, $this->form);

        $this->setTemplate('index');
        
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();
        $location1 = $parameters['search_car']['location1'];
        $location2 = $parameters['search_car']['location2'];

        //Language issue - validation can't both ways english vs chinese
        $culture = $this->getUser()->getCulture();


        if($culture == 'zh_CN'){

            if ($form->isValid()) {
                //$name = $form->getName();
                //$type = $parameters[$name]['oneway'];
                //$this->forward('process', 'index');
            }

        }else{

            //Validation Origin and Destination
            $originValidation = MyValidation::validateOriginDest($location1,$this->getRequest(),'location1', $this->getUser()->getCulture());
            $destinationValidation = MyValidation::validateOriginDest($location2, $this->getRequest(),'location2', $this->getUser()->getCulture());

            //var_dump($originValidation);
            //var_dump($destinationValidation);
            //exit;

            //$originValidation = true;
            //$destinationValidation = true;

            if($form->isValid() && $originValidation === true && $destinationValidation === true){

                //$name = $form->getName();
                //$type = $parameters[$name]['oneway'];
                //$this->forward('process', 'index');
                echo 'form is valid';
                exit;
            }
        }

    }


  
}
