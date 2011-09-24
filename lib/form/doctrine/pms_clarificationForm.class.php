<?php

/**
 * pms_clarification form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pms_clarificationForm extends Basepms_clarificationForm
{
  public function configure()
  {
      $this->setWidget('message', new sfWidgetFormTextarea(array(), array('cols'=>'50', 'rows'=>'10')));
      $this->setWidget('answer', new sfWidgetFormTextarea(array(), array('cols'=>'50', 'rows'=>'10')));
  }
}
