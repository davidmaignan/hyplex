<?php

/**
 * research actions.
 *
 * @package    hypertech_booking
 * @subpackage research
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class researchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
    $culture = $this->getUser()->getCulture();
    $this->languageForm = new sfFormLanguage($this->getUser(), array('languages' => array('en', 'fr')));
    $this->foo = 'bar';
  }
}
