<?php

/**
 * Hotel filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHotelFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Cities'), 'add_empty' => true)),
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'BaseImageLink' => new sfWidgetFormFilterInput(),
      'star_rating'   => new sfWidgetFormFilterInput(),
      'address1'      => new sfWidgetFormFilterInput(),
      'address2'      => new sfWidgetFormFilterInput(),
      'postalCode'    => new sfWidgetFormFilterInput(),
      'city'          => new sfWidgetFormFilterInput(),
      'state_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('State'), 'add_empty' => true)),
      'country_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'location_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parking'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'restaurant'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'internet'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'pool'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fitness'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'latitude'      => new sfWidgetFormFilterInput(),
      'longitude'     => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'cities_list'   => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'City')),
    ));

    $this->setValidators(array(
      'hotel_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Cities'), 'column' => 'id')),
      'name'          => new sfValidatorPass(array('required' => false)),
      'BaseImageLink' => new sfValidatorPass(array('required' => false)),
      'star_rating'   => new sfValidatorPass(array('required' => false)),
      'address1'      => new sfValidatorPass(array('required' => false)),
      'address2'      => new sfValidatorPass(array('required' => false)),
      'postalCode'    => new sfValidatorPass(array('required' => false)),
      'city'          => new sfValidatorPass(array('required' => false)),
      'state_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('State'), 'column' => 'id')),
      'country_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Country'), 'column' => 'id')),
      'location_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parking'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'restaurant'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'internet'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'pool'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fitness'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'latitude'      => new sfValidatorPass(array('required' => false)),
      'longitude'     => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'cities_list'   => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'City', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hotel_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addCitiesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.HotelCities HotelCities')
      ->andWhereIn('HotelCities.city_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Hotel';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'hotel_id'      => 'ForeignKey',
      'name'          => 'Text',
      'BaseImageLink' => 'Text',
      'star_rating'   => 'Text',
      'address1'      => 'Text',
      'address2'      => 'Text',
      'postalCode'    => 'Text',
      'city'          => 'Text',
      'state_id'      => 'ForeignKey',
      'country_id'    => 'ForeignKey',
      'location_id'   => 'Number',
      'parking'       => 'Boolean',
      'restaurant'    => 'Boolean',
      'internet'      => 'Boolean',
      'pool'          => 'Boolean',
      'fitness'       => 'Boolean',
      'latitude'      => 'Text',
      'longitude'     => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'cities_list'   => 'ManyKey',
    );
  }
}
