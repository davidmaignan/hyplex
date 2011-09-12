<?php

/**
 * TopDestination form base class.
 *
 * @method TopDestination getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTopDestinationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'filename'   => new sfWidgetFormInputText(),
      'rank'       => new sfWidgetFormInputText(),
      'start_at'   => new sfWidgetFormDateTime(),
      'expires_at' => new sfWidgetFormDateTime(),
      'published'  => new sfWidgetFormInputCheckbox(),
      'archived'   => new sfWidgetFormInputCheckbox(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'filename'   => new sfValidatorString(array('max_length' => 255)),
      'rank'       => new sfValidatorInteger(),
      'start_at'   => new sfValidatorDateTime(array('required' => false)),
      'expires_at' => new sfValidatorDateTime(array('required' => false)),
      'published'  => new sfValidatorBoolean(array('required' => false)),
      'archived'   => new sfValidatorBoolean(array('required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('top_destination[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TopDestination';
  }

}
