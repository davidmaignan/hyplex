<?php

/**
 * error actions.
 *
 * @package    hypertech_booking
 * @subpackage error
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class errorActions extends sfActions
{

  public function  preExecute() {
      $request = sfContext::getInstance()->getRequest();

      if($request->getRequestFormat() == 'iphone' || $request->getRequestFormat() == 'ipad')
      {
            $this->setLayout('layout');
      }

      parent::preExecute();
    }


 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    
  }

  public function executePlexError(sfWebRequest $request)
  {
      
  }

  public function executeSessionExpired(sfWebRequest $request)
  {
      //Delete the sTid in the user class
      //$this->getUser()->setAttribute('sTId', null);

      //Tell basket object any product is obsolete and need to be checked for availability


      //forward to previous url and request a new stId as it is a brand new request. an initial request for a new sTid and then
      //perform the request again

      $parameters = $request->getParameterHolder();
      //var_dump($parameters);
      //exit;
      
  }

  public function executeNotImplemented(sfWebRequest $request)
  {

  }

  public function executeNotFound(sfWebRequest $request)
  {
        
  }

}
