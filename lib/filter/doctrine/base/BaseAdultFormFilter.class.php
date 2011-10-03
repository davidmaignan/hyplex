<?php

/**
 * Adult filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAdultFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'salutation'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs'))),
      'first_name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'gender'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'M' => 'M', 'F' => 'F'))),
      'dob'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'p_type'                => new sfWidgetFormChoice(array('choices' => array('' => '', 'ADT' => 'ADT', 'CHD' => 'CHD'))),
      'frequent_flyer_number' => new sfWidgetFormFilterInput(),
      'airline_id'            => new sfWidgetFormFilterInput(),
      'meal_preference_id'    => new sfWidgetFormFilterInput(),
      'special_assistance'    => new sfWidgetFormFilterInput(),
      'email'                 => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'salutation'            => new sfValidatorChoice(array('required' => false, 'choices' => array('Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs'))),
      'first_name'            => new sfValidatorPass(array('required' => false)),
      'last_name'             => new sfValidatorPass(array('required' => false)),
      'gender'                => new sfValidatorChoice(array('required' => false, 'choices' => array('M' => 'M', 'F' => 'F'))),
      'dob'                   => new sfValidatorPass(array('required' => false)),
      'p_type'                => new sfValidatorChoice(array('required' => false, 'choices' => array('ADT' => 'ADT', 'CHD' => 'CHD'))),
      'frequent_flyer_number' => new sfValidatorPass(array('required' => false)),
      'airline_id'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'meal_preference_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'special_assistance'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email'                 => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('adult_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Adult';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Text',
      'salutation'            => 'Enum',
      'first_name'            => 'Text',
      'last_name'             => 'Text',
      'gender'                => 'Enum',
      'dob'                   => 'Text',
      'p_type'                => 'Enum',
      'frequent_flyer_number' => 'Text',
      'airline_id'            => 'Number',
      'meal_preference_id'    => 'Number',
      'special_assistance'    => 'Number',
      'email'                 => 'Text',
    );
  }
}
