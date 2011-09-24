<?php

/**
 * AirportTranslation form base class.
 *
 * @method AirportTranslation getObject() Returns the current form's model object
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAirportTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'city_name' => new sfWidgetFormInputText(),
      'country'   => new sfWidgetFormInputText(),
      'region'    => new sfWidgetFormInputText(),
      'lang'      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'city_name' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'country'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'region'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'lang'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('airport_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AirportTranslation';
  }

}
