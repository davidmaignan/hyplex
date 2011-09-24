<?php

/**
 * HotelCities form base class.
 *
 * @method HotelCities getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHotelCitiesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hotel_id' => new sfWidgetFormInputHidden(),
      'city_id'  => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'hotel_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('hotel_id')), 'empty_value' => $this->getObject()->get('hotel_id'), 'required' => false)),
      'city_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('city_id')), 'empty_value' => $this->getObject()->get('city_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hotel_cities[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'HotelCities';
  }

}
