<?php

/**
 * Project form base class.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
      unset($this['created_at'],$this['updated_at']);
      if($this->isI18n()){
            $languages = sfConfig::get('app_languages_available');
            $this->embedI18n($languages);
        }
  }

}
