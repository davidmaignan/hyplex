<?php

/**
 * autocomplete actions.
 *
 * @package    hyplexdemo
 * @subpackage autocomplete
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class autocompleteActions extends sfActions
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

  public function executeCountry(sfWebRequest $request){

      $search = $request->getParameter('name_startsWith');

      //return $this->renderText($search);

      $q = Doctrine::getTable('country')->searchAutoComplete($search);

      $resultJSON = json_encode(array('values'=>$search,'results'=>$q));

      return $this->renderText($resultJSON);

  }

  public function executeState(sfWebRequest $request){

      $search = $request->getParameter('name_startsWith');

      //return $this->renderText($search);

      $q = Doctrine::getTable('state')->searchAutoComplete($search);

      $resultJSON = json_encode(array('values'=>$search,'results'=>$q));

      return $this->renderText($resultJSON);

  }

  public function executeSearchAirportComplete2(sfWebRequest $request){

        $search = $request->getParameter('name_startsWith');

        $q = Doctrine::getTable('city')->searchAutoComplete($search);

        $resultJSON = json_encode(array('values'=>$search,'results'=>$q));

        return $this->renderText($resultJSON);


  }



}
