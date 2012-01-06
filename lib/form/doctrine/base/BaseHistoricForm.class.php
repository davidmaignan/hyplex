<?php

/**
 * Historic form base class.
 *
 * @method Historic getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHistoricForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'date'       => new sfWidgetFormDateTime(),
      'tsop'       => new sfWidgetFormInputText(),
      'ip'         => new sfWidgetFormInputText(),
      'country_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'add_empty' => true)),
      'folder'     => new sfWidgetFormInputText(),
      'language'   => new sfWidgetFormInputText(),
      'sTId'       => new sfWidgetFormInputText(),
      'agent'      => new sfWidgetFormInputText(),
      'os'         => new sfWidgetFormInputText(),
      'browser'    => new sfWidgetFormInputText(),
      'version'    => new sfWidgetFormInputText(),
      'uri'        => new sfWidgetFormInputText(),
      'module'     => new sfWidgetFormInputText(),
      'action'     => new sfWidgetFormInputText(),
      'filename'   => new sfWidgetFormInputText(),
      'parameters' => new sfWidgetFormInputText(),
      'scrubbed'   => new sfWidgetFormInputCheckbox(),
      'session_id' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'       => new sfValidatorDateTime(),
      'tsop'       => new sfValidatorInteger(array('required' => false)),
      'ip'         => new sfValidatorString(array('max_length' => 255)),
      'country_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Country'), 'required' => false)),
      'folder'     => new sfValidatorString(array('max_length' => 255)),
      'language'   => new sfValidatorString(array('max_length' => 5)),
      'sTId'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'agent'      => new sfValidatorString(array('max_length' => 255)),
      'os'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'browser'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'version'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'uri'        => new sfValidatorString(array('max_length' => 255)),
      'module'     => new sfValidatorString(array('max_length' => 255)),
      'action'     => new sfValidatorString(array('max_length' => 255)),
      'filename'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'parameters' => new sfValidatorPass(),
      'scrubbed'   => new sfValidatorBoolean(array('required' => false)),
      'session_id' => new sfValidatorString(array('max_length' => 255)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('historic[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Historic';
  }

}
