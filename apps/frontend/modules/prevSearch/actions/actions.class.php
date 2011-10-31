<?php

/**
 * prevSearch actions.
 *
 * @package    hyplexdemo
 * @subpackage prevSearch
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class prevSearchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

  public function executePreviousSearch(sfWebRequest $request) {

      $filename = $request->getParameter('filename');
      $arType = explode('-', $filename);
      $type = $arType[0];

      $parameters = PlexParsing::retreiveParameters($filename);

      $filteredResponse = PlexFilterResponseFactory::factory(
                        $type, $filename, null, array()
      );

      //var_dump($plexFilter);

      $this->results = $filteredResponse->filteredObjs;

      $this->getUser()->setFlash('historic', $filename, true);

      $this->filterFormFinal = $filteredResponse->displayFilterForm();

      //$this->redirect($url);

  }

  public function executePreviousHotelSearch(sfWebRequest $request){

      $filename = $this->getUser()->getFlash('historic');

      $arType = explode('-', $filename);
      $type = $arType[0];

      //var_dump($type);
      //exit;

      $parameters = PlexParsing::retreiveParameters($filename);

      $plexFilter = new PlexFilterFactory($type, $filename, null, null);

      //var_dump($plexFilter);

      $this->results = $plexFilter->arObjs;



  }

  



}
