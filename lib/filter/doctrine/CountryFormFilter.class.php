<?php

/**
 * Country filter form.
 *
 * @package    hypertech_booking
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CountryFormFilter extends BaseCountryFormFilter
{
  public function configure()
  {
      $this->widgetSchema['name'] = new sfWidgetFormFilterInput();
      $this->validatorSchema['name'] = new sfValidatorPass();

  }

  public function addNameColumnQuery($query, $field, $value)
  {
      Doctrine::getTable('country')->applyNameFilter($query, $value);
  }

  
}
