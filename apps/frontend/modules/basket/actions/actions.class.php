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
    //$this->forward('default', 'module');

      $this->plexBasket = PlexBasket::getInstance();

      $this->flight = $this->plexBasket->getFlight();

      //echo "<pre>";
      //print_r($this->plexBasket);
      //exit;

      if($this->flight !== null){
         $this->flightParameters = PlexParsing::retreiveParameters($this->plexBasket->getFlightFilename());
      }

      $this->hotel = $this->plexBasket->getHotel();

      if($this->hotel !== null){
          $this->hotelParameters = PlexParsing::retreiveParameters($this->plexBasket->getHotelFilename());
      }

      //$this->rooms = $this->plexBasket->getRooms();

      //var_dump($fligthParameters);
      //exit;
  }

  public function executeRemoveDataBooking(sfWebRequest $request){

      $plexBasket = PlexBasket::getInstance();

      //$plexBasket = new PlexBasket();

      $plexBasket->arHotelBooking = array();

      $this->redirect('basket/index');

      
  }

  public function executeRemove(sfWebRequest $request){

      $type = $request->getParameter('type');

      $plexBasket = PlexBasket::getInstance();
      $plexBasket->remove($type);


      //var_dump($type);
      //exit;

      $this->redirect('basket/index');

  }
}
