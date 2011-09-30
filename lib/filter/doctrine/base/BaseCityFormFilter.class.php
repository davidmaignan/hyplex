<?php

/**
 * City filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCityFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'airport'      => new sfWidgetFormFilterInput(),
      'country_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'state_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('State'), 'add_empty' => true)),
      'cache'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'archived'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'rank'         => new sfWidgetFormFilterInput(),
      'metropolitan' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'latitude'     => new sfWidgetFormFilterInput(),
      'longitude'    => new sfWidgetFormFilterInput(),
      'cities_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'City_metro')),
      'hotels_list'  => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Hotel')),
    ));

    $this->setValidators(array(
      'code'         => new sfValidatorPass(array('required' => false)),
      'airport'      => new sfValidatorPass(array('required' => false)),
      'country_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Country'), 'column' => 'id')),
      'state_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('State'), 'column' => 'id')),
      'cache'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'archived'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'rank'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'metropolitan' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'latitude'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitude'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cities_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'City_metro', 'required' => false)),
      'hotels_list'  => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Hotel', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('city_filters[%s]');

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
      ->leftJoin($query->getRootAlias().'.CityMultipleAirport CityMultipleAirport')
      ->andWhereIn('CityMultipleAirport.city_metro_id', $values)
    ;
  }

  public function addHotelsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('HotelCities.hotel_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'City';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'code'         => 'Text',
      'airport'      => 'Text',
      'country_id'   => 'ForeignKey',
      'state_id'     => 'ForeignKey',
      'cache'        => 'Boolean',
      'archived'     => 'Boolean',
      'rank'         => 'Number',
      'metropolitan' => 'Boolean',
      'latitude'     => 'Number',
      'longitude'    => 'Number',
      'cities_list'  => 'ManyKey',
      'hotels_list'  => 'ManyKey',
    );
  }
}
