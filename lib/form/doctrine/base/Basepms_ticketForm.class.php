<?php

/**
 * pms_ticket form base class.
 *
 * @method pms_ticket getObject() Returns the current form's model object
 *
 * @package    hypertech_booking
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basepms_ticketForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'subject'          => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormTextarea(),
      'submitted_by_id'  => new sfWidgetFormInputText(),
      'assigned_to_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'ticket_type'      => new sfWidgetFormChoice(array('choices' => array('question' => 'question', 'bug' => 'bug', 'feature' => 'feature', 'internal' => 'internal', 'change' => 'change'))),
      'urgency_type'     => new sfWidgetFormChoice(array('choices' => array('low' => 'low', 'normal' => 'normal', 'high' => 'high', 'emergency' => 'emergency'))),
      'status_type'      => new sfWidgetFormChoice(array('choices' => array('open' => 'open', 'resolve' => 'resolve', 'close' => 'close'))),
      'pms_milestone_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('pms_milestone'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'subject'          => new sfValidatorString(array('max_length' => 255)),
      'description'      => new sfValidatorString(),
      'submitted_by_id'  => new sfValidatorInteger(array('required' => false)),
      'assigned_to_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'ticket_type'      => new sfValidatorChoice(array('choices' => array(0 => 'question', 1 => 'bug', 2 => 'feature', 3 => 'internal', 4 => 'change'))),
      'urgency_type'     => new sfValidatorChoice(array('choices' => array(0 => 'low', 1 => 'normal', 2 => 'high', 3 => 'emergency'), 'required' => false)),
      'status_type'      => new sfValidatorChoice(array('choices' => array(0 => 'open', 1 => 'resolve', 2 => 'close'), 'required' => false)),
      'pms_milestone_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('pms_milestone'), 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('pms_ticket[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'pms_ticket';
  }

}
