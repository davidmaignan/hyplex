<?php

/**
 * basket actions.
 *
 * @package    hypertech_booking
 * @subpackage basket
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class basketActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

      $this->plexBasket = PlexBasket::getInstance();
      $this->flight = $this->plexBasket->getFlight();
      $this->parameters = array();


      if($this->flight !== null){
         $this->flightParameters = PlexParsing::retreiveParameters($this->plexBasket->getFlightFilename());
         $this->parameters['flight'] = $this->flightParameters;
      }

      $this->hotel = $this->plexBasket->getHotel();

      if($this->hotel !== null){
          $this->hotelParameters = PlexParsing::retreiveParameters($this->plexBasket->getHotelFilename());
          $this->parameters['hotel'] = $this->hotelParameters;
      }


  }

  public function executeRemoveDataBooking(sfWebRequest $request){

      $plexBasket = PlexBasket::getInstance();

      $plexBasket->arHotelBooking = array();

      $this->redirect('basket/index');

  }

  public function executeRemove(sfWebRequest $request){

      $type = $request->getParameter('type');

      $plexBasket = PlexBasket::getInstance();
      $plexBasket->remove($type);


      $this->redirect('basket/index');

  }
}
