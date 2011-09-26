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
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->prevSearches = PlexParsing::retreivePrevSearches();
  }

  /**
  * Executes flight action
  *
  * @param sfRequest $request A request object
  */
  public function executeFlight(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->prevSearches = PlexParsing::retreivePrevSearches('flight');

  }


  /**
  * Executes hotel action
  *
  * @param sfRequest $request A request object
  */
  public function executeHotel(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->prevSearches = PlexParsing::retreivePrevSearches('hotel');

  }


}
