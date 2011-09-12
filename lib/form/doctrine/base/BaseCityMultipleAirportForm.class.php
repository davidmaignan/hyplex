<?php

/**
 * CityMultipleAirport form base class.
 *
 * @method CityMultipleAirport getObject() Returns the current form's model object
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCityMultipleAirportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'city_id'       => new sfWidgetFormInputHidden(),
      'city_metro_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'city_id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('city_id')), 'empty_value' => $this->getObject()->get('city_id'), 'required' => false)),
      'city_metro_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('city_metro_id')), 'empty_value' => $this->getObject()->get('city_metro_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('city_multiple_airport[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CityMultipleAirport';
  }

}
