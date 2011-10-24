<?php

/**
 * AreaTranslation form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AreaTranslationForm extends BaseAreaTranslationForm
{
  public function configure()
  {
      unset($this['slug']);
  }
}
