<?php

/**
 * pms_clarification form base class.
 *
 * @method pms_clarification getObject() Returns the current form's model object
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basepms_clarificationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'clarification_type' => new sfWidgetFormChoice(array('choices' => array('question' => 'question', 'answer' => 'answer', 'note' => 'note'))),
      'pms_ticket_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PmsTicket'), 'add_empty' => true)),
      'from_user_id'       => new sfWidgetFormInputText(),
      'to_user_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'message'            => new sfWidgetFormTextarea(),
      'answer'             => new sfWidgetFormTextarea(),
      'is_internal'        => new sfWidgetFormInputCheckbox(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'clarification_type' => new sfValidatorChoice(array('choices' => array(0 => 'question', 1 => 'answer', 2 => 'note'), 'required' => false)),
      'pms_ticket_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PmsTicket'), 'required' => false)),
      'from_user_id'       => new sfValidatorInteger(array('required' => false)),
      'to_user_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'message'            => new sfValidatorString(array('required' => false)),
      'answer'             => new sfValidatorString(array('required' => false)),
      'is_internal'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('pms_clarification[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'pms_clarification';
  }

}
