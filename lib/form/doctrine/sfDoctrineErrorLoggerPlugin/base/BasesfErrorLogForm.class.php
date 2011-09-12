<?php

/**
 * sfErrorLog form base class.
 *
 * @method sfErrorLog getObject() Returns the current form's model object
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfErrorLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'type'             => new sfWidgetFormInputText(),
      'class_name'       => new sfWidgetFormInputText(),
      'message'          => new sfWidgetFormTextarea(),
      'module_name'      => new sfWidgetFormInputText(),
      'action_name'      => new sfWidgetFormInputText(),
      'exception_object' => new sfWidgetFormTextarea(),
      'request'          => new sfWidgetFormTextarea(),
      'uri'              => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'             => new sfValidatorString(array('max_length' => 3)),
      'class_name'       => new sfValidatorString(array('max_length' => 255)),
      'message'          => new sfValidatorString(array('max_length' => 1000000)),
      'module_name'      => new sfValidatorString(array('max_length' => 255)),
      'action_name'      => new sfValidatorString(array('max_length' => 255)),
      'exception_object' => new sfValidatorString(),
      'request'          => new sfValidatorString(),
      'uri'              => new sfValidatorString(array('max_length' => 255)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('sf_error_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfErrorLog';
  }

}
