<?php

/**
 * pms_ticket filter form base class.
 *
 * @package    hyplexdemo
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basepms_ticketFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'submitted_by_id'  => new sfWidgetFormFilterInput(),
      'assigned_to_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'ticket_type'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'question' => 'question', 'bug' => 'bug', 'feature' => 'feature', 'internal' => 'internal', 'change' => 'change'))),
      'urgency_type'     => new sfWidgetFormChoice(array('choices' => array('' => '', 'low' => 'low', 'normal' => 'normal', 'high' => 'high', 'emergency' => 'emergency'))),
      'status_type'      => new sfWidgetFormChoice(array('choices' => array('' => '', 'open' => 'open', 'resolve' => 'resolve', 'close' => 'close'))),
      'pms_milestone_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('pms_milestone'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'subject'          => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'submitted_by_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'assigned_to_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'ticket_type'      => new sfValidatorChoice(array('required' => false, 'choices' => array('question' => 'question', 'bug' => 'bug', 'feature' => 'feature', 'internal' => 'internal', 'change' => 'change'))),
      'urgency_type'     => new sfValidatorChoice(array('required' => false, 'choices' => array('low' => 'low', 'normal' => 'normal', 'high' => 'high', 'emergency' => 'emergency'))),
      'status_type'      => new sfValidatorChoice(array('required' => false, 'choices' => array('open' => 'open', 'resolve' => 'resolve', 'close' => 'close'))),
      'pms_milestone_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('pms_milestone'), 'column' => 'id')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('pms_ticket_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'pms_ticket';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'subject'          => 'Text',
      'description'      => 'Text',
      'submitted_by_id'  => 'Number',
      'assigned_to_id'   => 'ForeignKey',
      'ticket_type'      => 'Enum',
      'urgency_type'     => 'Enum',
      'status_type'      => 'Enum',
      'pms_milestone_id' => 'ForeignKey',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
