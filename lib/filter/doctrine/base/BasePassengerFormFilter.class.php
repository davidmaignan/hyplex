<?php

/**
 * Passenger filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePassengerFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'salutation'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Dr' => 'Dr'))),
      'first_name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'middle_name'           => new sfWidgetFormFilterInput(),
      'last_name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gender'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'male' => 'male', 'female' => 'female'))),
      'dob'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'p_type'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'ADT' => 'ADT', 'CHD' => 'CHD'))),
      'frequent_flyer_number' => new sfWidgetFormFilterInput(),
      'airline_code'          => new sfWidgetFormFilterInput(),
      'meal_preference'       => new sfWidgetFormFilterInput(),
      'special_assistance'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'salutation'            => new sfValidatorChoice(array('required' => false, 'choices' => array('Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Dr' => 'Dr'))),
      'first_name'            => new sfValidatorPass(array('required' => false)),
      'middle_name'           => new sfValidatorPass(array('required' => false)),
      'last_name'             => new sfValidatorPass(array('required' => false)),
      'gender'                => new sfValidatorChoice(array('required' => false, 'choices' => array('male' => 'male', 'female' => 'female'))),
      'dob'                   => new sfValidatorPass(array('required' => false)),
      'p_type'                => new sfValidatorChoice(array('required' => false, 'choices' => array('ADT' => 'ADT', 'CHD' => 'CHD'))),
      'frequent_flyer_number' => new sfValidatorPass(array('required' => false)),
      'airline_code'          => new sfValidatorPass(array('required' => false)),
      'meal_preference'       => new sfValidatorPass(array('required' => false)),
      'special_assistance'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('passenger_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Passenger';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'salutation'            => 'Enum',
      'first_name'            => 'Text',
      'middle_name'           => 'Text',
      'last_name'             => 'Text',
      'gender'                => 'Enum',
      'dob'                   => 'Text',
      'p_type'                => 'Enum',
      'frequent_flyer_number' => 'Text',
      'airline_code'          => 'Text',
      'meal_preference'       => 'Text',
      'special_assistance'    => 'Text',
    );
  }
}
