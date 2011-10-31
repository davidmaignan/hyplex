<?php

/**
 * process actions.
 *
 * @package    hypertech_booking
 * @subpackage process
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class processActions extends sfActions
{

 /**
  * Executes index action
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

      //$this->getUser()->setAttribute('sTId', null);

      //Debuggind mode
      $debug = false;

      if($request->hasParameter('search_flight')){
          $parameters = $request->getParameter('search_flight');
          $type = ($parameters['oneway'] == 0)? 'flightReturn': 'flightOneway';
      }else if($request->hasParameter('search_hotel')){
          $parameters = $request->getParameter('search_hotel');
          $type = 'hotelSimple';
      }

      //Temporary redirection to notImplemented page
      switch ($type) {
          case 'flightReturn':

              break;

          case 'flightOneway':

              break;

          case 'hotelSimple':

              break;

          default:
              $this->redirect('error/notImplemented');
              break;
      }

      $paramFactory = PlexParametersFactory::factory($type, $parameters, $this->getUser()->getCulture());

     
      //$searchParametersArray = $paramFactory->getParametersArray($this->getUser()->getCulture());
      //If error in parameter class

      if($paramFactory->problemWithCode === true){

          $this->forward('searchFlight', 'index');
          
      }else{

        //Improve ranking of the city
        $q = Doctrine::getTable('city')->addRank($paramFactory->getCodes());

      }

      if($debug === false){
      
          //Create PlexRequest Object - Generate a sessionTokenId or reuse cached one
          $plexRequest = PlexRequestFactory::factory($type, $request, $paramFactory);

          //Build xml with search parameters
          $plexRequest->buildXML();
          $response = $plexRequest->executeRequest();

      }else{
          
          $filename = sfConfig::get('sf_data_dir').'/rawplexresponse/flightOneWay.xml';
          $response = file_get_contents($filename);
      }

      //Create PlexResponse Object
      $finalResponse = PlexResponseFactory::factory($type, $response, $request, $paramFactory, false);

      //Check what response code and take appropriate action
      /*
        0   Success
        1   System Error
        3   Invalid Request
        4   Required Fields are missing
        5   Backend application not available
        6   Session Expired
        7   Invalid PNR
        8   PNR Could not be Imported
        9   Hotel no longer available
        10  Data not found
      */      


      switch ($finalResponse->checkResponseCode()) {
          case '0':
              $finalResponse->parseResponse();
              break;

          case '3':
              $this->getUser()->setFlash('parameters', $parameters);
              $datas = array();
              $datas['type'] = $this->type;
              $datas['infosUser'] = Utils::retreiveUserInfos($request);
              $datas['header'] = Utils::getHeader($finalResponse->filename);
              $datas['code']= 3;
              $datas['userFolder'] = sfConfig::get('sf_user_folder');
              $datas['filename'] = $finalResponse->filename;
              $datas['params'] = $paramFactory;

              //Save info in db
              //$event = new sfEvent($this, 'plex.response_success', array('datas' => $datas));
              //sfContext::getInstance()->getEventDispatcher()->notify($event);
              
              $this->redirect('flight/notFound');
              break;

          case '6':
              $this->forward('error', 'SessionExpired');
              break;

          case '9':
              $this->getUser()->setFlash('parameters', $parameters);
              $datas = array();
              $datas['type'] = $this->type;
              $datas['infosUser'] = Utils::retreiveUserInfos($request);
              $datas['header'] = Utils::getHeader($finalResponse->filename);
              $datas['code']= 9;
              $datas['userFolder'] = sfConfig::get('sf_user_folder');
              $datas['filename'] = $finalResponse->filename;
              $datas['params'] = $paramFactory;

              //Save info in db
              //$event = new sfEvent($this, 'plex.response_success', array('datas' => $datas));
              //sfContext::getInstance()->getEventDispatcher()->notify($event);

              $this->redirect('hotel/notFound');
              break;

          case '10':
              $this->getUser()->setFlash('parameters', $parameters);
              $datas = array();
              $datas['type'] = $this->type;
              $datas['infosUser'] = Utils::retreiveUserInfos($request);
              $datas['header'] = Utils::getHeader($finalResponse->filename);
              $datas['code']= 10;
              $datas['userFolder'] = sfConfig::get('sf_user_folder');
              $datas['filename'] = $finalResponse->filename;
              $datas['params'] = $paramFactory;

              //Save info in db
              //$event = new sfEvent($this, 'plex.response_success', array('datas' => $datas));
              //sfContext::getInstance()->getEventDispatcher()->notify($event);
              
              $this->redirect('flight/notFound');
              break;

          default:
             $this->redirect('error/plexError');
             break;
      }
      
      //Let's continue - object creation.
      $finalResponse->analyseResponse();




      //Check airlines and add new ones.
      $airlines = Utils::createAirlineArray();
      $newAirlines = array_diff_key($finalResponse->listAirlines, $airlines);

      if(!empty($newAirlines)){
          unset($GLOBALS['airlines']);
          $q = Doctrine::getTable('airline')->savelist($newAirlines);
          unlink($fileAirline = sfConfig::get('sf_data_dir') . '/airline/airlines.yml');
          Utils::createAirlineArray();
      }


      //Check hotelChain and add new ones
      $hotelChains = Utils::createHotelchainArray();
      
      $listChains = $finalResponse->listChains;

      //Remove key 00 for independant hotel
      $key = array_search('00', $listChains);
      if($key !== false){
          unset($listChains[$key]);
      }

      $newHotelChain = array_diff($listChains, array_keys($hotelChains));


      if(!empty($newHotelChain)){
          unset($GLOBALS['hotelchain']);
          $q = Doctrine::getTable('hotelchain')->savelist($newHotelChain);
          unlink($fileHotelchain = sfConfig::get('sf_data_dir') . '/hotel/hotelChains.yml');
          Utils::createHotelchainArray();
      }  

      //Redirection 
      switch ($type) {
          case 'flightOneway':
              $url = $this->generateUrl('flight_oneway', array(
                  'origin'=>$paramFactory->getOrigin(),
                  'destination'=>$paramFactory->getDestination(),
                  'depart_date'=>$paramFactory->depart_date
              ));
              break;

          case 'flightReturn':
              $url = $this->generateUrl('flight_return', array(
                  'origin'=>$paramFactory->getOrigin(),
                  'destination'=>$paramFactory->getDestination(),
                  'depart_date'=>$paramFactory->depart_date,
                  'return_date'=>$paramFactory->return_date
              ));
              break;

          case 'hotelSimple':
              $url = $this->generateUrl('hotel_simple',array(
                  'wherebox'=>$paramFactory->getWhereBox(),
                  'checkin_date'=>$paramFactory->getCheckinDate(),
                  'checkout_date'=>$paramFactory->getCheckoutDate()
              ));
              break;

          default:
              
              break;
      }
      
      
      $this->getUser()->setFlash('filename', $finalResponse->filename,true);
      //$q = Doctrine::getTable('city')->addRank($paramFactory);

      $this->redirect($url);

  }

  
}
