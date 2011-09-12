<?php

/**
 * RequestPlex form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RequestPlexForm extends BaseRequestPlexForm
{
  public function configure()
  {
      $this->widgetSchema['search_infos']->setAttributes(array('cols'=>'100','rows'=>'6'));
      $this->widgetSchema['header_raw']->setAttributes(array('cols'=>'100','rows'=>'10'));
      $this->widgetSchema['response_raw']->setAttributes(array('cols'=>'100','rows'=>'30'));
      $this->widgetSchema['header']->setAttributes(array('cols'=>'100','rows'=>'10'));
      $this->widgetSchema['response_processed']->setAttributes(array('cols'=>'100','rows'=>'30'));
  }
}
