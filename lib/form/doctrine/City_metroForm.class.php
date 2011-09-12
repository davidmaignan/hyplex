<?php

/**
 * City_metro form.
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class City_metroForm extends BaseCity_metroForm
{
  public function configure()
  {
      //unset($this['cities_list']);
  }

  public function  doSave($con = null) {

      //var_dump($this->getValues());

      //break;

      parent::doSave($con);
    }


}
