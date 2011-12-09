<?php

/**
 * templates actions.
 *
 * @package    hyplexdemo
 * @subpackage templates
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class templatesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->flightForm = new SearchFlightForm();
    $this->hotelForm = new SearchHotelForm();
  }
  
  public function executeFlight(sfWebRequest $request){
      
      $folder = sfConfig::get('sf_user_folder');
      
      $this->filename = 'flightReturn-SidSpU';
      $this->parameters = PlexParsing::retreiveParameters($this->filename);
      
      $this->filteredResponse = PlexFilterResponseFactory::factory(
                        $this->parameters->getType(), $this->filename, $this->page, array()
      );
      
      //Flights objects
      $this->results = $this->filteredResponse->filteredObjs;
      
      //Values for filterFrom
      $this->filterValues = json_encode($this->filteredResponse->getDatasForFilterForm());

      
      
  }
}
