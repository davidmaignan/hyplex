<?php

/**
 * Area form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreaForm extends BaseAreaForm
{
  public function configure()
  {
      $languages = sfConfig::get('app_languages_available');
      $this->embedI18n($languages);
  }
}
