<?php

/**
 * City filter form.
 *
 * @package    hypertech_booking
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CityFormFilter extends BaseCityFormFilter
{
  public function configure()
  {
      //$this->widgetSchema['country_id']->addOption('order_by',array('code','asc'));
      $this->widgetSchema['name'] = new sfWidgetFormFilterInput();
      $this->validatorSchema['name'] = new sfValidatorPass();
  }

  public function addNameColumnQuery($query, $field, $value)
  {
      Doctrine::getTable('city')->applyNameFilter($query, $value);
  }

  public function getFields()
  {
    $fields = parent::getFields();
    $fields['name'] = 'custom';
    return $fields;
  }

}
