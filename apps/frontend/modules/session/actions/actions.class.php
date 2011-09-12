<?php

/**
 * session actions.
 *
 * @package    hypertech_booking
 * @subpackage session
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sessionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }

  public function executeTest(sfWebRequest $request){

      return $this->renderText('test session');

  }

  public function executeRenewStid(sfWebRequest $request){

      $keepAliveRequest = new PlexKeepAliveRequest($this->getUser()->getAttribute('sTId'));
      
      $response = $keepAliveRequest->executeRequest();

      $finalResponse = new PlexKeepAliveResponse($response);

      $finalResponse->checkResponseCode();
      $code = $finalResponse->responseCode;

      

      switch ($code) {
          case 0:

              $this->getUser()->setAttribute('sTId_time', (time() + sfConfig::get('app_plexSession_duration')));
              

              //return sfView::SUCCESS;
              break;

          default:
              //redirect to error page
              $this->redirect('error/sessionExpired');
              break;
      }

      $restTime = $this->getUser()->getAttribute('sTId_time') - time();
      $restTime = ($restTime > 0)?$restTime:0;

      $this->url = $this->generateUrl('session_renew', array('time'=> $restTime));
      //var_dump($this->url);

      //return $this->renderText($code);

      //echo html_entity_decode($response);
      //exit;

      //return $this->renderText(htmlentities($response));

  }



}
