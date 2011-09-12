<?php

/**
 * basket actions.
 *
 * @package    hypertech_booking
 * @subpackage basket
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class basketComponents extends sfComponents {

    public function preExecute() {
        $request = sfContext::getInstance()->getRequest();

        if ($request->getRequestFormat() == 'iphone' || $request->getRequestFormat() == 'ipad') {
            if (!$request->isXmlHttpRequest()) {
                $this->setLayout('layout');
            }
        }

        parent::preExecute();
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {
        //$this->forward('default', 'module');

        $requestFile = sfConfig::get('sf_user_folder').DIRECTORY_SEPARATOR.'request';

        $handle = fopen($requestFile, 'rb');

        while(!feof($handle)){

            $content = fgets($handle);

            if(preg_match('#flight#', $content)){

                break;

            }

        }

        $arContent = explode('|', $content);
        //var_dump($arContent);

        $fligthParameters = unserialize($arContent[3]);
        $this->flightDatas = $fligthParameters->getParametersArray($this->getUser()->getCulture());
        


    }

    public function executeHome(sfWebRequest $request){
        
    }
    

}
