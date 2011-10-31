<?php

/**
 * sfGuardPermission form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardPermissionForm extends PluginsfGuardPermissionForm
{
  public function configure()
  {
      $this->widgetSchema['groups_list']->setAttributes(array('class'=>'medium'));
      $this->widgetSchema['users_list']->setAttributes(array('class'=>'medium'));
      $this->widgetSchema['description']->setAttributes(array('cols'=>'100','rows'=>'6'));
      $this->widgetSchema['name']->setAttributes(array('class'=>'large'));
      
  }
}
