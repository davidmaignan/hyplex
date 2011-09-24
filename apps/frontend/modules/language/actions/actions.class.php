<?php

class languageActions extends sfActions
{
  public function executeChangeLanguage(sfWebRequest $request)
  {

    $form = new sfFormLanguage(
      $this->getUser(),
      array('languages' => array('en', 'fr','zh'))
    );

    $form->process($request);

    //Delete the previous cookie
    $this->getResponse()->setCookie('hypertech_culture', null, time()-3600);

    return $this->redirect('@localized_homepage');
  }


}