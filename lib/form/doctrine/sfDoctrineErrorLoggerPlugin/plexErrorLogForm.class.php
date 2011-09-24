<?php

/**
 * plexErrorLog form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class plexErrorLogForm extends PluginplexErrorLogForm
{
  public function configure()
  {
      $this->widgetSchema['parameters']->setAttributes(array('cols'=>'100','rows'=>'10'));
      $this->widgetSchema['plex_response']->setAttributes(array('cols'=>'100','rows'=>'30'));
      $this->widgetSchema['file']->setAttributes(array('class'=>'large'));
      $this->widgetSchema['class_name']->setAttributes(array('class'=>'large'));

  }
}
