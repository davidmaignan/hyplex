<?php

/**
 * searchPackage actions.
 *
 * @package    hyplexdemo
 * @subpackage searchPackage
 * @author     David Maignan
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchPackageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new SearchPackageForm();
  }

  public function executeCreate(sfWebRequest $request) {

        //Search from a previous one
        if ($request->hasParameter('filename')) {

            $filename = $request->getParameter('filename');
            $parameters = PlexParsing::retreiveParameters($filename);
            $params = ($parameters->getParametersArray($this->getUser()->getCulture()));
            $this->form = new SearchFlightForm();
            $this->form->bind($params);
            
        } else {

            $this->form = new SearchPackageForm();
            if ($this->getRequest()->getRequestFormat() == 'iphone') {
                $this->form = new SearchFlightIphoneForm();
            }
            if ($this->getRequest()->getRequestFormat() == 'ipad') {
                $this->form = new SearchFlightIpadForm();
            }
        }

        $this->processForm($request, $this->form);

        $this->setTemplate('index');
    }

        protected function processForm(sfWebRequest $request, sfForm $form) {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $parameters = $request->getPostParameters();
        $origin = $parameters['search_package']['origin'];
        $destination = $parameters['search_package']['destination'];

        //Language issue - validation can't both ways english vs chinese

        $culture = $this->getUser()->getCulture();


        if($culture == 'zh_CN'){

            if ($form->isValid()) {
                //$name = $form->getName();
                //$type = $parameters[$name]['oneway'];
                //$this->forward('process', 'index');
            }

        }else{

            //Validation Origin and Destination

            //$originValidation = MyValidation::validateOriginDest($origin,$this->getRequest(),'origin', $this->getUser()->getCulture());
            //$destinationValidation = MyValidation::validateOriginDest($destination, $this->getRequest(),'destination', $this->getUser()->getCulture());

            $originValidation = true;
            $destinationValidation = true;

            if($form->isValid() && $originValidation === true && $destinationValidation === true){

                //$name = $form->getName();
                //$type = $parameters[$name]['oneway'];
                $this->forward('process', 'index');
            }
        }

    }


    /**
     * Ajax called to add extra room / hotel search
     * @param sfRequest $request A request object
     */
    public function executeAddRoomForm(sfWebRequest $request){

        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));

        $form = new SearchPackageForm();
        $form->addRoom($number);
        return $this->renderPartial('searchPackage/addRoom', array('form' => $form, 'num' => $number));
    }

    public function executeAddRoomForm2(sfWebRequest $request){

        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));

        $form = new SearchPackageForm();
        $form->addRoom($number);
        return $this->renderPartial('addRoom2', array('form' => $form, 'num' => $number));
    }

    /**
     * Ajax called to add children age menu / room
     *
     * @param sfRequest $request A request object
     */
    public function executeAddChildrenAge(sfWebRequest $request){

        $this->forward404unless($request->isXmlHttpRequest());
        $number = intval($request->getParameter("num"));
        $roomNumber = intval($request->getParameter("roomNumber"));
        $form = new SearchPackageForm();
        $form->addChildrenAge($roomNumber, $number);

        return $this->renderPartial('searchPackage/addChildrenAge', array('form' => $form, 'num' => $number, 'roomNumber'=>$roomNumber));
    }

}
