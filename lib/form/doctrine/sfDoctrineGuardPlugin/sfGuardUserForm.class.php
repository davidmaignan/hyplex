<?php

/**
 * sfGuardUser form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
      $this->useFields(array('username', 'first_name','last_name','email_address','password','is_active','is_super_admin','groups_list','permissions_list'));
  }
}
