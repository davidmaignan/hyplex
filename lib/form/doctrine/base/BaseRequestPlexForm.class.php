<?php

/**
 * RequestPlex form base class.
 *
 * @method RequestPlex getObject() Returns the current form's model object
 *
 * @package    hyplexdemo
 * @subpackage form
 * @author     David Maignan
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRequestPlexForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'date'                     => new sfWidgetFormDateTime(),
      'type'                     => new sfWidgetFormInputText(),
      'search_infos'             => new sfWidgetFormTextarea(),
      'user_culture'             => new sfWidgetFormInputText(),
      'user_ip'                  => new sfWidgetFormInputText(),
      'user_agent'               => new sfWidgetFormInputText(),
      'user_folder'              => new sfWidgetFormInputText(),
      'filename'                 => new sfWidgetFormInputText(),
      'user_info'                => new sfWidgetFormTextarea(),
      'header'                   => new sfWidgetFormTextarea(),
      'header_raw'               => new sfWidgetFormTextarea(),
      'response_raw'             => new sfWidgetFormTextarea(),
      'response_code'            => new sfWidgetFormInputText(),
      'response_processed'       => new sfWidgetFormTextarea(),
      'elapsed_plex_request'     => new sfWidgetFormInputText(),
      'elapsed_process_response' => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'                     => new sfValidatorDateTime(),
      'type'                     => new sfValidatorString(array('max_length' => 255)),
      'search_infos'             => new sfValidatorString(array('max_length' => 4000)),
      'user_culture'             => new sfValidatorString(array('max_length' => 10)),
      'user_ip'                  => new sfValidatorString(array('max_length' => 20)),
      'user_agent'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_folder'              => new sfValidatorString(array('max_length' => 255)),
      'filename'                 => new sfValidatorString(array('max_length' => 255)),
      'user_info'                => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'header'                   => new sfValidatorString(array('max_length' => 4000)),
      'header_raw'               => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'response_raw'             => new sfValidatorString(array('required' => false)),
      'response_code'            => new sfValidatorPass(),
      'response_processed'       => new sfValidatorString(array('required' => false)),
      'elapsed_plex_request'     => new sfValidatorNumber(),
      'elapsed_process_response' => new sfValidatorNumber(),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('request_plex[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RequestPlex';
  }

}
