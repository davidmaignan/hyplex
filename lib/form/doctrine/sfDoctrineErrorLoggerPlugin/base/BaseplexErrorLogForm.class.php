<?php

/**
 * plexErrorLog form base class.
 *
 * @method plexErrorLog getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseplexErrorLogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'type'          => new sfWidgetFormInputText(),
      'class_name'    => new sfWidgetFormInputText(),
      'message'       => new sfWidgetFormTextarea(),
      'file'          => new sfWidgetFormInputText(),
      'parameters'    => new sfWidgetFormTextarea(),
      'plex_response' => new sfWidgetFormTextarea(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'          => new sfValidatorString(array('max_length' => 3)),
      'class_name'    => new sfValidatorString(array('max_length' => 255)),
      'message'       => new sfValidatorString(array('max_length' => 1000000)),
      'file'          => new sfValidatorString(array('max_length' => 255)),
      'parameters'    => new sfValidatorString(),
      'plex_response' => new sfValidatorString(),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('plex_error_log[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'plexErrorLog';
  }

}
