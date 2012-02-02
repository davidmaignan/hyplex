<?php

/**
 * prevSearch actions.
 *
 * @package    hyplexdemo
 * @subpackage prevSearch
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class prevSearchComponents extends sfComponents
{
 /**
  * Executes index action - Return previous searches
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->prevSearches = PlexParsing::retreivePrevSearches();
  }
  
  public function executeAccount(sfWebRequest $request){
  	
  	$prevSearches = PlexParsing::retreivePrevSearches();
  	
  	$this->prevSearches = array('flight'=>array(),'hotel'=>array());
  	
  	foreach($prevSearches as $prevSearch){
  		
  		$values = PlexParsing::retreiveFilterDatas($prevSearch['file'], $prevSearch['type']);
  		$prevSearch['filterDatas'] = $values;
  		
  		switch($prevSearch['type']){
  			
  			case 'flightReturn':
  				array_push($this->prevSearches['flight'], $prevSearch);
  				break;
  			case 'flightSimple':
  				array_push($this->prevSearches['flight'], $prevSearch);
  				break;
  			case 'hotelSimple':
  				array_push($this->prevSearches['hotel'], $prevSearch);
  				break;
  			
  		}
  		
  	}
  	
  	
  }

  /**
  * Executes flight action - Return previous flight searches
  *
  * @param sfRequest $request A request object
  */
  public function executeFlight(sfWebRequest $request)
  {
    $this->prevSearches = PlexParsing::retreivePrevSearches('flight');
  }


  /**
  * Executes hotel action - Return previous hotel searches
  *
  * @param sfRequest $request A request object
  */
  public function executeHotel(sfWebRequest $request)
  {
    $this->prevSearches = PlexParsing::retreivePrevSearches('hotel');
  }


  /**
  * Executes Package action - Return previous package searches
  *
  * @param sfRequest $request A request object
  */
  public function executePackage(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->prevSearches = PlexParsing::retreivePrevSearches('package');

  }


}
