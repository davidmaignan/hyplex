<?php

/**
 * booking actions.
 *
 * @package    hyplexdemo
 * @subpackage booking
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bookingActions extends sfActions
{
    
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeGetPassenger(sfWebRequest $request)
  {

    $plexBasket = PlexBasket::getInstance();
    $numbPassengers = $plexBasket->getTotalPassengers();

    $numbAdults = $plexBasket->getAdults();
    $numbChildren = $plexBasket->getChildren();

    $this->form = new BookingPassengersForm();
    
    for($i=0;$i<$numbAdults;$i++){
        $this->form->addAdult($i);
    }

    for($i=0;$i<$numbChildren;$i++){
        $this->form->addChild($i);
    }
    
  }

  public function executeSetPassenger(sfWebRequest $request){

      $this->form = new BookingPassengersForm();
      $this->processForm($request, $this->form);
      $this->setTemplate('getPassenger');


  }

  protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();

        if ($form->isValid()) {

            unset($parameters['booking_passengers']['_csrf_token']);

            $plexBasket = PlexBasket::getInstance();
            $plexBasket->addBookingPassengers($parameters['booking_passengers']);

            $url = $this->generateUrl('booking_address');
            $this->redirect($url);
        }

    }

    public function executeGetAddress(sfWebRequest $request){

        $this->form = new AddressForm();

    }

    public function executeSetAddress(sfWebRequest $request){

        $this->form = new AddressForm();
        $this->processForm2($request, $this->form);
        $this->setTemplate('getAddress');
    }

    protected function processForm2(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();

        if ($form->isValid()) {
            //var_dump('form is valid');

            $plexBasket = PlexBasket::getInstance();
            $plexBasket->addBookingAddress($parameters['address']);

            $this->redirect('booking/process');
        }

    }

    public function executeConfirmation(sfWebRequest $request){




    }

    public function executeProcess(sfWebRequest $request){

        $parameters = $request->getPostParameters();

        $plexRequest = new PlexBookingRequest('booking', $request, $parameters['address']);
        $plexRequest->buildXML();
        $filename = $plexRequest->executeRequest();
        
        //$filename = sfConfig::get('sf_user_folder').'/booking-rFW7Zi.raw';
        //var_dump($response);
        //exit;

        $finalResponse = new PlexBookingResponse($filename);
        $finalResponse->checkResponseCode();
        $code = $finalResponse->responseCode;



        switch ($code) {
          case '0':
              $finalResponse->parseResponse();
              break;

          case '3':
              $this->forward('error', 'SessionExpired');
              break;

          case '6':
              $this->forward('error', 'SessionExpired');
              break;

          case '9':
              $this->forward('error', 'SessionExpired');
              break;

          case '10':
             $this->forward('error', 'SessionExpired');
              break;

          default:
             $this->redirect('error/plexError');
             break;
      }

      //Let's continue - object creation.
      $bookingId = $finalResponse->analyseResponse();

      $this->getUser()->addBookingId($bookingId);


      $this->redirect('booking/confirmed');


    }

    public function executeConfirmed(sfWebRequest $request){

        $this->bookingId = $this->getUser()->getLastBookingId();

    }

    

}
