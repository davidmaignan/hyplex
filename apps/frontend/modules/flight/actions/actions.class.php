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

    /*
     * Return Flight section
     */

    public function executeFlightResult(sfWebRequest $request) {

        //$filename = $this->getUser()->getFlash('filename');
        //$filename = '/Users/david/Sites/Hypertech/cache/4d9877dce4a9c/flightReturn-6WFj4N';
        //Get the last filename
        $prevSearches = $this->getUser()->getAttribute('prevSearch');
        //var_dump($prevSearches);

        $prevSearche = $prevSearches[count($prevSearches) - 1];
        $filename = $prevSearche['file'];

        //echo $filename;
        //break;

        $this->page = 1;


        //Retrieve the search parameters.
        $this->parameters = Utils::retreiveParameters($filename);

        //var_dump($this->parameters);
        //echo $this->parameters->getType();
        //break;

        $filteredResponse = PlexFilterResponseFactory::factory(
                        $this->parameters->getType(), $filename, $this->page, array()
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
        
        $this->filterFormFinal = $filteredResponse->displayFilterForm();
        $this->filterValues = json_encode($filteredResponse->getDatasForFilterForm());

        if ($request->getRequestFormat() == 'iphone') {
            $this->setLayout('layout');
        }

        switch ($this->parameters->getType()) {
            case 'flightReturn':
                $this->setTemplate('flightResult');
                break;

            case 'flightOneway':
                $this->setTemplate('flightOneway');
                break;

            default:
                break;
        }

        //$this->setTemplate('test');
        //sfConfig::set('sf_escaping_strategy', false);
    }

    public function executeFilterFlight(sfWebRequest $request) {
        $this->parameters = $request->getPostParameters();

        $type = $request->getPostParameter('type');
        $filename = $request->getPostParameter('filename');
        $filteredResponse = PlexFilterResponseFactory::factory(
                        $type, $filename, 1, $this->parameters
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

}
