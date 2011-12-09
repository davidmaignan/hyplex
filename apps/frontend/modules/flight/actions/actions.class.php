<?php

/**
 * flight actions.
 *
 * @package    hypertech_booking
 * @subpackage flight
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class flightActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function preExecute() {
        $request = sfContext::getInstance()->getRequest();

        if ($request->getRequestFormat() == 'iphone' || $request->getRequestFormat() == 'ipad') {
            if (!$request->isXmlHttpRequest()) {
                $this->setLayout('layout');
            }
        }

        parent::preExecute();
    }

    public function executeFlightModified(sfWebRequest $request){

        $filename = $request->getParameter('filename');
        $parameters = PlexParsing::retreiveParameters($filename);
        $type = ($parameters->oneway == 0)? 'flightReturn': 'flightOneway';

         switch ($type) {
              case 'flightOneway':
                  $url = $this->generateUrl('flight_oneway', array(
                      'origin'=>$parameters->getOrigin(),
                      'destination'=>$parameters->getDestination(),
                      'depart_date'=>$parameters->depart_date
                  ));
                  break;

              case 'flightReturn':
                  $url = $this->generateUrl('flight_return', array(
                      'origin'=>$parameters->getOrigin(),
                      'destination'=>$parameters->getDestination(),
                      'depart_date'=>$parameters->depart_date,
                      'return_date'=>$parameters->return_date
                  ));
              break;
         }

        PlexParsing::moveSearchToTheEnd($this->getUser(), $filename);

        $this->redirect($url);

    }

    /*
     * Return Flight section
     */
    public function executeFlightResult(sfWebRequest $request) {

        switch (true) {
              case  $this->getUser()->hasFlash('filename'):
                  $this->filename = $this->getUser()->getFlash('filename');
                  break;

              case $request->hasParameter('filename'):
                  $this->filename = $request->getParameter('filename');

              default:
                  $prevSearches = $this->getUser()->getAttribute('prevSearch');
                  $prevSearche = end($prevSearches);
                  $this->filename = $prevSearche['filename'];
                  break;
          }
          
        $this->page = 1;

        //Retrieve the search parameters.
        $this->parameters = PlexParsing::retreiveParameters($this->filename);

        $filteredResponse = PlexFilterResponseFactory::factory(
                        $this->parameters->getType(), $this->filename, $this->page, array()
        );

        $this->filterResponse = $filteredResponse;

        switch ($this->parameters->getType()) {
            case 'flightReturn':
                $this->form = new SearchFlightForm($this->parameters->getParametersArray($this->getUser()->getCulture()));
                break;

            case 'flightOneway':
                $this->form = new SearchFlightForm($this->parameters->getParametersArray($this->getUser()->getCulture()));
                break;

            default:
                break;
        }

        
        if ($this->getRequest()->getRequestFormat() == 'iphone') {
            $this->form = new SearchFlightIphoneForm();
        }
        if ($this->getRequest()->getRequestFormat() == 'ipad') {
            $this->form = new SearchFlightIpadForm($this->parameters->arParams);
        }

        $this->results = $filteredResponse->filteredObjs;
        $this->matrix = $filteredResponse->getMatrix();
        
        $this->filteredResponse = $filteredResponse;
        $this->filterValues = json_encode($filteredResponse->getDatasForFilterForm());

        if ($request->getRequestFormat() == 'iphone') {
            $this->setLayout('layout');
        }

        switch ($this->parameters->getType()) {
            case 'flightReturn':
                $this->type = 'flightReturn';
                break;

            case 'flightOneway':
                $this->type = 'flightOneway';
                break;

            default:
                break;
        }

        $this->setTemplate('flightResult');

    }

    public function executeFilterFlight(sfWebRequest $request) {
        $this->parameters = $request->getPostParameters();

        $type = $request->getPostParameter('type');
        $this->filename = $request->getPostParameter('filename');
        $filteredResponse = PlexFilterResponseFactory::factory(
                        $type, $this->filename, 1, $this->parameters
        );

        $this->results = $filteredResponse->filteredObjs;
        $this->type = $request->getPostParameter('type');
        
    }

    public function executeDemo($request) {
        if ($request->getRequestFormat() == 'iphone') {
            $this->setLayout('layout');
        }
    }

    public function executeNotFound($request) {
        if ($request->getRequestFormat() == 'iphone') {
            $this->setLayout('layout');
        }

        $this->parameters = $this->getUser()->getFlash('parameters');
    }

    public function executeSelected(sfWebRequest $request){

        $filename = $request->getParameter('filename');
        $uniqueReferenceId = $request->getParameter('uniqueReferenceId');

        $flight = PlexParsing::retreiveFlight($filename, $uniqueReferenceId);

        if($flight){
            $plexBasket = PlexBasket::getInstance();
            $plexBasket->addFlight($filename, $uniqueReferenceId);
            $this->redirect('basket/index');
        }

        $this->redirect('error/missingFlight');
    }

}
