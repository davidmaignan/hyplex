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
  public function executePassenger(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $this->form = new BookingPassengersForm();


    $this->form->addPassenger(0, 'adult');
    $this->form->addPassenger(1, 'adult');


  }

  public function executeSetPassenger(sfWebRequest $request){

      $this->form = new BookingPassengersForm();
      $this->processForm($request, $this->form);
      $this->setTemplate('passenger');


  }

  protected function processForm(sfWebRequest $request, sfForm $form) {

     

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();

        //echo "<pre>";
        //print_r($parameters);
        //exit;

        //$origin = $parameters['search_hotel']['wherebox'];
        //$originValidation = MyValidation::validateOriginDest($origin,$this->getRequest(),'wherebox', $this->getUser()->getCulture());



        if ($form->isValid()) {
            $url = $this->generateUrl('booking_address');
            $this->redirect($url);
        }

        //exit;


    }

    public function executeSetAddress(sfWebRequest $request){

        $this->form = new AddressForm();
        


    }

    public function executeGetAddress(sfWebRequest $request){

        $this->form = new AddressForm();
        $this->processForm2($request, $this->form);
        $this->setTemplate('passenger');
    }

    protected function processForm2(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();

        echo "<pre>";
        print_r($parameters);
        exit;

        //$origin = $parameters['search_hotel']['wherebox'];
        //$originValidation = MyValidation::validateOriginDest($origin,$this->getRequest(),'wherebox', $this->getUser()->getCulture());



        if ($form->isValid()) {
            $url = $this->generateUrl('booking_address');
            $this->redirect($url);
        }

        //exit;


    }

}
