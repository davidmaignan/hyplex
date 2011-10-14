<?php

/**
 * Passenger form base class.
 *
 * @method Passenger getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePassengerForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'salutation'            => new sfWidgetFormChoice(array('choices' => array('Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Dr' => 'Dr'))),
      'first_name'            => new sfWidgetFormInputText(),
      'middle_name'           => new sfWidgetFormInputText(),
      'last_name'             => new sfWidgetFormInputText(),
      'gender'                => new sfWidgetFormChoice(array('choices' => array('male' => 'male', 'female' => 'female'))),
      'dob'                   => new sfWidgetFormInputText(),
      'p_type'                => new sfWidgetFormChoice(array('choices' => array('ADT' => 'ADT', 'CHD' => 'CHD'))),
      'frequent_flyer_number' => new sfWidgetFormInputText(),
      'airline_code'          => new sfWidgetFormInputText(),
      'meal_preference'       => new sfWidgetFormInputText(),
      'special_assistance'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'salutation'            => new sfValidatorChoice(array('choices' => array(0 => 'Mr', 1 => 'Ms', 2 => 'Mrs', 3 => 'Dr'), 'required' => false)),
      'first_name'            => new sfValidatorString(array('max_length' => 100)),
      'middle_name'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'             => new sfValidatorString(array('max_length' => 100)),
      'gender'                => new sfValidatorChoice(array('choices' => array(0 => 'male', 1 => 'female'), 'required' => false)),
      'dob'                   => new sfValidatorString(array('max_length' => 10)),
      'p_type'                => new sfValidatorChoice(array('choices' => array(0 => 'ADT', 1 => 'CHD'), 'required' => false)),
      'frequent_flyer_number' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'airline_code'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'meal_preference'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'special_assistance'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('passenger[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Passenger';
  }

}
