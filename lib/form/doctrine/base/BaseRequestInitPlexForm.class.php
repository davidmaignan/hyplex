<?php

/**
 * RequestInitPlex form base class.
 *
 * @method RequestInitPlex getObject() Returns the current form's model object
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRequestInitPlexForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'date'          => new sfWidgetFormDateTime(),
      'user_culture'  => new sfWidgetFormInputText(),
      'user_ip'       => new sfWidgetFormInputText(),
      'user_agent'    => new sfWidgetFormInputText(),
      'user_folder'   => new sfWidgetFormInputText(),
      'elapsed_time'  => new sfWidgetFormInputText(),
      'header'        => new sfWidgetFormTextarea(),
      'response_code' => new sfWidgetFormInputText(),
      'response_raw'  => new sfWidgetFormTextarea(),
      'stid'          => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'          => new sfValidatorDateTime(),
      'user_culture'  => new sfValidatorString(array('max_length' => 10)),
      'user_ip'       => new sfValidatorString(array('max_length' => 20)),
      'user_agent'    => new sfValidatorString(array('max_length' => 255)),
      'user_folder'   => new sfValidatorString(array('max_length' => 255)),
      'elapsed_time'  => new sfValidatorNumber(),
      'header'        => new sfValidatorString(array('max_length' => 4000)),
      'response_code' => new sfValidatorPass(),
      'response_raw'  => new sfValidatorString(array('required' => false)),
      'stid'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('request_init_plex[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RequestInitPlex';
  }

}
